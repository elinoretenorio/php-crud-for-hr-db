<?php

declare(strict_types=1);

namespace HR\Tests\Dependents;

use PHPUnit\Framework\TestCase;
use HR\Database\DatabaseException;
use HR\Dependents\{ DependentsDto, IDependentsRepository, DependentsRepository };

class DependentsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private DependentsDto $dto;
    private IDependentsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("HR\Database\IDatabase");
        $this->result = $this->createMock("HR\Database\IDatabaseResult");
        $this->input = [
            "dependent_id" => 5624,
            "first_name" => "north",
            "last_name" => "away",
            "relationship" => "west",
            "employee_id" => 9041,
        ];
        $this->dto = new DependentsDto($this->input);
        $this->repository = new DependentsRepository($this->db);
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
        $expected = 2086;

        $sql = "INSERT INTO `dependents` (`first_name`, `last_name`, `relationship`, `employee_id`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->relationship,
                $this->dto->employeeId
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
        $expected = 7030;

        $sql = "UPDATE `dependents` SET `first_name` = ?, `last_name` = ?, `relationship` = ?, `employee_id` = ?
                WHERE `dependent_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->firstName,
                $this->dto->lastName,
                $this->dto->relationship,
                $this->dto->employeeId,
                $this->dto->dependentId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $dependentId = 7845;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($dependentId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $dependentId = 5626;

        $sql = "SELECT `dependent_id`, `first_name`, `last_name`, `relationship`, `employee_id`
                FROM `dependents` WHERE `dependent_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$dependentId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($dependentId);
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
        $sql = "SELECT `dependent_id`, `first_name`, `last_name`, `relationship`, `employee_id`
                FROM `dependents`";

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
        $dependentId = 6644;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($dependentId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $dependentId = 401;
        $expected = 9946;

        $sql = "DELETE FROM `dependents` WHERE `dependent_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$dependentId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($dependentId);
        $this->assertEquals($expected, $actual);
    }
}