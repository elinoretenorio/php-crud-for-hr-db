<?php

declare(strict_types=1);

namespace HR\Tests\Locations;

use PHPUnit\Framework\TestCase;
use HR\Locations\{ LocationsDto, LocationsModel };

class LocationsModelTest extends TestCase
{
    private array $input;
    private LocationsDto $dto;
    private LocationsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "location_id" => 8182,
            "street_address" => "but",
            "postal_code" => "if",
            "city" => "miss",
            "state_province" => "something",
            "country_code" => "phone",
        ];
        $this->dto = new LocationsDto($this->input);
        $this->model = new LocationsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new LocationsModel(null);

        $this->assertInstanceOf(LocationsModel::class, $model);
    }

    public function testGetLocationId(): void
    {
        $this->assertEquals($this->dto->locationId, $this->model->getLocationId());
    }

    public function testSetLocationId(): void
    {
        $expected = 9988;
        $model = $this->model;
        $model->setLocationId($expected);

        $this->assertEquals($expected, $model->getLocationId());
    }

    public function testGetStreetAddress(): void
    {
        $this->assertEquals($this->dto->streetAddress, $this->model->getStreetAddress());
    }

    public function testSetStreetAddress(): void
    {
        $expected = "to";
        $model = $this->model;
        $model->setStreetAddress($expected);

        $this->assertEquals($expected, $model->getStreetAddress());
    }

    public function testGetPostalCode(): void
    {
        $this->assertEquals($this->dto->postalCode, $this->model->getPostalCode());
    }

    public function testSetPostalCode(): void
    {
        $expected = "possible";
        $model = $this->model;
        $model->setPostalCode($expected);

        $this->assertEquals($expected, $model->getPostalCode());
    }

    public function testGetCity(): void
    {
        $this->assertEquals($this->dto->city, $this->model->getCity());
    }

    public function testSetCity(): void
    {
        $expected = "course";
        $model = $this->model;
        $model->setCity($expected);

        $this->assertEquals($expected, $model->getCity());
    }

    public function testGetStateProvince(): void
    {
        $this->assertEquals($this->dto->stateProvince, $this->model->getStateProvince());
    }

    public function testSetStateProvince(): void
    {
        $expected = "society";
        $model = $this->model;
        $model->setStateProvince($expected);

        $this->assertEquals($expected, $model->getStateProvince());
    }

    public function testGetCountryCode(): void
    {
        $this->assertEquals($this->dto->countryCode, $this->model->getCountryCode());
    }

    public function testSetCountryCode(): void
    {
        $expected = "clearly";
        $model = $this->model;
        $model->setCountryCode($expected);

        $this->assertEquals($expected, $model->getCountryCode());
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