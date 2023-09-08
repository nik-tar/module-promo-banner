<?php

namespace Niktar\PromoBanner\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;
use Niktar\PromoBanner\Api\Data\MediaImageExtensionInterface;

interface MediaImageInterface extends ExtensibleDataInterface
{
    const TYPE = 'type';
    const NAME = 'name';
    const SIZE = 'size';
    const URL = 'url';
    const RELATIVE_PATH = 'relative_path';
    const PREVIEW_TYPE = 'preview_type';
    const ID = 'id';

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
    public function getName(): string;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getSize(): string;

    /**
     * @param string $size
     * @return void
     */
    public function setSize(string $size): void;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param string $url
     * @return void
     */
    public function setUrl(string $url): void;

    /**
     * @return string
     */
    public function getRelativePath(): string;

    /**
     * @param string $relativePath
     * @return void
     */
    public function setRelativePath(string $relativePath): void;

    /**
     * @return string
     */
    public function getPreviewType(): string;

    /**
     * @param string $previewType
     * @return void
     */
    public function setPreviewType(string $previewType): void;

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @param string $imageId
     * @return void
     */
    public function setId(string $imageId): void;

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Niktar\PromoBanner\Api\Data\MediaImageExtensionInterface|null
     */
    public function getExtensionAttributes(): MediaImageExtensionInterface;

    /**
     * Set an extension attributes object.
     *
     * @param \Niktar\PromoBanner\Api\Data\MediaImageExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(MediaImageExtensionInterface $extensionAttributes): void;
}
