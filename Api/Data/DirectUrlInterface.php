<?php

namespace Niktar\PromoBanner\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;
use Niktar\PromoBanner\Api\Data\DirectUrlExtensionInterface;

interface DirectUrlInterface extends ExtensibleDataInterface
{
    const TYPE = 'type';
    const SETTING = 'setting';
    const DEFAULT = 'default';
    const CATEGORY = 'category';
    const PRODUCT = 'product';
    const OPEN_SEARCH = 'open_search';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     * @return void
     */
    public function setType(string $type): void;

    /**
     * @return string
     */
    public function getSetting(): string;

    /**
     * @param string $setting
     * @return void
     */
    public function setSetting(string $setting): void;

    /**
     * @return string|null
     */
    public function getDefault(): ?string;

    /**
     * @param string|null $default
     * @return void
     */
    public function setDefault(?string $default): void;

    /**
     * @return string|null
     */
    public function getCategory(): ?string;

    /**
     * @param string|null $category
     * @return void
     */
    public function setCategory(?string $category): void;

    /**
     * @return string|null
     */
    public function getProduct(): ?string;

    /**
     * @param string|null $product
     * @return void
     */
    public function setProduct(?string $product): void;

    /**
     * @return string|null
     */
    public function getOpenSearch(): ?string;

    /**
     * @param string|null $target
     * @return void
     */
    public function setOpenSearch(?string $target): void;

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Niktar\PromoBanner\Api\Data\DirectUrlExtensionInterface|null
     */
    public function getExtensionAttributes(): DirectUrlExtensionInterface;

    /**
     * Set an extension attributes object.
     *
     * @param \Niktar\PromoBanner\Api\Data\DirectUrlExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(DirectUrlExtensionInterface $extensionAttributes): void;
}
