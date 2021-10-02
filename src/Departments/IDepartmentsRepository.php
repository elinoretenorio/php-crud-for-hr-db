<?php

declare(strict_types=1);

namespace HR\Departments;

interface IDepartmentsRepository
{
    public function insert(DepartmentsDto $dto): int;

    public function update(DepartmentsDto $dto): int;

    public function get(int $departmentId): ?DepartmentsDto;

    public function getAll(): array;

    public function delete(int $departmentId): int;
}