<?php

declare(strict_types=1);

namespace HR\Locations;

class LocationsService implements ILocationsService
{
    private ILocationsRepository $repository;

    public function __construct(ILocationsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(LocationsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(LocationsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $locationId): ?LocationsModel
    {
        $dto = $this->repository->get($locationId);
        if ($dto === null) {
            return null;
        }

        return new LocationsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var LocationsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new LocationsModel($dto);
        }

        return $result;
    }

    public function delete(int $locationId): int
    {
        return $this->repository->delete($locationId);
    }

    public function createModel(array $row): ?LocationsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new LocationsDto($row);

        return new LocationsModel($dto);
    }
}