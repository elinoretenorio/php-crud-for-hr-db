<?php

declare(strict_types=1);

namespace HR\Regions;

interface IRegionsRepository
{
    public function insert(RegionsDto $dto): int;

    public function update(RegionsDto $dto): int;

    public function get(int $regionId): ?RegionsDto;

    public function getAll(): array;

    public function delete(int $regionId): int;
}