<?php

declare(strict_types=1);

namespace HR\Tests\Employees;

use PHPUnit\Framework\TestCase;
use HR\Database\DatabaseException;
use HR\Employees\{ EmployeesDto, IEmployeesRepository, EmployeesRepository };

class EmployeesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private EmployeesDto $dto;
    private IEmployeesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("HR\Database\IDatabase");
        $this->result = $this->createMock("HR\Database\IDatabaseResult");
        $this->input = [
            "employee_id" => 4042,
            "first_name" => "individual",
            "last_name" => "which",
            "email" => "beckkelsey@example.net",
            "phone_number" => "relationship",
            "hire_date" => "2021-09-28",
            "job_id" => 966,
            "salary" => 772.83,
            "manager_id" => 3712,
            "department_id" => 9651,
        ];
        $this->dto = new EmployeesDto($this->input);
        $this->repository = new EmployeesRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 908;

        $sql = "INSERT INTO `employees` (`first_name`, `last_name`, `email`, `phone_number`, `hire_date`, `job_id`, `salary`, `manager_id`, `department_id`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->email,
                $this->dto->phoneNumber,
                $this->dto->hireDate,
                $this->dto->jobId,
                $this->dto->salary,
                $this->dto->managerId,
                $this->dto->departmentId
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 8828;

        $sql = "UPDATE `employees` SET `first_name` = ?, `last_name` = ?, `email` = ?, `phone_number` = ?, `hire_date` = ?, `job_id` = ?, `salary` = ?, `manager_id` = ?, `department_id` = ?
                WHERE `employee_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->email,
                $this->dto->phoneNumber,
                $this->dto->hireDate,
                $this->dto->jobId,
                $this->dto->salary,
                $this->dto->managerId,
                $this->dto->departmentId,
                $this->dto->employeeId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $employeeId = 4287;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($employeeId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $employeeId = 3219;

        $sql = "SELECT `employee_id`, `first_name`, `last_name`, `email`, `phone_number`, `hire_date`, `job_id`, `salary`, `manager_id`, `department_id`
                FROM `employees` WHERE `employee_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($employeeId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `employee_id`, `first_name`, `last_name`, `email`, `phone_number`, `hire_date`, `job_id`, `salary`, `manager_id`, `department_id`
                FROM `employees`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $employeeId = 5442;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($employeeId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $employeeId = 6525;
        $expected = 1777;

        $sql = "DELETE FROM `employees` WHERE `employee_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$employeeId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($employeeId);
        $this->assertEquals($expected, $actual);
    }
}