<?php

declare(strict_types=1);

namespace HR\Tests\Locations;

use PHPUnit\Framework\TestCase;
use HR\Locations\{ LocationsDto, LocationsModel, ILocationsService, LocationsService };

class LocationsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private LocationsDto $dto;
    private LocationsModel $model;
    private ILocationsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("HR\Locations\ILocationsRepository");
        $this->input = [
            "location_id" => 9960,
            "street_address" => "list",
            "postal_code" => "son",
            "city" => "everyone",
            "state_province" => "six",
            "country_code" => "range",
        ];
        $this->dto = new LocationsDto($this->input);
        $this->model = new LocationsModel($this->dto);
        $this->service = new LocationsService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 94;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 5366;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $locationId = 2829;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($locationId)
            ->willReturn(null);

        $actual = $this->service->get($locationId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $locationId = 7034;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($locationId)
            ->willReturn($this->dto);

        $actual = $this->service->get($locationId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $locationId = 3676;
        $expected = 9506;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($locationId)
            ->willReturn($expected);

        $actual = $this->service->delete($locationId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}