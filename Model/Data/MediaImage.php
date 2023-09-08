<?php

namespace Niktar\PromoBanner\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Niktar\PromoBanner\Api\Data\MediaImageExtensionInterface;
use Niktar\PromoBanner\Api\Data\MediaImageInterface;

class MediaImage extends AbstractExtensibleObject implements MediaImageInterface
{
    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->_get(self::TYPE);
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
    public function getName(): string
    {
        return $this->_get(self::NAME);
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
    public function getSize(): string
    {
        return $this->_get(self::SIZE);
    }

    /**
     * @inheritDoc
     */
    public function setSize(string $size): void
    {
        $this->setData(self::SIZE, $size);
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return $this->_get(self::URL);
    }

    /**
     * @inheritDoc
     */
    public function setUrl(string $url): void
    {
        $this->setData(self::URL, $url);
    }

    /**
     * @inheritDoc
     */
    public function getRelativePath(): string
    {
        return $this->_get(self::RELATIVE_PATH);
    }

    /**
     * @inheritDoc
     */
    public function setRelativePath(string $relativePath): void
    {
        $this->setData(self::RELATIVE_PATH, $relativePath);
    }

    /**
     * @inheritDoc
     */
    public function getPreviewType(): string
    {
        return $this->_get(self::PREVIEW_TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setPreviewType(string $previewType): void
    {
        $this->setData(self::PREVIEW_TYPE, $previewType);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->_get(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId(string $imageId): void
    {
        $this->setData(self::ID, $imageId);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAttributes(): MediaImageExtensionInterface
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(MediaImageExtensionInterface $extensionAttributes): void
    {
        $this->_setExtensionAttributes($extensionAttributes);
    }
}
