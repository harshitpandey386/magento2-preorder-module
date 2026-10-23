<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Model\ResourceModel\PreOrder;

use Harshit\PreOrder\Model\PreOrder as PreOrderModel;
use Harshit\PreOrder\Model\ResourceModel\PreOrder as PreOrderResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(PreOrderModel::class, PreOrderResource::class);
    }
}
