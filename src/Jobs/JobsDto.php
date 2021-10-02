<?php

declare(strict_types=1);

namespace HR\Jobs;

class JobsDto 
{
    public int $jobId;
    public string $jobTitle;
    public float $minSalary;
    public float $maxSalary;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->jobId = (int) ($row["job_id"] ?? 0);
        $this->jobTitle = $row["job_title"] ?? "";
        $this->minSalary = (float) ($row["min_salary"] ?? 0);
        $this->maxSalary = (float) ($row["max_salary"] ?? 0);
    }
}