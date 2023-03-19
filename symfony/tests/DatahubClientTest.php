<?php

namespace App\Tests;

use App\Datahub\DatahubClient;
use App\Datahub\DatahubCompanyModel;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DatahubClientTest extends TestCase
{
    private HttpClientInterface $httpClientMock;
    private DatahubClient $datahubClient;
    private ResponseInterface $mockResponse;

    public function setUp(): void
    {
        $this->httpClientMock = $this->createMock(HttpClientInterface::class);
        $this->datahubClient = new DatahubClient($this->httpClientMock);
        $this->mockResponse = $this->createMock(ResponseInterface::class);
    }

    public function testGetCompaniesReturnsArrayOfDatahubCompanyModels()
    {
        $jsonResponse = '[{"Company Name": "iShares MSCI All Country Asia Information Technology Index Fund", "Financial Status": "N", "Market Category": "G", "Round Lot Size": 100.0, "Security Name": "iShares MSCI All Country Asia Information Technology Index Fund", "Symbol": "AAIT", "Test Issue": "N"},{"Company Name": "American Airlines Group, Inc.", "Financial Status": "N", "Market Category": "Q", "Round Lot Size": 100.0, "Security Name": "American Airlines Group, Inc. - Common Stock", "Symbol": "AAL", "Test Issue": "N"}]';
        $this->mockResponse
            ->method('getContent')
            ->willReturn($jsonResponse);

        $expectedResult = [
            new DatahubCompanyModel(
                'iShares MSCI All Country Asia Information Technology Index Fund',
                'AAIT'
            ),
            new DatahubCompanyModel('American Airlines Group, Inc.', 'AAL'),
        ];
        $this->httpClientMock
            ->method('request')
            ->willReturn($this->mockResponse);

        $result = $this->datahubClient->getCompanies();

        $this->assertEquals($expectedResult, $result);
    }
}
