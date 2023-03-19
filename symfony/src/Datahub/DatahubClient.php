<?php

declare(strict_types=1);

namespace App\Datahub;

use App\Nasdaq\Client;
use App\Serializer\JsonSerializerFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DatahubClient implements Client
{
    private const NASDAQ_LIST_LINK = 'https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json';

    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function getCompanies(): array
    {
        $request = $this->httpClient->request(
            Request::METHOD_GET,
            self::NASDAQ_LIST_LINK
        );

        return JsonSerializerFactory::getSerializer()->deserialize(
            $request->getContent(),
            'App\Datahub\DatahubCompanyModel[]',
            'json'
        );
    }
}
