<?php

declare(strict_types=1);

namespace HR\Tests\Employees;

use PHPUnit\Framework\TestCase;
use HR\Employees\{ EmployeesDto, EmployeesModel, IEmployeesService, EmployeesService };

class EmployeesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private EmployeesDto $dto;
    private EmployeesModel $model;
    private IEmployeesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("HR\Employees\IEmployeesRepository");
        $this->input = [
            "employee_id" => 5468,
            "first_name" => "ok",
            "last_name" => "my",
            "email" => "danielleriley@example.org",
            "phone_number" => "animal",
            "hire_date" => "2021-09-18",
            "job_id" => 4938,
            "salary" => 191.51,
            "manager_id" => 2570,
            "department_id" => 6123,
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->model = new EmployeesModel($this->dto);
        $this->service = new EmployeesService($this->repository);
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
        $expected = 4081;

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
        $expected = 7613;

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
        $employeeId = 6311;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeId)
            ->willReturn(null);

        $actual = $this->service->get($employeeId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $employeeId = 9773;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($employeeId)
            ->willReturn($this->dto);

        $actual = $this->service->get($employeeId);
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
        $employeeId = 9838;
        $expected = 9288;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($employeeId)
            ->willReturn($expected);

        $actual = $this->service->delete($employeeId);
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