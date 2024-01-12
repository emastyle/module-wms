<?php

declare(strict_types=1);

namespace Gian\Wms\ViewModel;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class WmsInit implements ArgumentInterface
{
    private const WMS_CONTROLLER_URL = 'gianwms/wms';

    public function __construct(private readonly UrlInterface $urlBuilder)
    {
    }

    public function getWmsUrl(): string
    {
        return $this->urlBuilder->getUrl(self::WMS_CONTROLLER_URL);
    }
}
