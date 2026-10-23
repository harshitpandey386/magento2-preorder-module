<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Api\Data;

/**
 * API data contract for a saved pre-order request.
 */
interface PreOrderInterface
{
    public const ENTITY_ID = 'entity_id';
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const MOBILE = 'mobile';
    public const LOCATION = 'location';
    public const PRODUCT_ID = 'product_id';
    public const PRODUCT_NAME = 'product_name';
    public const PRODUCT_SKU = 'product_sku';
    public const SUBMITTED_AT = 'submitted_at';
    public const CREATED_AT = 'created_at';

    /**
     * @return int|null
     */
    public function getEntityId();

    /**
     * @param int|null $entityId
     * @return $this
     */
    public function setEntityId($entityId);

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): self;

    /**
     * @return string|null
     */
    public function getLastName(): ?string;

    /**
     * @param string|null $lastName
     * @return $this
     */
    public function setLastName(?string $lastName): self;

    /**
     * @return string
     */
    public function getMobile(): string;

    /**
     * @param string $mobile
     * @return $this
     */
    public function setMobile(string $mobile): self;

    /**
     * @return string
     */
    public function getLocation(): string;

    /**
     * @param string $location
     * @return $this
     */
    public function setLocation(string $location): self;

    /**
     * @return int
     */
    public function getProductId(): int;

    /**
     * @param int $productId
     * @return $this
     */
    public function setProductId(int $productId): self;

    /**
     * @return string
     */
    public function getProductName(): string;

    /**
     * @param string $productName
     * @return $this
     */
    public function setProductName(string $productName): self;

    /**
     * @return string
     */
    public function getProductSku(): string;

    /**
     * @param string $productSku
     * @return $this
     */
    public function setProductSku(string $productSku): self;

    /**
     * @return string|null
     */
    public function getSubmittedAt(): ?string;

    /**
     * @param string|null $submittedAt
     * @return $this
     */
    public function setSubmittedAt(?string $submittedAt): self;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt): self;
}
