<?php

namespace Niktar\PromoBanner\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface BannerInterface extends ExtensibleDataInterface
{
    const BANNER_ID = 'banner_id';
    const ACTIVE = 'active';
    const SORT_ORDER = 'sort_order';
    const STORE_ID = 'store_id';
    const GROUP_CODE = 'group_code';
    const NAME = 'name';
    const START_DATE = 'start_date';
    const END_DATE = 'end_date';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const RETINA_IMAGE = 'retina_image';
    const DESKTOP_IMAGE = 'desktop_image';
    const MOBILE_IMAGE = 'mobile_image';

    const ALT_TEXT = 'alt_text';
    const TARGET_URL = 'target_url';

    const CONTENT = 'content';
    const SHORT_CONTENT_ENABLED = 'short_content_enabled';
    const SHORT_CONTENT = 'short_content';

    const BOOLEAN_FIELDS = [
        self::ACTIVE,
        self::SHORT_CONTENT_ENABLED
    ];

    /**
     * @return int|null
     */
    public function getBannerId(): ?int;

    /**
     * @param int|null $bannerId
     * @return void
     */
    public function setBannerId(?int $bannerId): void;

    /**
     * @return int
     */
    public function getSortOrder(): int;

    /**
     * @param int $sortOrder
     * @return void
     */
    public function setSortOrder(int $sortOrder): void;

    /**
     * @return bool
     */
    public function isActive(): bool;

    /**
     * @param bool $active
     * @return void
     */
    public function setIsActive(bool $active): void;

    /**
     * @return string[]
     */
    public function getStoreId(): array;

    /**
     * @param string[] $storeId
     * @return void
     */
    public function setStoreId(array $storeId): void;

    /**
     * @return string
     */
    public function getGroupCode(): string;

    /**
     * @param string $groupCode
     * @return void
     */
    public function setGroupCode(string $groupCode): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @return string|null
     */
    public function getStartDate(): ?string;

    /**
     * @param string|null $startDate
     * @return void
     */
    public function setStartDate(?string $startDate): void;

    /**
     * @return string|null
     */
    public function getEndDate(): ?string;

    /**
     * @param string|null $endDate
     * @return void
     */
    public function setEndDate(?string $endDate): void;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @param string $createdAt
     * @return void
     */
    public function setCreatedAt(string $createdAt): void;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * @param string $updatedAt
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void;

    /**
     * @return \Niktar\PromoBanner\Api\Data\MediaImageInterface[]
     */
    public function getRetinaImage(): array;

    /**
     * @param \Niktar\PromoBanner\Api\Data\MediaImageInterface[] $retinaImage
     * @return void
     */
    public function setRetinaImage(array $retinaImage): void;

    /**
     * @return \Niktar\PromoBanner\Api\Data\MediaImageInterface[]
     */
    public function getDesktopImage(): array;

    /**
     * @param \Niktar\PromoBanner\Api\Data\MediaImageInterface[] $desktopImage
     * @return void
     */
    public function setDesktopImage(array $desktopImage): void;

    /**
     * @return \Niktar\PromoBanner\Api\Data\MediaImageInterface[]
     */
    public function getMobileImage(): array;

    /**
     * @param \Niktar\PromoBanner\Api\Data\MediaImageInterface[] $mobileImage
     * @return void
     */
    public function setMobileImage(array $mobileImage): void;

    /**
     * @return string
     */
    public function getAltText(): string;

    /**
     * @param string $altText
     * @return void
     */
    public function setAltText(string $altText): void;

    /**
     * We use urlInput component to make this field more flexible
     * so this is why it returns and accepts an array
     *
     * @return \Niktar\PromoBanner\Api\Data\DirectUrlInterface
     */
    public function getTargetUrl(): DirectUrlInterface;

    /**
     * @param \Niktar\PromoBanner\Api\Data\DirectUrlInterface $targetUrl
     * @return void
     */
    public function setTargetUrl(DirectUrlInterface $targetUrl): void;

    /**
     * @return string
     */
    public function getContent(): string;

    /**
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void;

    /**
     * @return bool
     */
    public function isShortContentEnabled(): bool;

    /**
     * @param bool $shortContentEnabled
     * @return void
     */
    public function setIsShortContentEnabled(bool $shortContentEnabled): void;

    /**
     * @return string
     */
    public function getShortContent(): string;

    /**
     * @param string $shortContent
     * @return void
     */
    public function setShortContent(string $shortContent): void;

    /**
     * @return \Niktar\PromoBanner\Api\Data\BannerExtensionInterface
     */
    public function getExtensionAttributes(): \Niktar\PromoBanner\Api\Data\BannerExtensionInterface;

    /**
     * @param \Niktar\PromoBanner\Api\Data\BannerExtensionInterface
     * @return void
     */
    public function setExtensionAttributes(
        \Niktar\PromoBanner\Api\Data\BannerExtensionInterface $extensionAttributes
    ): void;
}
