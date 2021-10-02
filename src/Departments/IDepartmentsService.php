<?php

declare(strict_types=1);

namespace HR\Departments;

interface IDepartmentsService
{
    public function insert(DepartmentsModel $model): int;

    public function update(DepartmentsModel $model): int;

    public function get(int $departmentId): ?DepartmentsModel;

    public function getAll(): array;

    public function delete(int $departmentId): int;

    public function createModel(array $row): ?DepartmentsModel;
}