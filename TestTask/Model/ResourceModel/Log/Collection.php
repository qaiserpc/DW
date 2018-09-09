<?php

namespace DW\TestTask\Model\ResourceModel\Log;

/**
 * Class Collection
 * @package DW\TestTask\Model\ResourceModel\Log
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'dw_test_log_collection';
    protected $_eventObject = 'test_log_collection';

    protected function _construct()
    {
        $this->_init('DW\TestTask\Model\Log', 'DW\TestTask\Model\ResourceModel\Log');
    }
}
