<?php

declare(strict_types=1);

namespace Gian\Wms\Api\Data;

interface WmsResponseLoggerDataInterface
{
    public const ID = 'id';
    public const SKU = 'sku';
    public const STATUS = 'status';
    public const QTY = 'qty';
    public const ERROR_REASON = 'error_reason';

    /**
     * @return string|null
     */
    public function getSku(): ?string;

    /**
     * @param string $sku
     * @return WmsResponseLoggerDataInterface
     */
    public function setSku(string $sku): WmsResponseLoggerDataInterface;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @param int $status
     * @return WmsResponseLoggerDataInterface
     */
    public function setStatus(int $status): WmsResponseLoggerDataInterface;

    /**
     * @return int|null
     */
    public function getQty():?int;

    /**
     * @param int $qty
     * @return WmsResponseLoggerDataInterface
     */
    public function setQty(int $qty): WmsResponseLoggerDataInterface;

    /**
     * @return string|null
     */
    public function getErrorReason(): ?string;

    /**
     * @param string $errorReason
     * @return WmsResponseLoggerDataInterface
     */
    public function setErrorReason(string $errorReason): WmsResponseLoggerDataInterface;
}
