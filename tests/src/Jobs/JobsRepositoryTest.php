<?php

declare(strict_types=1);

namespace HR\Tests\Jobs;

use PHPUnit\Framework\TestCase;
use HR\Database\DatabaseException;
use HR\Jobs\{ JobsDto, IJobsRepository, JobsRepository };

class JobsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private JobsDto $dto;
    private IJobsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("HR\Database\IDatabase");
        $this->result = $this->createMock("HR\Database\IDatabaseResult");
        $this->input = [
            "job_id" => 5539,
            "job_title" => "hold",
            "min_salary" => 695.99,
            "max_salary" => 233.88,
        ];
        $this->dto = new JobsDto($this->input);
        $this->repository = new JobsRepository($this->db);
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
        $expected = 3076;

        $sql = "INSERT INTO `jobs` (`job_title`, `min_salary`, `max_salary`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->jobTitle,
                $this->dto->minSalary,
                $this->dto->maxSalary
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
        $expected = 5462;

        $sql = "UPDATE `jobs` SET `job_title` = ?, `min_salary` = ?, `max_salary` = ?
                WHERE `job_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->jobTitle,
                $this->dto->minSalary,
                $this->dto->maxSalary,
                $this->dto->jobId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $jobId = 6663;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($jobId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $jobId = 3059;

        $sql = "SELECT `job_id`, `job_title`, `min_salary`, `max_salary`
                FROM `jobs` WHERE `job_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$jobId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($jobId);
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
        $sql = "SELECT `job_id`, `job_title`, `min_salary`, `max_salary`
                FROM `jobs`";

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
        $jobId = 6657;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($jobId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $jobId = 9168;
        $expected = 2779;

        $sql = "DELETE FROM `jobs` WHERE `job_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$jobId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($jobId);
        $this->assertEquals($expected, $actual);
    }
}