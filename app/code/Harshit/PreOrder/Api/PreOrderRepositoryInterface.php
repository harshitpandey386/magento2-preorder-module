<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Api;

use Harshit\PreOrder\Api\Data\PreOrderInterface;

interface PreOrderRepositoryInterface
{
    /**
     * @param \Harshit\PreOrder\Api\Data\PreOrderInterface $preOrder
     * @return \Harshit\PreOrder\Api\Data\PreOrderInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(PreOrderInterface $preOrder): PreOrderInterface;

    /**
     * @param int $entityId
     * @return \Harshit\PreOrder\Api\Data\PreOrderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $entityId): PreOrderInterface;
}
