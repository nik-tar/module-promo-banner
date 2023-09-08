<?php

namespace Niktar\PromoBanner\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Niktar\PromoBanner\Api\Data\BannerInterface;
use Niktar\PromoBanner\Api\Data\BannerExtensionInterface;
use Niktar\PromoBanner\Api\Data\DirectUrlInterface;
use Niktar\PromoBanner\Model\ResourceModel\Banner as BannerResource;

class Banner extends AbstractExtensibleModel implements BannerInterface
{
    /**
     * @inheritDoc
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        $this->_init(
            BannerResource::class
        );
    }

    /**
     * @inheritDoc
     */
    public function getBannerId(): ?int
    {
        return $this->_getData(self::BANNER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setBannerId(?int $bannerId): void
    {
        $this->setData(self::BANNER_ID, $bannerId);
    }

    /**
     * @inheritDoc
     */
    public function getSortOrder(): int
    {
        return $this->_getData(self::SORT_ORDER);
    }

    /**
     * @inheritDoc
     */
    public function setSortOrder(int $sortOrder): void
    {
        $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * @inheritDoc
     */
    public function isActive(): bool
    {
        return $this->_getData(self::ACTIVE);
    }

    /**
     * @inheritDoc
     */
    public function setIsActive(bool $active): void
    {
        $this->setData(self::ACTIVE, $active);
    }

    /**
     * @inheritDoc
     */
    public function getStoreId(): array
    {
        return $this->_getData(self::STORE_ID);
    }

    /**
     * @inheritDoc
     */
    public function setStoreId(array $storeId): void
    {
        $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function getGroupCode(): string
    {
        return $this->_getData(self::GROUP_CODE);
    }

    /**
     * @inheritDoc
     */
    public function setGroupCode(string $groupCode): void
    {
        $this->setData(self::GROUP_CODE, $groupCode);
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getStartDate(): ?string
    {
        return $this->_getData(self::START_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setStartDate(?string $startDate): void
    {
        $this->setData(self::START_DATE, $startDate);
    }

    /**
     * @inheritDoc
     */
    public function getEndDate(): ?string
    {
        return $this->_getData(self::END_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setEndDate(?string $endDate): void
    {
        $this->setData(self::END_DATE, $endDate);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): string
    {
        return $this->_getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): string
    {
        return $this->_getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * @inheritDoc
     */
    public function getRetinaImage(): array
    {
        return $this->_getData(self::RETINA_IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setRetinaImage(array $retinaImage): void
    {
        $this->setData(self::RETINA_IMAGE, $retinaImage);
    }

    /**
     * @inheritDoc
     */
    public function getDesktopImage(): array
    {
        return $this->_getData(self::DESKTOP_IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setDesktopImage(array $desktopImage): void
    {
        $this->setData(self::DESKTOP_IMAGE, $desktopImage);
    }

    /**
     * @inheritDoc
     */
    public function getMobileImage(): array
    {
        return $this->_getData(self::MOBILE_IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setMobileImage(array $mobileImage): void
    {
        $this->setData(self::MOBILE_IMAGE, $mobileImage);
    }

    /**
     * @inheritDoc
     */
    public function getAltText(): string
    {
        return $this->_getData(self::ALT_TEXT) ?: '';
    }

    /**
     * @inheritDoc
     */
    public function setAltText(string $altText): void
    {
        $this->setData(self::ALT_TEXT, $altText);
    }

    /**
     * @inheritDoc
     */
    public function getTargetUrl(): DirectUrlInterface
    {
        return $this->_getData(self::TARGET_URL);
    }

    /**
     * @inheritDoc
     */
    public function setTargetUrl(DirectUrlInterface $targetUrl): void
    {
        $this->setData(self::TARGET_URL, $targetUrl);
    }

    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->_getData(self::CONTENT) ?: '';
    }

    /**
     * @inheritDoc
     */
    public function setContent(string $content): void
    {
        $this->setData(self::CONTENT, $content);
    }

    /**
     * @inheritDoc
     */
    public function isShortContentEnabled(): bool
    {
        return !!$this->_getData(self::SHORT_CONTENT_ENABLED);
    }

    /**
     * @inheritDoc
     */
    public function setIsShortContentEnabled(bool $shortContentEnabled): void
    {
        $this->setData(self::SHORT_CONTENT_ENABLED, $shortContentEnabled);
    }

    /**
     * @inheritDoc
     */
    public function getShortContent(): string
    {
        return $this->_getData(self::SHORT_CONTENT) ?: '';
    }

    /**
     * @inheritDoc
     */
    public function setShortContent(string $shortContent): void
    {
        $this->setData(self::SHORT_CONTENT, $shortContent);
    }

    /**
     * @inheritDoc
     * @noinspection PhpUndefinedClassInspection
     */
    public function getExtensionAttributes(): BannerExtensionInterface
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritDoc
     * @noinspection PhpUndefinedClassInspection
     */
    public function setExtensionAttributes(BannerExtensionInterface $extensionAttributes): void
    {
        /** @noinspection PhpParamsInspection */
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
