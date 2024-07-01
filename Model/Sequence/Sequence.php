<?php

namespace Ptraing\CustomOrderNumber\Model\Sequence;

use Ptraing\CustomOrderNumber\Helper\Data;
use Magento\Framework\App\ResourceConnection as AppResource;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Sequence\SequenceInterface;
use Magento\SalesSequence\Model\Meta;
use Magento\Store\Model\StoreManagerInterface;

class Sequence implements SequenceInterface
{
    /**
     * Default pattern for Sequence
     */
    const DEFAULT_PATTERN = "%s%'.09d%s";

    /**
     * @var Data
     */
    protected Data $configHelper;

    /**
     * @var StoreManagerInterface
     */
    protected StoreManagerInterface $storeManager;

    /**
     * @var string
     */
    private string $lastIncrementId;

    /**
     * @var Meta
     */
    private Meta $meta;

    /**
     * @var AdapterInterface
     */
    private AdapterInterface $connection;

    /**
     * @var string
     */
    private string $pattern;

    /**
     * @param Meta $meta
     * @param AppResource $resource
     * @param Data $configHelper
     * @param StoreManagerInterface $storeManager
     * @param string $pattern
     */
    public function __construct(
        Meta $meta,
        AppResource $resource,
        Data $configHelper,
        StoreManagerInterface $storeManager,
        $pattern = self::DEFAULT_PATTERN
    ) {
        $this->meta = $meta;
        $this->connection = $resource->getConnection('sales');
        $this->pattern = $pattern;
        $this->configHelper = $configHelper;
        $this->storeManager = $storeManager;
    }

    /**
     * Retrieve next value
     *
     * @return string
     */
    public function getNextValue()
    {
        $this->connection->insert($this->meta->getSequenceTable(), []);
        $this->lastIncrementId = $this->connection->lastInsertId($this->meta->getSequenceTable());
        return $this->getCurrentValue();
    }

    /**
     * Retrieve current value
     *
     * @return string
     */
    public function getCurrentValue()
    {
        if (!isset($this->lastIncrementId)) {
            return null;
        }

        $storeId = $this->meta->getStoreId();
        $prefix = $this->configHelper->getOrderIncrementPrefix($storeId);

        return sprintf(
            $this->pattern,
            $prefix,
            $this->calculateCurrentValue(),
            $this->meta->getActiveProfile()->getSuffix()
        );
    }

    /**
     * Calculate current value depends on start value
     *
     * @return string
     */
    private function calculateCurrentValue()
    {
        return ($this->lastIncrementId - $this->meta->getActiveProfile()->getStartValue())
            * $this->meta->getActiveProfile()->getStep() + $this->meta->getActiveProfile()->getStartValue();
    }
}
