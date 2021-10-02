<?php

declare(strict_types=1);

namespace HR\Jobs;

use JsonSerializable;

class JobsModel implements JsonSerializable
{
    private int $jobId;
    private string $jobTitle;
    private float $minSalary;
    private float $maxSalary;

    public function __construct(JobsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->jobId = $dto->jobId;
        $this->jobTitle = $dto->jobTitle;
        $this->minSalary = $dto->minSalary;
        $this->maxSalary = $dto->maxSalary;
    }

    public function getJobId(): int
    {
        return $this->jobId;
    }

    public function setJobId(int $jobId): void
    {
        $this->jobId = $jobId;
    }

    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    public function getMinSalary(): float
    {
        return $this->minSalary;
    }

    public function setMinSalary(float $minSalary): void
    {
        $this->minSalary = $minSalary;
    }

    public function getMaxSalary(): float
    {
        return $this->maxSalary;
    }

    public function setMaxSalary(float $maxSalary): void
    {
        $this->maxSalary = $maxSalary;
    }

    public function toDto(): JobsDto
    {
        $dto = new JobsDto();
        $dto->jobId = (int) ($this->jobId ?? 0);
        $dto->jobTitle = $this->jobTitle ?? "";
        $dto->minSalary = (float) ($this->minSalary ?? 0);
        $dto->maxSalary = (float) ($this->maxSalary ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "job_id" => $this->jobId,
            "job_title" => $this->jobTitle,
            "min_salary" => $this->minSalary,
            "max_salary" => $this->maxSalary,
        ];
    }
}