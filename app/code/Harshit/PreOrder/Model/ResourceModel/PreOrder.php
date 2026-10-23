<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PreOrder extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('harshit_preorder', 'entity_id');
    }
}
