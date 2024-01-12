<?php

declare(strict_types=1);

namespace Gian\Wms\Service;

use Gian\Wms\Api\Data\WmsResponseLoggerDataInterfaceFactory;
use Gian\Wms\Model\WmsResponseLoggerRepository;
use Gian\Wms\Service\Client\WmsClient;

class WmsService
{
    public function __construct(
        private readonly WmsClient $wmsClient,
        private readonly WmsResponseLoggerRepository $loggerRepository,
        private readonly WmsResponseLoggerDataInterfaceFactory $responseLoggerDataInterfaceFactory
    ) {
    }

    public function getQtyBySku(string $sku): array
    {
        $reason = null;
        $status = false;
        $qty = null;
        try {
            $response = $this->wmsClient->doRequest('?sku=' . $sku);

            if ($response->getStatusCode() != 200) {
                $reason = $response->getReasonPhrase();
                $this->saveLogResponse($status, $sku, $qty, $reason);
                return [$status, $qty, $reason];
            }

            $qty = json_decode($response->getBody()->getContents())->qty;
            $status = true;
        } catch (\Exception $exception) {
            $reason = $exception->getMessage();
        }

        $this->saveLogResponse($status, $sku, $qty, $reason);
        return [$status, $qty, $reason];
    }

    private function saveLogResponse(bool $status, string $sku, null|int $qty, null|string $reason): void
    {
        $responseData = $this->responseLoggerDataInterfaceFactory->create();
        $responseData
            ->setStatus((int) $status)
            ->setSku($sku)
            ->setQty($qty)
            ->setErrorReason($reason);
        $this->loggerRepository->save($responseData);
    }
}
