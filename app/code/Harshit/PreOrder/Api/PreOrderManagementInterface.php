<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Api;

interface PreOrderManagementInterface
{
    /**
     * Return all saved pre-order requests.
     *
     * @return \Harshit\PreOrder\Api\Data\PreOrderInterface[]
     */
    public function getList(): array;
}
