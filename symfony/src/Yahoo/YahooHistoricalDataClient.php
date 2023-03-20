<?php

namespace App\Yahoo;

use App\HistoricalData\HistoricalDataClientInterface;
use App\Serializer\JsonSerializerFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class YahooHistoricalDataClient implements HistoricalDataClientInterface
{
    private const HOST = 'yh-finance.p.rapidapi.com';
    private const HISTORICAL_DATA_LINK = 'https://'.self::HOST.'/stock/v3/get-historical-data';

    public function __construct(private HttpClientInterface $httpClient, private string $apiKey)
    {
    }

    public function getHistoricalData(string $symbol, \DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): array
    {
        $request = $this->httpClient->request(
            Request::METHOD_GET,
            self::HISTORICAL_DATA_LINK,
            [
                'headers' => [
                    'X-RapidAPI-Host' => self::HOST,
                    'X-RapidAPI-Key' => $this->apiKey
                ],
                'query' => [
                    'symbol' => $symbol,
                    'from' => $dateFrom->format('Y-m-d'),
                    'to' => $dateTo->format('Y-m-d')
                ]
            ]
        );

        return JsonSerializerFactory::getSerializer()->deserialize(
            json_encode($request->toArray()['prices']),
            'App\Yahoo\YahooHistoricalDataModel[]',
            'json'
        );
    }
}
