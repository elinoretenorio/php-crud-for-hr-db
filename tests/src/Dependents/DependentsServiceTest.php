<?php

declare(strict_types=1);

namespace HR\Tests\Dependents;

use PHPUnit\Framework\TestCase;
use HR\Dependents\{ DependentsDto, DependentsModel, IDependentsService, DependentsService };

class DependentsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private DependentsDto $dto;
    private DependentsModel $model;
    private IDependentsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("HR\Dependents\IDependentsRepository");
        $this->input = [
            "dependent_id" => 2747,
            "first_name" => "research",
            "last_name" => "everything",
            "relationship" => "prevent",
            "employee_id" => 2192,
        ];
        $this->dto = new DependentsDto($this->input);
        $this->model = new DependentsModel($this->dto);
        $this->service = new DependentsService($this->repository);
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
        $expected = 2580;

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
        $expected = 6777;

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
        $dependentId = 1679;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($dependentId)
            ->willReturn(null);

        $actual = $this->service->get($dependentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $dependentId = 978;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($dependentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($dependentId);
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
        $dependentId = 473;
        $expected = 1336;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($dependentId)
            ->willReturn($expected);

        $actual = $this->service->delete($dependentId);
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