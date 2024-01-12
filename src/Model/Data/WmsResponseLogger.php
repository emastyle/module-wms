<?php

declare(strict_types=1);

namespace Gian\Wms\Model\Data;

use Magento\Framework\Model\AbstractModel;
use Gian\Wms\Api\Data\WmsResponseLoggerDataInterface;
use Gian\Wms\Model\ResourceModel\WmsResponseLogger as WmsResponseLoggerResource;

class WmsResponseLogger extends AbstractModel implements WmsResponseLoggerDataInterface
{
    protected function _construct()
    {
        $this->_init(WmsResponseLoggerResource::class);
    }

    /**
     * @inheritDoc
     */
    public function getSku(): ?string
    {
        return $this->_getData(self::SKU);
    }

    /**
     * @inheritDoc
     */
    public function setSku(string $sku): WmsResponseLoggerDataInterface
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): int
    {
        return $this->_getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus(int $status): WmsResponseLoggerDataInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getQty(): ?int
    {
        return $this->_getData(self::QTY);
    }

    /**
     * @inheritDoc
     */
    public function setQty(?int $qty): WmsResponseLoggerDataInterface
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * @inheritDoc
     */
    public function getErrorReason(): ?string
    {
        return $this->_getData(self::ERROR_REASON);
    }

    /**
     * @inheritDoc
     */
    public function setErrorReason(?string $errorReason): WmsResponseLoggerDataInterface
    {
        return $this->setData(self::ERROR_REASON, $errorReason);
    }
}
