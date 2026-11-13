<?php

namespace AllDigitalRewards\Tests\Products;

use AllDigitalRewards\NeoCurrency\Exceptions\ApiException;
use AllDigitalRewards\NeoCurrency\Products\Product;
use AllDigitalRewards\NeoCurrency\Products\ProductRequest;
use AllDigitalRewards\NeoCurrency\Products\ProductResponse;
use AllDigitalRewards\NeoCurrency\Products\ProductsRequest;
use AllDigitalRewards\NeoCurrency\Products\ProductsResponse;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    public function testProductsRequestDefaultsToFirstFullPage(): void
    {
        $request = new ProductsRequest('bearer-abc');

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame(
            'https://stage.api.yourdigitalreward.com/v1/Products?pageIndex=1&pageSize=500',
            (string)$request->getUri()
        );
        $this->assertSame('Bearer bearer-abc', $request->getHeaderLine('Authorization'));
        $this->assertSame(ProductsResponse::class, $request->getResponseObject());
    }

    public function testProductsRequestAddsOptionalFilters(): void
    {
        $request = new ProductsRequest('bearer-abc', 3, 100, 'USD', Product::TYPE_DIGITAL);

        $this->assertSame(
            'https://stage.api.yourdigitalreward.com/v1/Products?pageIndex=3&pageSize=100'
            . '&currencyCode=USD&productType=Digital',
            (string)$request->getUri()
        );
    }

    public function testProductsResponseHydratesProductsAndPaging(): void
    {
        $response = new ProductsResponse(new Response(200, [], $this->fixture('products-page.json')));

        $this->assertSame(1, $response->getPage());
        $this->assertSame(2, $response->getPageSize());
        $this->assertSame(3, $response->getTotalCount());
        $this->assertTrue($response->hasMorePages());

        [$fixed, $variable] = $response->getProducts();
        $this->assertSame('MGWGCPB', $fixed->getId());
        $this->assertSame('Example Fixed Brand', $fixed->getName());
        $this->assertSame([10.0, 25.0, 50.0], $fixed->getDenominations());
        $this->assertSame(Product::DENOMINATION_FIXED, $fixed->getDenominationType());
        $this->assertSame(Product::TYPE_DIGITAL, $fixed->getType());
        $this->assertSame('<p>Short</p>', $fixed->getShortDescription());
        $this->assertSame('<p>Long description</p>', $fixed->getLongDescription());
        $this->assertSame('<p>Terms</p>', $fixed->getTerms());
        $this->assertSame('Disclaimer', $fixed->getDisclaimer());
        $this->assertSame('Redeem online', $fixed->getRedemptionNote());
        $this->assertSame('USD', $fixed->getCurrencyCode());
        $this->assertSame(['en-US'], $fixed->getCultureCodes());
        $this->assertSame('https://www.example.com/faceplate.png', $fixed->getFaceplatePath());
        $this->assertSame([['cultureCode' => 'fr', 'name' => 'Exemple']], $fixed->getTranslations());

        $this->assertSame([5.0, 500.0], $variable->getDenominations());
        $this->assertSame(Product::DENOMINATION_VARIABLE, $variable->getDenominationType());
        $this->assertNull($variable->getFaceplatePath());
        $this->assertSame([], $variable->getTranslations());
    }

    public function testLastPageHasNoMorePages(): void
    {
        $response = new ProductsResponse(new Response(200, [], '{"data":[],"page":2,"pageSize":2,"totalCount":3}'));

        $this->assertFalse($response->hasMorePages());
        $this->assertSame([], $response->getProducts());
    }

    public function testProductRequestEncodesTheId(): void
    {
        $request = new ProductRequest('bearer-abc', 'AB C/1');

        $this->assertSame('https://stage.api.yourdigitalreward.com/v1/Products/AB%20C%2F1', (string)$request->getUri());
        $this->assertSame(ProductResponse::class, $request->getResponseObject());
    }

    public function testProductResponseHydratesOneProduct(): void
    {
        $data = json_decode($this->fixture('products-page.json'), true)['data'][0];

        $response = new ProductResponse(new Response(200, [], json_encode($data)));

        $this->assertSame('MGWGCPB', $response->getProduct()->getId());
    }

    public function testUnknownProductRaisesApiExceptionWithStatus(): void
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionCode(404);

        new ProductResponse(new Response(404, [], ''));
    }

    private function fixture(string $name): string
    {
        return file_get_contents(__DIR__ . '/../fixtures/' . $name);
    }
}
