<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Controller\Index;

use Harshit\PreOrder\Api\PreOrderRepositoryInterface;
use Harshit\PreOrder\Model\PreOrderFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Save extends Action implements HttpPostActionInterface
{
    public function __construct(
        Context $context,
        private readonly PreOrderFactory $preOrderFactory,
        private readonly PreOrderRepositoryInterface $preOrderRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly DateTime $dateTime
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setRefererUrl();

        try {
            $firstName = $this->requiredText('first_name', __('First Name'));
            $mobile = $this->requiredText('mobile', __('Mobile Number'));
            $location = $this->requiredText('location', __('Location'));
            $productId = (int) $this->getRequest()->getParam('product_id');

            if ($productId <= 0) {
                throw new LocalizedException(__('The requested product is invalid.'));
            }
            if (!preg_match('/^\d+$/', $mobile)) {
                throw new LocalizedException(__('Mobile Number must contain digits only.'));
            }
            if (strlen($mobile) > 32) {
                throw new LocalizedException(__('Mobile Number is too long.'));
            }

            try {
                $product = $this->productRepository->getById($productId);
            } catch (NoSuchEntityException) {
                throw new LocalizedException(__('The requested product no longer exists.'));
            }

            $preOrder = $this->preOrderFactory->create();
            $preOrder->setData([
                'first_name' => $firstName,
                'last_name' => $this->optionalText('last_name'),
                'mobile' => $mobile,
                'location' => $location,
                'product_id' => $productId,
                'product_name' => (string) $product->getName(),
                'product_sku' => (string) $product->getSku(),
                'submitted_at' => $this->getSubmittedAt(),
            ]);
            $this->preOrderRepository->save($preOrder);

            $this->messageManager->addSuccessMessage(__('Your pre-order request has been submitted.'));
        } catch (LocalizedException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        } catch (\Throwable $exception) {
            $this->messageManager->addErrorMessage(__('We could not submit your pre-order request. Please try again.'));
        }

        return $redirect;
    }

    private function requiredText(string $field, \Magento\Framework\Phrase $label): string
    {
        $value = $this->optionalText($field);
        if ($value === null) {
            throw new LocalizedException(__('%1 is required.', $label));
        }

        return $value;
    }

    private function optionalText(string $field): ?string
    {
        $value = trim((string) $this->getRequest()->getParam($field, ''));
        if ($value === '') {
            return null;
        }
        if (mb_strlen($value) > 255) {
            throw new LocalizedException(__('%1 is too long.', ucwords(str_replace('_', ' ', $field))));
        }

        return $value;
    }

    private function getSubmittedAt(): string
    {
        $timestamp = (string) $this->getRequest()->getParam('submitted_at', '');
        $now = time();

        if (ctype_digit($timestamp)) {
            $submittedAt = (int) $timestamp;
            if (abs($now - $submittedAt) <= 86400) {
                return $this->dateTime->gmtDate('Y-m-d H:i:s', $submittedAt);
            }
        }

        return $this->dateTime->gmtDate('Y-m-d H:i:s', $now);
    }
}
