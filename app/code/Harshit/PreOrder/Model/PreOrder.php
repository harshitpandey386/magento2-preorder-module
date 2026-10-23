<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Model;

use Harshit\PreOrder\Api\Data\PreOrderInterface;
use Magento\Framework\Model\AbstractModel;

class PreOrder extends AbstractModel implements PreOrderInterface
{
    protected function _construct(): void
    {
        $this->_init(ResourceModel\PreOrder::class);
    }

    public function getEntityId()
    {
        $value = $this->getData(self::ENTITY_ID);
        return $value === null ? null : (int) $value;
    }

    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }
    public function getFirstName(): string { return (string) $this->getData(self::FIRST_NAME); }
    public function setFirstName(string $firstName): self { return $this->setData(self::FIRST_NAME, $firstName); }
    public function getLastName(): ?string { $value = $this->getData(self::LAST_NAME); return $value === null ? null : (string) $value; }
    public function setLastName(?string $lastName): self { return $this->setData(self::LAST_NAME, $lastName); }
    public function getMobile(): string { return (string) $this->getData(self::MOBILE); }
    public function setMobile(string $mobile): self { return $this->setData(self::MOBILE, $mobile); }
    public function getLocation(): string { return (string) $this->getData(self::LOCATION); }
    public function setLocation(string $location): self { return $this->setData(self::LOCATION, $location); }
    public function getProductId(): int { return (int) $this->getData(self::PRODUCT_ID); }
    public function setProductId(int $productId): self { return $this->setData(self::PRODUCT_ID, $productId); }
    public function getProductName(): string { return (string) $this->getData(self::PRODUCT_NAME); }
    public function setProductName(string $productName): self { return $this->setData(self::PRODUCT_NAME, $productName); }
    public function getProductSku(): string { return (string) $this->getData(self::PRODUCT_SKU); }
    public function setProductSku(string $productSku): self { return $this->setData(self::PRODUCT_SKU, $productSku); }
    public function getSubmittedAt(): ?string { $value = $this->getData(self::SUBMITTED_AT); return $value === null ? null : (string) $value; }
    public function setSubmittedAt(?string $submittedAt): self { return $this->setData(self::SUBMITTED_AT, $submittedAt); }
    public function getCreatedAt(): string { return (string) $this->getData(self::CREATED_AT); }
    public function setCreatedAt(string $createdAt): self { return $this->setData(self::CREATED_AT, $createdAt); }
}
