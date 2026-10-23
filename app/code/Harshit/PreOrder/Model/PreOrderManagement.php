<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Model;

use Harshit\PreOrder\Api\PreOrderManagementInterface;
use Harshit\PreOrder\Model\ResourceModel\PreOrder\CollectionFactory;

class PreOrderManagement implements PreOrderManagementInterface
{
    public function __construct(private readonly CollectionFactory $collectionFactory)
    {
    }

    public function getList(): array
    {
        return array_values($this->collectionFactory->create()
            ->setOrder('entity_id', 'DESC')
            ->getItems());
    }
}
