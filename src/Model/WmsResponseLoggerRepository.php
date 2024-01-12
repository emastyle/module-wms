<?php

declare(strict_types=1);

namespace Gian\Wms\Model;

use Gian\Wms\Model\ResourceModel\WmsResponseLogger as WmsResponseLoggerResource;
use Magento\Framework\Exception\CouldNotSaveException;
use Gian\Wms\Api\Data\WmsResponseLoggerDataInterface;
use Gian\Wms\Api\WmsResponseLoggerRepositoryInterface;

class WmsResponseLoggerRepository implements WmsResponseLoggerRepositoryInterface
{
    public function __construct(
        private readonly WmsResponseLoggerResource $resourceModel
    ) {
    }

    /**
     * @inheritDoc
     */
    public function save(WmsResponseLoggerDataInterface $responseLoggerData): void
    {
        try {
            $this->resourceModel->save($responseLoggerData);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
    }
}
