<?php

namespace Niktar\PromoBanner\Model;

use Exception;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Niktar\PromoBanner\Api\BannerRepositoryInterface;
use Niktar\PromoBanner\Api\Data\BannerInterface;
use Niktar\PromoBanner\Api\Data\BannerSearchResultsInterface;
use Niktar\PromoBanner\Api\Data\BannerSearchResultsInterfaceFactory;
use Niktar\PromoBanner\Model\Banner as BannerModel;
use Niktar\PromoBanner\Model\ResourceModel\Banner as BannerResource;
use Niktar\PromoBanner\Model\ResourceModel\Banner\Collection;
use Niktar\PromoBanner\Model\ResourceModel\Banner\CollectionFactory;
use Niktar\PromoBanner\Api\Data\BannerInterfaceFactory as BannerModelFactory;

/**
 * Class BannerRepository
 * @package Niktar\PromoBanner\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var BannerResource
     */
    private $bannerResource;
    /**
     * @var BannerModelFactory
     */
    private $bannerModelFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var BannerSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;
    /**
     * @var JoinProcessorInterface
     */
    private $extAttrsProcessor;

    /**
     * @inheritDoc
     */
    public function __construct(
        BannerResource $bannerResource,
        BannerModelFactory $bannerModelFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        BannerSearchResultsInterfaceFactory $searchResultsFactory,
        JoinProcessorInterface $extAttrsProcessor
    ) {
        $this->bannerResource = $bannerResource;
        $this->bannerModelFactory = $bannerModelFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->extAttrsProcessor = $extAttrsProcessor;
    }

    /**
     * @inheritDoc
     */
    public function get(int $bannerId): BannerInterface
    {
        /** @var BannerModel $banner */
        $banner = $this->bannerModelFactory->create();
        $this->bannerResource->load($banner, $bannerId);

        if (!$banner->getBannerId()) {
            throw new NoSuchEntityException(__('Cannot load banner with id "%1".', $bannerId));
        }

        return $banner;
    }

    /**
     * @inheritDoc
     */
    public function save(BannerInterface $banner): void
    {
        try {
            /** @var BannerModel $banner */
            $this->bannerResource->save($banner);
        } catch (AlreadyExistsException $e) {
            throw new CouldNotSaveException(
                __(
                    'Cannot save banner with id "%1", data: %2. Exception: %3.',
                    $banner->getBannerId(),
                    $banner->serialize(),
                    $e->getMessage()
                )
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(BannerInterface $banner): void
    {
        try {
            /** @var BannerModel $banner */
            $this->bannerResource->delete($banner);
        } catch (Exception $e) {
            throw new CouldNotDeleteException(
                __(
                    'Cannot delete banner with id "%1", data: %2. Exception: %3.',
                    $banner->getBannerId(),
                    $banner->serialize(),
                    $e->getMessage()
                )
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $bannerId): void
    {
        try {
            $this->delete($this->get($bannerId));
        } catch (NoSuchEntityException $e) {
            throw new CouldNotDeleteException(
                __('Cannot delete nonexistent banner with id "%1". Exception: %2', $bannerId, $e->getMessage())
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $criteria): BannerSearchResultsInterface
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->extAttrsProcessor->process($collection, BannerInterface::class);
        $this->collectionProcessor->process($criteria, $collection);

        /** @var BannerSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        /** @var BannerInterface[] $items */
        $items = $collection->getItems();
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
