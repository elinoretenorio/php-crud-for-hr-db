<?php

declare(strict_types=1);

namespace HR\Tests\Jobs;

use PHPUnit\Framework\TestCase;
use HR\Jobs\{ JobsDto, JobsModel };

class JobsModelTest extends TestCase
{
    private array $input;
    private JobsDto $dto;
    private JobsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "job_id" => 8966,
            "job_title" => "science",
            "min_salary" => 761.97,
            "max_salary" => 434.75,
        ];
        $this->dto = new JobsDto($this->input);
        $this->model = new JobsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new JobsModel(null);

        $this->assertInstanceOf(JobsModel::class, $model);
    }

    public function testGetJobId(): void
    {
        $this->assertEquals($this->dto->jobId, $this->model->getJobId());
    }

    public function testSetJobId(): void
    {
        $expected = 4710;
        $model = $this->model;
        $model->setJobId($expected);

        $this->assertEquals($expected, $model->getJobId());
    }

    public function testGetJobTitle(): void
    {
        $this->assertEquals($this->dto->jobTitle, $this->model->getJobTitle());
    }

    public function testSetJobTitle(): void
    {
        $expected = "simply";
        $model = $this->model;
        $model->setJobTitle($expected);

        $this->assertEquals($expected, $model->getJobTitle());
    }

    public function testGetMinSalary(): void
    {
        $this->assertEquals($this->dto->minSalary, $this->model->getMinSalary());
    }

    public function testSetMinSalary(): void
    {
        $expected = 302.53;
        $model = $this->model;
        $model->setMinSalary($expected);

        $this->assertEquals($expected, $model->getMinSalary());
    }

    public function testGetMaxSalary(): void
    {
        $this->assertEquals($this->dto->maxSalary, $this->model->getMaxSalary());
    }

    public function testSetMaxSalary(): void
    {
        $expected = 831.00;
        $model = $this->model;
        $model->setMaxSalary($expected);

        $this->assertEquals($expected, $model->getMaxSalary());
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