<?php

namespace DW\TestTask\Model\ResourceModel;

/**
 * Class Log
 * @package DW\TestTask\Model\ResourceModel
 */
class Log extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('dw_test_log', 'id');
    }
}
