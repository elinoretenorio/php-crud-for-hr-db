<?php

declare(strict_types=1);

namespace HR\Jobs;

interface IJobsRepository
{
    public function insert(JobsDto $dto): int;

    public function update(JobsDto $dto): int;

    public function get(int $jobId): ?JobsDto;

    public function getAll(): array;

    public function delete(int $jobId): int;
}