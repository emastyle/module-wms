<?php

declare(strict_types=1);

namespace Gian\Wms\Controller\Adminhtml\Wms;

use Gian\Wms\Model\ConfigProvider;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Gian\Wms\Service\WmsService;

class Index extends Action implements HttpPostActionInterface
{
    public const ADMIN_RESOURCE = ConfigProvider::ADMIN_RESOURCE;

    public function __construct(
        private Context $context,
        private readonly JsonFactory $resultJsonFactory,
        private readonly WmsService  $wmsService
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->getRequest()->isAjax()) {
            $this->_forward('noroute');
            return;
        }

        $sku = $this->getRequest()->getParam('sku');
        [$status, $qty, $reason] = $this->wmsService->getQtyBySku($sku);

        $response = [
            'status' => $status,
            'qty' => $qty,
            'message' => $reason
                ?? __('Stock quantity set to '
                    . $qty
                    . ' for product SKU '
                    . $sku
                    . '. Please, save the product!'),
        ];

        $result = $this->resultJsonFactory->create();
        return $result->setData($response);
    }
}
