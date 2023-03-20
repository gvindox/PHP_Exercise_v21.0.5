<?php

declare(strict_types=1);

namespace App\Tests;

use App\Yahoo\YahooHistoricalDataClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class YahooHistoricalDataClientTest extends TestCase
{
    private const API_KEY = 'test_api_key';

    public function testGetHistoricalData(): void
    {
        $date = '2022-03-19';
        $mockResponse = new MockResponse(
            json_encode([
                'prices' => [
                    [
                        'date' => strtotime($date),
                        'open' => 100.0,
                        'high' => 105.0,
                        'low' => 95.0,
                        'close' => 102.0,
                        'volume' => 1000000,
                    ]
                ]
            ]),
            [
                'http_code' => 200,
            ]
        );

        $httpClient = new MockHttpClient([$mockResponse]);

        $yahooHistoricalDataClient = new YahooHistoricalDataClient($httpClient, self::API_KEY);

        $historicalData = $yahooHistoricalDataClient->getHistoricalData(
            'AAPL',
            new \DateTimeImmutable('2022-03-18'),
            new \DateTimeImmutable($date)
        );

        $this->assertCount(1, $historicalData);
        $this->assertEquals(
            $date,
            (new \DateTime())->setTimestamp($historicalData[0]->getDate())->format('Y-m-d')
        );
        $this->assertEquals(100.0, $historicalData[0]->getOpen());
        $this->assertEquals(105.0, $historicalData[0]->getHigh());
        $this->assertEquals(95.0, $historicalData[0]->getLow());
        $this->assertEquals(102.0, $historicalData[0]->getClose());
        $this->assertEquals(1000000, $historicalData[0]->getVolume());
    }
}
