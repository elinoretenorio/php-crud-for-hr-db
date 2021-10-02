<?php

declare(strict_types=1);

namespace HR\Regions;

interface IRegionsService
{
    public function insert(RegionsModel $model): int;

    public function update(RegionsModel $model): int;

    public function get(int $regionId): ?RegionsModel;

    public function getAll(): array;

    public function delete(int $regionId): int;

    public function createModel(array $row): ?RegionsModel;
}