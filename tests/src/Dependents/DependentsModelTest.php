<?php

declare(strict_types=1);

namespace HR\Tests\Dependents;

use PHPUnit\Framework\TestCase;
use HR\Dependents\{ DependentsDto, DependentsModel };

class DependentsModelTest extends TestCase
{
    private array $input;
    private DependentsDto $dto;
    private DependentsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "dependent_id" => 5550,
            "first_name" => "give",
            "last_name" => "conference",
            "relationship" => "if",
            "employee_id" => 5684,
        ];
        $this->dto = new DependentsDto($this->input);
        $this->model = new DependentsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new DependentsModel(null);

        $this->assertInstanceOf(DependentsModel::class, $model);
    }

    public function testGetDependentId(): void
    {
        $this->assertEquals($this->dto->dependentId, $this->model->getDependentId());
    }

    public function testSetDependentId(): void
    {
        $expected = 9522;
        $model = $this->model;
        $model->setDependentId($expected);

        $this->assertEquals($expected, $model->getDependentId());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "reality";
        $model = $this->model;
        $model->setFirstName($expected);

        $this->assertEquals($expected, $model->getFirstName());
    }

    public function testGetLastName(): void
    {
        $this->assertEquals($this->dto->lastName, $this->model->getLastName());
    }

    public function testSetLastName(): void
    {
        $expected = "so";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetRelationship(): void
    {
        $this->assertEquals($this->dto->relationship, $this->model->getRelationship());
    }

    public function testSetRelationship(): void
    {
        $expected = "along";
        $model = $this->model;
        $model->setRelationship($expected);

        $this->assertEquals($expected, $model->getRelationship());
    }

    public function testGetEmployeeId(): void
    {
        $this->assertEquals($this->dto->employeeId, $this->model->getEmployeeId());
    }

    public function testSetEmployeeId(): void
    {
        $expected = 9288;
        $model = $this->model;
        $model->setEmployeeId($expected);

        $this->assertEquals($expected, $model->getEmployeeId());
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