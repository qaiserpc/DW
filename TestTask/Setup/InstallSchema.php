<?php

namespace DW\TestTask\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('dw_test_log')
        )
            ->addColumn('id', Table::TYPE_INTEGER, null, array(
                'identity' => true,
                'nullable' => false,
                'primary'  => true
            ))
            ->addColumn(
                'order_id',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ]
            )
            ->addColumn(
                'decimal_factor',
                Table::TYPE_DECIMAL,
                '12,4',
                [
                    'default' => 0,
                    'comment' => 'Decimal factor'
                ]
            )
            ->addColumn(
                'total_order_amount',
                Table::TYPE_DECIMAL,
                '12,4',
                [
                    'default' => 0,
                    'comment' => 'total Order amount'
                ]
            )
            ->addColumn(
                'order_amount_with_decimal',
                Table::TYPE_DECIMAL,
                '12,4',
                [
                    'default' => 0,
                    'comment' => 'Order Sum Multiplied with decimal factor'
                ]
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default'  => Table::TIMESTAMP_INIT,
                    'comment'  => 'Created At'
                ]
            )
            ->setComment('DW Test Log');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
