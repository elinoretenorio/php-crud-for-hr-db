<?php

declare(strict_types=1);

namespace HR\Tests\Countries;

use PHPUnit\Framework\TestCase;
use HR\Countries\{ CountriesDto, CountriesModel };

class CountriesModelTest extends TestCase
{
    private array $input;
    private CountriesDto $dto;
    private CountriesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "country_id" => 2290,
            "country_code" => "safe",
            "country_name" => "join",
            "region_id" => 1276,
        ];
        $this->dto = new CountriesDto($this->input);
        $this->model = new CountriesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CountriesModel(null);

        $this->assertInstanceOf(CountriesModel::class, $model);
    }

    public function testGetCountryId(): void
    {
        $this->assertEquals($this->dto->countryId, $this->model->getCountryId());
    }

    public function testSetCountryId(): void
    {
        $expected = 9483;
        $model = $this->model;
        $model->setCountryId($expected);

        $this->assertEquals($expected, $model->getCountryId());
    }

    public function testGetCountryCode(): void
    {
        $this->assertEquals($this->dto->countryCode, $this->model->getCountryCode());
    }

    public function testSetCountryCode(): void
    {
        $expected = "thing";
        $model = $this->model;
        $model->setCountryCode($expected);

        $this->assertEquals($expected, $model->getCountryCode());
    }

    public function testGetCountryName(): void
    {
        $this->assertEquals($this->dto->countryName, $this->model->getCountryName());
    }

    public function testSetCountryName(): void
    {
        $expected = "herself";
        $model = $this->model;
        $model->setCountryName($expected);

        $this->assertEquals($expected, $model->getCountryName());
    }

    public function testGetRegionId(): void
    {
        $this->assertEquals($this->dto->regionId, $this->model->getRegionId());
    }

    public function testSetRegionId(): void
    {
        $expected = 6171;
        $model = $this->model;
        $model->setRegionId($expected);

        $this->assertEquals($expected, $model->getRegionId());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}