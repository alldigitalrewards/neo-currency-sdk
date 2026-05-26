<?php

namespace AllDigitalRewards\Tests\Brands;

use AllDigitalRewards\NeoCurrency\Brands\Brand;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    private function sampleBrandPayload(): array
    {
        return [
            'id' => 619,
            'active' => 1,
            'name' => 'Tim Hortons $5-$100 CAD',
            'real_name' => 'Tim Hortons',
            'value' => 0,
            'min' => 5,
            'max' => 100,
            'step_size' => '0.01',
            'description' => 'Digital Tim Cards are a great way',
            'country_code' => 'CA',
            'currency_name' => 'CAD',
            'search_keywords' => 'food, coffee',
        ];
    }

    public function testHydratesStepSizeFromApiPayload(): void
    {
        $brand = new Brand($this->sampleBrandPayload());

        self::assertSame('0.01', $brand->getStepSize());
    }

    public function testStepSizeIsNullWhenNotProvided(): void
    {
        $payload = $this->sampleBrandPayload();
        unset($payload['step_size']);

        $brand = new Brand($payload);

        self::assertNull($brand->getStepSize());
    }

    public function testStepSizeRoundTripsThroughSetter(): void
    {
        $brand = new Brand();
        $brand->setStepSize('5');

        self::assertSame('5', $brand->getStepSize());
    }

    public function testStepSizeIsSerializedInToArray(): void
    {
        $brand = new Brand($this->sampleBrandPayload());

        self::assertArrayHasKey('step_size', $brand->toArray());
        self::assertSame('0.01', $brand->toArray()['step_size']);
    }

    public function testSearchKeywordsContinueToHydrate(): void
    {
        $brand = new Brand($this->sampleBrandPayload());

        self::assertSame('food, coffee', $brand->getSearchKeywords());
    }
}
