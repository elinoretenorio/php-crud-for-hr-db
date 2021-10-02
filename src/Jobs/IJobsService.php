<?php

declare(strict_types=1);

namespace HR\Jobs;

interface IJobsService
{
    public function insert(JobsModel $model): int;

    public function update(JobsModel $model): int;

    public function get(int $jobId): ?JobsModel;

    public function getAll(): array;

    public function delete(int $jobId): int;

    public function createModel(array $row): ?JobsModel;
}