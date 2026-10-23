<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Setup\Patch\Data;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Stdlib\DateTime\DateTime;

class AddSampleRequests implements DataPatchInterface
{
    public function __construct(
        private readonly ModuleDataSetupInterface $moduleDataSetup,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        private readonly DateTime $dateTime
    ) {
    }

    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        try {
            $searchCriteria = $this->searchCriteriaBuilder->setPageSize(1)->setCurrentPage(1)->create();
            $products = $this->productRepository->getList($searchCriteria)->getItems();
            $product = reset($products);

            if (!$product) {
                return;
            }

            $this->moduleDataSetup->getConnection()->insertMultiple(
                $this->moduleDataSetup->getTable('harshit_preorder'),
                [
                    [
                        'first_name' => 'Sample',
                        'last_name' => 'Customer One',
                        'mobile' => '1234567890',
                        'location' => 'Sample Location',
                        'product_id' => (int) $product->getId(),
                        'product_name' => (string) $product->getName(),
                        'product_sku' => (string) $product->getSku(),
                        'submitted_at' => $this->dateTime->gmtDate('Y-m-d H:i:s'),
                    ],
                    [
                        'first_name' => 'Sample',
                        'last_name' => 'Customer Two',
                        'mobile' => '9876543210',
                        'location' => 'Sample Location',
                        'product_id' => (int) $product->getId(),
                        'product_name' => (string) $product->getName(),
                        'product_sku' => (string) $product->getSku(),
                        'submitted_at' => $this->dateTime->gmtDate('Y-m-d H:i:s'),
                    ],
                ]
            );
        } finally {
            $this->moduleDataSetup->getConnection()->endSetup();
        }
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
