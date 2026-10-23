<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Controller\Adminhtml\Request;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'Harshit_PreOrder::preorders';

    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Harshit_PreOrder::preorders');
        $resultPage->getConfig()->getTitle()->prepend(__('Pre Orders'));

        return $resultPage;
    }
}
