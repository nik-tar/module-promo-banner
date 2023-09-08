<?php

namespace Niktar\PromoBanner\Model\Banner;

class GroupsResolver
{
    /**
     * @var array
     */
    private $groups = [];

    /**
     * @param array $groups
     */
    public function __construct(
        array $groups = []
    ) {
        $this->groups = $groups;
    }

    /**
     * @todo Add store config section
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups;
    }
}
