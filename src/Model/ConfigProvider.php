<?php

declare(strict_types=1);

namespace Gian\Wms\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface as Scope;

class ConfigProvider
{
    public const ADMIN_RESOURCE = 'Gian_Wms::wms_service';

    private const XML_PATH_SERVICE_URL = 'gian_wms/settings/service_url';
    private const XML_PATH_IS_WMS_ENABLED = 'gian_wms/settings/enabled';

    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig,
    ) {
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_IS_WMS_ENABLED,
            Scope::SCOPE_WEBSITE
        );
    }

    public function getServiceUrl(): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SERVICE_URL,
            Scope::SCOPE_WEBSITE
        );
    }
}
