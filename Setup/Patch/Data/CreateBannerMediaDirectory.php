<?php

namespace Niktar\PromoBanner\Setup\Patch\Data;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateBannerMediaDirectory implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var WriteInterface
     */
    private $mediaDirectory;
    /**
     * @var File
     */
    private $file;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param Filesystem $filesystem
     * @param File $file
     * @throws FileSystemException
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        Filesystem $filesystem,
        File $file
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->file = $file;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $this->file->checkAndCreateFolder($this->mediaDirectory->getAbsolutePath('promo_banner'));

        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
