<?php

namespace Niktar\PromoBanner\Model\Api\SearchCriteria\BannerCollectionProcessor\FilterProcessor;

use Magento\Framework\Api\Filter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessor\FilterProcessor\CustomFilterInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\DB\Select;

class DateFilter implements CustomFilterInterface
{
    /**
     * @inheritDoc
     */
    public function apply(Filter $filter, AbstractDb $collection): bool
    {
        $connection = $collection->getConnection();

        $field = $filter->getField();
        $value = $filter->getValue();

        $condition = [
            $filter->getConditionType() => $value,
        ];

        $normalCondition = $connection->prepareSqlCondition(
            $connection->quoteIdentifier($field),
            $condition
        );
        $nullCondition = $connection->quoteIdentifier($field) . ' is NULL';

        $collection->getSelect()->where(
            '(' . implode(') ' . Select::SQL_OR . ' (', [$normalCondition, $nullCondition]) . ')',
            null,
            Select::TYPE_CONDITION
        );

        return true;
    }
}
