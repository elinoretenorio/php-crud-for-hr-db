<?php

declare(strict_types=1);

namespace HR\Tests\Employees;

use PHPUnit\Framework\TestCase;
use HR\Employees\{ EmployeesDto, EmployeesModel };

class EmployeesModelTest extends TestCase
{
    private array $input;
    private EmployeesDto $dto;
    private EmployeesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "employee_id" => 2892,
            "first_name" => "response",
            "last_name" => "reason",
            "email" => "qcampbell@example.org",
            "phone_number" => "teacher",
            "hire_date" => "2021-10-04",
            "job_id" => 7298,
            "salary" => 645.32,
            "manager_id" => 6369,
            "department_id" => 5686,
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->model = new EmployeesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new EmployeesModel(null);

        $this->assertInstanceOf(EmployeesModel::class, $model);
    }

    public function testGetEmployeeId(): void
    {
        $this->assertEquals($this->dto->employeeId, $this->model->getEmployeeId());
    }

    public function testSetEmployeeId(): void
    {
        $expected = 7413;
        $model = $this->model;
        $model->setEmployeeId($expected);

        $this->assertEquals($expected, $model->getEmployeeId());
    }

    public function testGetFirstName(): void
    {
        $this->assertEquals($this->dto->firstName, $this->model->getFirstName());
    }

    public function testSetFirstName(): void
    {
        $expected = "hear";
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
        $expected = "write";
        $model = $this->model;
        $model->setLastName($expected);

        $this->assertEquals($expected, $model->getLastName());
    }

    public function testGetEmail(): void
    {
        $this->assertEquals($this->dto->email, $this->model->getEmail());
    }

    public function testSetEmail(): void
    {
        $expected = "hwalter@example.com";
        $model = $this->model;
        $model->setEmail($expected);

        $this->assertEquals($expected, $model->getEmail());
    }

    public function testGetPhoneNumber(): void
    {
        $this->assertEquals($this->dto->phoneNumber, $this->model->getPhoneNumber());
    }

    public function testSetPhoneNumber(): void
    {
        $expected = "assume";
        $model = $this->model;
        $model->setPhoneNumber($expected);

        $this->assertEquals($expected, $model->getPhoneNumber());
    }

    public function testGetHireDate(): void
    {
        $this->assertEquals($this->dto->hireDate, $this->model->getHireDate());
    }

    public function testSetHireDate(): void
    {
        $expected = "2021-10-11";
        $model = $this->model;
        $model->setHireDate($expected);

        $this->assertEquals($expected, $model->getHireDate());
    }

    public function testGetJobId(): void
    {
        $this->assertEquals($this->dto->jobId, $this->model->getJobId());
    }

    public function testSetJobId(): void
    {
        $expected = 1643;
        $model = $this->model;
        $model->setJobId($expected);

        $this->assertEquals($expected, $model->getJobId());
    }

    public function testGetSalary(): void
    {
        $this->assertEquals($this->dto->salary, $this->model->getSalary());
    }

    public function testSetSalary(): void
    {
        $expected = 187.31;
        $model = $this->model;
        $model->setSalary($expected);

        $this->assertEquals($expected, $model->getSalary());
    }

    public function testGetManagerId(): void
    {
        $this->assertEquals($this->dto->managerId, $this->model->getManagerId());
    }

    public function testSetManagerId(): void
    {
        $expected = 2537;
        $model = $this->model;
        $model->setManagerId($expected);

        $this->assertEquals($expected, $model->getManagerId());
    }

    public function testGetDepartmentId(): void
    {
        $this->assertEquals($this->dto->departmentId, $this->model->getDepartmentId());
    }

    public function testSetDepartmentId(): void
    {
        $expected = 5290;
        $model = $this->model;
        $model->setDepartmentId($expected);

        $this->assertEquals($expected, $model->getDepartmentId());
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