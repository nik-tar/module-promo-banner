<?php

namespace Niktar\PromoBanner\Model\ResourceModel;

use Exception;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Api\ObjectFactory;
use Magento\Framework\DataObject;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\Store;
use Niktar\PromoBanner\Api\Data\DirectUrlInterface;
use Niktar\PromoBanner\Api\Data\BannerInterface;
use Niktar\PromoBanner\Api\Data\MediaImageInterface;
use Niktar\PromoBanner\Model\Banner as BannerModel;

class Banner extends AbstractDb
{
    /**
     * @inheritDoc
     */
    protected $_serializableFields = [
        BannerInterface::RETINA_IMAGE => [[], [], false],
        BannerInterface::DESKTOP_IMAGE => [[], [], false],
        BannerInterface::MOBILE_IMAGE => [[], [], false],
        BannerInterface::TARGET_URL => [
            [
                'default' => '',
                'setting' => false,
                'type' => 'default'
            ],
            [
                'default' => '',
                'setting' => false,
                'type' => 'default'
            ],
            false
        ],
    ];

    /**
     * By default, if we add fields to $_serializableFields they serialize to array,
     * but I wanted to have data classes instead of simple arrays
     * @see \Niktar\PromoBanner\Model\ResourceModel\Banner::_serializeField
     * @see \Niktar\PromoBanner\Model\ResourceModel\Banner::_unserializeField
     */
    const TYPED_FIELDS = [
        BannerInterface::RETINA_IMAGE => [MediaImageInterface::class, true],
        BannerInterface::DESKTOP_IMAGE => [MediaImageInterface::class, true],
        BannerInterface::MOBILE_IMAGE => [MediaImageInterface::class, true],
        BannerInterface::TARGET_URL => [DirectUrlInterface::class, false],
    ];

    /**
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var ObjectFactory
     */
    private $objectFactory;

    /**
     * @param Context $context
     * @param DataObjectProcessor $dataObjectProcessor
     * @param DataObjectHelper $dataObjectHelper
     * @param ObjectFactory $objectFactory
     * @param string|null $connectionName
     */
    public function __construct(
        Context $context,
        DataObjectProcessor $dataObjectProcessor,
        DataObjectHelper $dataObjectHelper,
        ObjectFactory $objectFactory,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->objectFactory = $objectFactory;
    }

    /**
     * @inheritDoc
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        $this->_init(
            'niktar_banner',
            BannerInterface::BANNER_ID
        );
    }

    /**
     * Get store ids to which specified item is assigned
     * All the stores logic based on Magento_Cms module
     *
     * @param int $bannerId
     * @return array
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function lookupStoreIds(int $bannerId): array
    {
        $connection = $this->getConnection();

        /** @noinspection PhpUnhandledExceptionInspection */
        $select = $connection->select()
            ->from(['nbs' => $this->getTable('niktar_banner_store')], 'store_id')
            ->join(
                ['nb' => $this->getMainTable()],
                'nbs.' . BannerInterface::BANNER_ID . ' = nb.' . BannerInterface::BANNER_ID,
                []
            )
            ->where('nb.' . BannerInterface::BANNER_ID . ' = ?', (int)$bannerId);

        return $connection->fetchCol($select);
    }

    /**
     * @param AbstractModel $object
     * @return Banner
     */
    protected function _afterLoad(AbstractModel $object): self
    {
        /** @var BannerModel $object */
        if (!$object->hasData('store_id')) {
            $stores = $this->lookupStoreIds((int)$object->getId()) ?: [Store::DEFAULT_STORE_ID];
            $object->setStoreId(array_map('intval',$stores));
        }

        return parent::_afterLoad($object);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    protected function _afterSave(AbstractModel $object)
    {
        /** @var BannerModel $object */
        $this->saveStores($object);

        return parent::_afterSave($object);
    }

    /**
     * @param BannerModel $object
     * @return void
     * @throws Exception
     */
    private function saveStores(BannerModel $object)
    {
        $connection = $this->getConnection();

        $connection->beginTransaction();

        try {
            $oldStores = $this->lookupStoreIds((int)$object->getBannerId());
            $newStores = $object->getStoreId() ?: [Store::DEFAULT_STORE_ID];

            $table = $this->getTable('niktar_banner_store');

            $delete = array_diff($oldStores, $newStores);
            if ($delete) {
                $where = [
                    BannerInterface::BANNER_ID . ' = ?' => (int)$object->getBannerId(),
                    'store_id IN (?)' => $delete,
                ];
                $connection->delete($table, $where);
            }

            $insert = array_diff($newStores, $oldStores);
            if ($insert) {
                $data = [];
                foreach ($insert as $storeId) {
                    $data[] = [
                        BannerInterface::BANNER_ID => (int)$object->getBannerId(),
                        'store_id' => (int)$storeId
                    ];
                }
                $connection->insertMultiple($table, $data);
            }

            $connection->commit();
        } catch (Exception $exception) {
            $connection->rollBack();
            throw $exception;
        }
    }

    /**
     * @inheritDoc
     */
    protected function _serializeField(DataObject $object, $field, $defaultValue = null, $unsetEmpty = false)
    {
        if (isset(self::TYPED_FIELDS[$field])) {
            /** @var ExtensibleDataInterface[] $value */
            $value = $object->getData($field) ?: [];

            [$objectClass, $isArray] = self::TYPED_FIELDS[$field];

            if ($isArray) {
                $newValue = [];
                foreach ($value as $item) {
                    if (!is_array($item)) {
                        $newItem = $this->dataObjectProcessor->buildOutputDataArray(
                            $item,
                            $objectClass
                        );
                        $newValue[] = $newItem;
                    }
                }
            } else {
                $newValue = $this->dataObjectProcessor->buildOutputDataArray(
                    $value,
                    $objectClass
                );
            }

            $object->setData($field, $newValue);
        }

        return parent::_serializeField(
            $object,
            $field,
            $defaultValue,
            $unsetEmpty
        );
    }

    /**
     * @inheritDoc
     * @noinspection SpellCheckingInspection
     */
    protected function _unserializeField(DataObject $object, $field, $defaultValue = null)
    {
        parent::_unserializeField($object, $field, $defaultValue);

        if (isset(self::TYPED_FIELDS[$field])) {
            /** @var array[] $value */
            $value = $object->getData($field) ?: [];

            [$objectClass, $isArray] = self::TYPED_FIELDS[$field];

            if ($isArray) {
                $newValue = [];
                foreach ($value as $item) {
                    if (is_array($item)) {
                        $newItem = $this->objectFactory->create($objectClass, []);
                        $this->dataObjectHelper->populateWithArray(
                            $newItem,
                            $item,
                            $objectClass
                        );
                        $newValue[] = $newItem;
                    }
                }
            } else {
                $newValue = $this->objectFactory->create($objectClass, []);
                $this->dataObjectHelper->populateWithArray(
                    $newValue,
                    $value,
                    $objectClass
                );
            }

            $object->setData($field, $newValue);
        }
    }
}
