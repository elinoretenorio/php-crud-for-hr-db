<?php

declare(strict_types=1);

namespace HR\Tests\Countries;

use PHPUnit\Framework\TestCase;
use HR\Countries\{ CountriesDto, CountriesModel, ICountriesService, CountriesService };

class CountriesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CountriesDto $dto;
    private CountriesModel $model;
    private ICountriesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("HR\Countries\ICountriesRepository");
        $this->input = [
            "country_id" => 7072,
            "country_code" => "business",
            "country_name" => "carry",
            "region_id" => 9740,
        ];
        $this->dto = new CountriesDto($this->input);
        $this->model = new CountriesModel($this->dto);
        $this->service = new CountriesService($this->repository);
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
        $expected = 3752;

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
        $expected = 7249;

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
        $countryCode = "also";

        $this->repository->expects($this->once())
            ->method("get")
            ->with($countryCode)
            ->willReturn(null);

        $actual = $this->service->get($countryCode);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $countryCode = "unit";

        $this->repository->expects($this->once())
            ->method("get")
            ->with($countryCode)
            ->willReturn($this->dto);

        $actual = $this->service->get($countryCode);
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
        $countryCode = "about";
        $expected = 9733;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($countryCode)
            ->willReturn($expected);

        $actual = $this->service->delete($countryCode);
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