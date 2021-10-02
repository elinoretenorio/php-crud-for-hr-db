<?php

declare(strict_types=1);

namespace HR\Locations;

interface ILocationsService
{
    public function insert(LocationsModel $model): int;

    public function update(LocationsModel $model): int;

    public function get(int $locationId): ?LocationsModel;

    public function getAll(): array;

    public function delete(int $locationId): int;

    public function createModel(array $row): ?LocationsModel;
}