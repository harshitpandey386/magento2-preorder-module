<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Model;

use Harshit\PreOrder\Api\Data\PreOrderInterface;
use Harshit\PreOrder\Api\PreOrderRepositoryInterface;
use Harshit\PreOrder\Model\ResourceModel\PreOrder as PreOrderResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class PreOrderRepository implements PreOrderRepositoryInterface
{
    public function __construct(
        private readonly PreOrderResource $resource,
        private readonly PreOrderFactory $preOrderFactory
    ) {
    }

    public function save(PreOrderInterface $preOrder): PreOrderInterface
    {
        if (!$preOrder instanceof PreOrder) {
            throw new CouldNotSaveException(__('Unsupported pre-order data object.'));
        }

        try {
            $this->resource->save($preOrder);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save the pre-order request.'), $exception);
        }

        return $preOrder;
    }

    public function getById(int $entityId): PreOrderInterface
    {
        $preOrder = $this->preOrderFactory->create();
        $this->resource->load($preOrder, $entityId);
        if (!$preOrder->getId()) {
            throw new NoSuchEntityException(__('The pre-order request with ID "%1" does not exist.', $entityId));
        }

        return $preOrder;
    }
}
