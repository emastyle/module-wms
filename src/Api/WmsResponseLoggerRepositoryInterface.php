<?php

declare(strict_types=1);

namespace Gian\Wms\Api;

use Gian\Wms\Api\Data\WmsResponseLoggerDataInterface;

/**
 * @api
 */
interface WmsResponseLoggerRepositoryInterface
{
    /**
     * @param WmsResponseLoggerDataInterface $responseLoggerData
     * @return void
     */
    public function save(
        WmsResponseLoggerDataInterface $responseLoggerData
    ): void;
}
