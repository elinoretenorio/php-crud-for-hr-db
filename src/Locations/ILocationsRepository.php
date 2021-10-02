<?php

declare(strict_types=1);

namespace HR\Locations;

interface ILocationsRepository
{
    public function insert(LocationsDto $dto): int;

    public function update(LocationsDto $dto): int;

    public function get(int $locationId): ?LocationsDto;

    public function getAll(): array;

    public function delete(int $locationId): int;
}