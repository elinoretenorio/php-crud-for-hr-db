<?php

declare(strict_types=1);

namespace HR\Dependents;

interface IDependentsRepository
{
    public function insert(DependentsDto $dto): int;

    public function update(DependentsDto $dto): int;

    public function get(int $dependentId): ?DependentsDto;

    public function getAll(): array;

    public function delete(int $dependentId): int;
}