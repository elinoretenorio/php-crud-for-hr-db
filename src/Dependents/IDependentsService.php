<?php

declare(strict_types=1);

namespace HR\Dependents;

interface IDependentsService
{
    public function insert(DependentsModel $model): int;

    public function update(DependentsModel $model): int;

    public function get(int $dependentId): ?DependentsModel;

    public function getAll(): array;

    public function delete(int $dependentId): int;

    public function createModel(array $row): ?DependentsModel;
}