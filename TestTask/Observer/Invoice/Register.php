<?php

namespace DW\TestTask\Observer\Invoice;

/**
 * Class Register
 * @package DW\TestTask\Observer\Invoice
 */
class Register implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \DW\TestTask\Helper\Data
     */
    protected $testHelper;

    /** @var \DW\TestTask\Model\ResourceModel\LogFactory */
    protected $logResourceFactory;

    /** @var \DW\TestTask\Model\LogFactory */
    protected $logFactory;

    /**
     * Register constructor.
     * @param \DW\TestTask\Helper\Data                    $testHelper
     * @param \DW\TestTask\Model\LogFactory               $logFactory
     * @param \DW\TestTask\Model\ResourceModel\LogFactory $logResourceFactory
     */
    public function __construct(
        \DW\TestTask\Helper\Data $testHelper,
        \DW\TestTask\Model\LogFactory $logFactory,
        \DW\TestTask\Model\ResourceModel\LogFactory $logResourceFactory
    ) {
        $this->logFactory         = $logFactory;
        $this->logResourceFactory = $logResourceFactory;
        $this->testHelper         = $testHelper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if (!$this->testHelper->getEnabled()) {
            return;
        }
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getOrder();

        if ($order->getBaseTotalPaid() != $order->getBaseGrandTotal()) {
            return;
        }

        $logModel         = $this->logFactory->create();
        $logResourceModel = $this->logResourceFactory->create();
        $data = [
            'order_id'        => $order->getIncrementId(),
            'decimal_factor'          => $this->testHelper->getFactor(),
            'total_order_amount'       => $order->getGrandTotal(),
            'order_amount_with_decimal' => ($order->getGrandTotal() * $this->testHelper->getFactor()),
        ];
        try {
            $logModel->setData($data);
            $logResourceModel->save($logModel);
        } catch (\Exception $e) {
        }
    }
}
