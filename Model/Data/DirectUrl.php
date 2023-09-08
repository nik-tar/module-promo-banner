<?php

namespace Niktar\PromoBanner\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Niktar\PromoBanner\Api\Data\DirectUrlExtensionInterface;
use Niktar\PromoBanner\Api\Data\DirectUrlInterface;

class DirectUrl extends AbstractExtensibleObject implements DirectUrlInterface
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->_get(self::TYPE) ?: '';
    }

    /**
     * @inheritDoc
     */
    public function setType(string $type): void
    {
        $this->setData(self::TYPE, $type);
    }

    /**
     * @inheritDoc
     */
    public function getSetting(): string
    {
        return $this->_get(self::SETTING) ?: '';
    }

    /**
     * @inheritDoc
     */
    public function setSetting(string $setting): void
    {
        $this->setData(self::SETTING, $setting);
    }

    /**
     * @inheritDoc
     */
    public function getDefault(): ?string
    {
        return $this->_get(self::DEFAULT);
    }

    /**
     * @inheritDoc
     */
    public function setDefault(?string $default): void
    {
        $this->setData(self::DEFAULT, $default);
    }

    /**
     * @inheritDoc
     */
    public function getCategory(): ?string
    {
        return $this->_get(self::CATEGORY);
    }

    /**
     * @inheritDoc
     */
    public function setCategory(?string $category): void
    {
        $this->setData(self::CATEGORY, $category);
    }

    /**
     * @inheritDoc
     */
    public function getProduct(): ?string
    {
        return $this->_get(self::PRODUCT);
    }

    /**
     * @inheritDoc
     */
    public function setProduct(?string $product): void
    {
        $this->setData(self::PRODUCT, $product);
    }

    /**
     * @inheritDoc
     */
    public function getOpenSearch(): ?string
    {
        return $this->_get(self::OPEN_SEARCH);
    }

    /**
     * @inheritDoc
     */
    public function setOpenSearch(?string $target): void
    {
        $this->setData(self::OPEN_SEARCH, $target);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAttributes(): DirectUrlExtensionInterface
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(DirectUrlExtensionInterface $extensionAttributes): void
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
