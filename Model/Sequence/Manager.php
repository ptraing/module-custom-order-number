<?php

namespace Ptraing\CustomOrderNumber\Model\Sequence;

use Ptraing\CustomOrderNumber\Model\Sequence\SequenceFactory;
use Magento\SalesSequence\Model\ResourceModel\Meta as ResourceSequenceMeta;
use Magento\SalesSequence\Model\SequenceFactory as DefaultSequenceFactory;
use Magento\SalesSequence\Model\Manager as SalesSequenceManager;

class Manager extends SalesSequenceManager
{
    /**
     * @var ResourceSequenceMeta
     */
    protected $resourceSequenceMeta;

    /**
     * @var SequenceFactory
     */
    protected $sequenceFactory;

    /**
     * @param ResourceSequenceMeta $resourceSequenceMeta
     * @param SequenceFactory $sequenceFactory
     * @param DefaultSequenceFactory $defaultSequenceFactory
     */
    public function __construct(
        ResourceSequenceMeta $resourceSequenceMeta,
        SequenceFactory $sequenceFactory,
        DefaultSequenceFactory $defaultSequenceFactory
    ) {
        parent::__construct($resourceSequenceMeta, $defaultSequenceFactory);
        $this->sequenceFactory = $sequenceFactory;
    }
}
