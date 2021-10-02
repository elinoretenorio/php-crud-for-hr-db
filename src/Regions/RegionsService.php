<?php

declare(strict_types=1);

namespace HR\Regions;

class RegionsService implements IRegionsService
{
    private IRegionsRepository $repository;

    public function __construct(IRegionsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(RegionsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(RegionsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $regionId): ?RegionsModel
    {
        $dto = $this->repository->get($regionId);
        if ($dto === null) {
            return null;
        }

        return new RegionsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var RegionsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new RegionsModel($dto);
        }

        return $result;
    }

    public function delete(int $regionId): int
    {
        return $this->repository->delete($regionId);
    }

    public function createModel(array $row): ?RegionsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new RegionsDto($row);

        return new RegionsModel($dto);
    }
}