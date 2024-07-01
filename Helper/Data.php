<?php

namespace Ptraing\CustomOrderNumber\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_CONFIG_ORDER_PREFIX = 'ptraing_order/order_increment_id/increment_id_prefix';

    public function getOrderIncrementPrefix($storeId)
    {
        return $this->scopeConfig->getValue(self::XML_CONFIG_ORDER_PREFIX, ScopeInterface::SCOPE_STORE, $storeId);
    }
}
