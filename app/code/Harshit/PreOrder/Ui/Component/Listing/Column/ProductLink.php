<?php
declare(strict_types=1);

namespace Harshit\PreOrder\Ui\Component\Listing\Column;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class ProductLink extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        private readonly UrlInterface $backendUrl,
        private readonly Escaper $escaper,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource): array
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        $name = (string) $this->getData('name');
        foreach ($dataSource['data']['items'] as &$item) {
            $productId = isset($item['product_id']) ? (int) $item['product_id'] : 0;
            $url = $this->backendUrl->getUrl('catalog/product/edit', ['id' => $productId]);
            $item[$name] = '<a href="' . $this->escaper->escapeUrl($url)
                . '" target="_blank" rel="noopener">'
                . $this->escaper->escapeHtml(__('View Product'))
                . '</a>';
        }
        unset($item);

        return $dataSource;
    }
}
