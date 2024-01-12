<?php

declare(strict_types=1);

namespace Gian\Wms\Block\Adminhtml\Product;

use Gian\Wms\Model\ConfigProvider;
use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\AuthorizationInterface;

class WmsButton extends Generic
{
    public function __construct(
        Context $context,
        Registry $registry,
        private readonly ConfigProvider $configProvider,
        private readonly AuthorizationInterface $authorization
    ) {
        parent::__construct($context, $registry);
    }

    public function getButtonData(): array
    {
        if (!$this->configProvider->isEnabled()
            || !$this->authorization->isAllowed(ConfigProvider::ADMIN_RESOURCE)
        ) {
            return [];
        }

        return [
            'label' => __('Sync with WMS'),
            'class' => 'action-secondary',
            'id' => 'wms-button',
            'on_click' => 'return false;',
            'disabled' => $this->isDisabled(),
            'sort_order' => 20,
            'data_attribute' => [
                'sku' => $this->getProduct()->getSku()
            ]
        ];
    }

    private function isDisabled(): bool
    {
        return $this->getProduct()->isComposite();
    }
}
