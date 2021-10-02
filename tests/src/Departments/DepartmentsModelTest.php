<?php

declare(strict_types=1);

namespace HR\Tests\Departments;

use PHPUnit\Framework\TestCase;
use HR\Departments\{ DepartmentsDto, DepartmentsModel };

class DepartmentsModelTest extends TestCase
{
    private array $input;
    private DepartmentsDto $dto;
    private DepartmentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "department_id" => 9059,
            "department_name" => "east",
            "location_id" => 5223,
        ];
        $this->dto = new DepartmentsDto($this->input);
        $this->model = new DepartmentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new DepartmentsModel(null);

        $this->assertInstanceOf(DepartmentsModel::class, $model);
    }

    public function testGetDepartmentId(): void
    {
        $this->assertEquals($this->dto->departmentId, $this->model->getDepartmentId());
    }

    public function testSetDepartmentId(): void
    {
        $expected = 8342;
        $model = $this->model;
        $model->setDepartmentId($expected);

        $this->assertEquals($expected, $model->getDepartmentId());
    }

    public function testGetDepartmentName(): void
    {
        $this->assertEquals($this->dto->departmentName, $this->model->getDepartmentName());
    }

    public function testSetDepartmentName(): void
    {
        $expected = "off";
        $model = $this->model;
        $model->setDepartmentName($expected);

        $this->assertEquals($expected, $model->getDepartmentName());
    }

    public function testGetLocationId(): void
    {
        $this->assertEquals($this->dto->locationId, $this->model->getLocationId());
    }

    public function testSetLocationId(): void
    {
        $expected = 2042;
        $model = $this->model;
        $model->setLocationId($expected);

        $this->assertEquals($expected, $model->getLocationId());
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