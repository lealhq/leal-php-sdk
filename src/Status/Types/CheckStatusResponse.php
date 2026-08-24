<?php

namespace Leal\Status\Types;

use Leal\Core\Json\JsonSerializableType;
use Leal\Core\Json\JsonProperty;

class CheckStatusResponse extends JsonSerializableType
{
    /**
     * @var string $apiVersion Current API version
     */
    #[JsonProperty('api_version')]
    public string $apiVersion;

    /**
     * @var string $authentication How to authenticate a request
     */
    #[JsonProperty('authentication')]
    public string $authentication;

    /**
     * @var string $developerPortalUrl Developer portal: quickstart, auth, webhooks
     */
    #[JsonProperty('developer_portal_url')]
    public string $developerPortalUrl;

    /**
     * @var string $documentationUrl Human readable API reference
     */
    #[JsonProperty('documentation_url')]
    public string $documentationUrl;

    /**
     * @var string $openapiUrl OpenAPI description of this API
     */
    #[JsonProperty('openapi_url')]
    public string $openapiUrl;

    /**
     * @var CheckStatusResponseRateLimit $rateLimit
     */
    #[JsonProperty('rate_limit')]
    public CheckStatusResponseRateLimit $rateLimit;

    /**
     * @var string $status 'ok' while the API is serving requests
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @param array{
     *   apiVersion: string,
     *   authentication: string,
     *   developerPortalUrl: string,
     *   documentationUrl: string,
     *   openapiUrl: string,
     *   rateLimit: CheckStatusResponseRateLimit,
     *   status: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->apiVersion = $values['apiVersion'];
        $this->authentication = $values['authentication'];
        $this->developerPortalUrl = $values['developerPortalUrl'];
        $this->documentationUrl = $values['documentationUrl'];
        $this->openapiUrl = $values['openapiUrl'];
        $this->rateLimit = $values['rateLimit'];
        $this->status = $values['status'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
