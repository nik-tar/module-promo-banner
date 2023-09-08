<?php

namespace Niktar\PromoBanner\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface BannerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return \Niktar\PromoBanner\Api\Data\BannerInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param \Niktar\PromoBanner\Api\Data\BannerInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
