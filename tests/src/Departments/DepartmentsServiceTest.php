<?php

declare(strict_types=1);

namespace HR\Tests\Departments;

use PHPUnit\Framework\TestCase;
use HR\Departments\{ DepartmentsDto, DepartmentsModel, IDepartmentsService, DepartmentsService };

class DepartmentsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private DepartmentsDto $dto;
    private DepartmentsModel $model;
    private IDepartmentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("HR\Departments\IDepartmentsRepository");
        $this->input = [
            "department_id" => 7509,
            "department_name" => "must",
            "location_id" => 6962,
        ];
        $this->dto = new DepartmentsDto($this->input);
        $this->model = new DepartmentsModel($this->dto);
        $this->service = new DepartmentsService($this->repository);
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
        $expected = 5947;

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
        $expected = 9253;

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
        $departmentId = 4041;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($departmentId)
            ->willReturn(null);

        $actual = $this->service->get($departmentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $departmentId = 8133;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($departmentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($departmentId);
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
        $departmentId = 7589;
        $expected = 6093;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($departmentId)
            ->willReturn($expected);

        $actual = $this->service->delete($departmentId);
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