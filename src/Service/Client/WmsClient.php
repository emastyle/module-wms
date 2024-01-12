<?php

declare(strict_types=1);

namespace Gian\Wms\Service\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;
use Magento\Framework\Webapi\Rest\Request;
use Gian\Wms\Model\ConfigProvider;

class WmsClient
{
    private Client|null $client = null;

    public function __construct(
        private readonly ClientFactory   $clientFactory,
        private readonly ResponseFactory $responseFactory,
        private readonly ConfigProvider  $configProvider
    ) {
    }

    public function doRequest(
        string $uriEndpoint,
        array $params = [],
        string $requestMethod = Request::HTTP_METHOD_GET
    ): null|Response {
        try {
            $this->initClient();
            $response = $this->client->request(
                $requestMethod,
                $uriEndpoint,
                $params
            );
        } catch (GuzzleException $exception) {
            // patch: convert always to error 500 to bypass Guzzle Error assertions bug
            $statusCode = $exception->getCode();
            $code = ($statusCode < ResponseStatus::HTTP_CONTINUE)
                ? ResponseStatus::HTTP_INTERNAL_SERVER_ERROR
                : $statusCode;

            $response = $this->responseFactory->create([
                'status' => $code,
                'reason' => $exception->getMessage()
            ]);
        }

        return $response;
    }

    private function initClient(): void
    {
        /** @var Client $client */
        $this->client = $this->clientFactory->create(
            ['config' => [
                'base_uri' => $this->configProvider->getServiceUrl()
            ]]
        );
    }
}
