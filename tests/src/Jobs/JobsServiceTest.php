<?php

declare(strict_types=1);

namespace HR\Tests\Jobs;

use PHPUnit\Framework\TestCase;
use HR\Jobs\{ JobsDto, JobsModel, IJobsService, JobsService };

class JobsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private JobsDto $dto;
    private JobsModel $model;
    private IJobsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("HR\Jobs\IJobsRepository");
        $this->input = [
            "job_id" => 2497,
            "job_title" => "party",
            "min_salary" => 649.35,
            "max_salary" => 947.91,
        ];
        $this->dto = new JobsDto($this->input);
        $this->model = new JobsModel($this->dto);
        $this->service = new JobsService($this->repository);
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
        $expected = 7317;

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
        $expected = 5023;

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
        $jobId = 4083;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($jobId)
            ->willReturn(null);

        $actual = $this->service->get($jobId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $jobId = 6381;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($jobId)
            ->willReturn($this->dto);

        $actual = $this->service->get($jobId);
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
        $jobId = 4836;
        $expected = 4176;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($jobId)
            ->willReturn($expected);

        $actual = $this->service->delete($jobId);
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