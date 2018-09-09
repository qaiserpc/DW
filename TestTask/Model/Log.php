<?php

namespace DW\TestTask\Model;

/**
 * Class Log
 * @package DW\TestTask\Model
 */
class Log extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'dw_test_log';

    protected $_cacheTag = 'dw_test_log';

    protected $_eventPrefix = 'dw_test_log';

    protected function _construct()
    {
        $this->_init('DW\TestTask\Model\ResourceModel\Log');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
