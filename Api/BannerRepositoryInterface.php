<?php

namespace Niktar\PromoBanner\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Niktar\PromoBanner\Api\Data\BannerInterface;
use Niktar\PromoBanner\Api\Data\BannerSearchResultsInterface;

interface BannerRepositoryInterface
{
    /**
     * @param int $bannerId
     * @return \Niktar\PromoBanner\Api\Data\BannerInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(int $bannerId): BannerInterface;

    /**
     * @param \Niktar\PromoBanner\Api\Data\BannerInterface $banner
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(BannerInterface $banner): void;

    /**
     * @param \Niktar\PromoBanner\Api\Data\BannerInterface $banner
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(BannerInterface $banner): void;

    /**
     * @param int $bannerId
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $bannerId): void;

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Niktar\PromoBanner\Api\Data\BannerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): BannerSearchResultsInterface;
}
