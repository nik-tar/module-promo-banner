<?php

namespace Niktar\PromoBanner\Model\Api\SearchCriteria\BannerCollectionProcessor\FilterProcessor;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor\CustomFilterInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Niktar\PromoBanner\Model\ResourceModel\Banner\Collection as BannerCollection;

class StoreId implements CustomFilterInterface
{
    /**
     * @inheritDoc
     */
    public function apply(Filter $filter, AbstractDb $collection)
    {
        /** @var BannerCollection $collection */
        $collection->addStoreFilter($filter->getValue());
        return true;
    }
}
