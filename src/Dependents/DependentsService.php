<?php

declare(strict_types=1);

namespace HR\Dependents;

class DependentsService implements IDependentsService
{
    private IDependentsRepository $repository;

    public function __construct(IDependentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(DependentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(DependentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $dependentId): ?DependentsModel
    {
        $dto = $this->repository->get($dependentId);
        if ($dto === null) {
            return null;
        }

        return new DependentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var DependentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new DependentsModel($dto);
        }

        return $result;
    }

    public function delete(int $dependentId): int
    {
        return $this->repository->delete($dependentId);
    }

    public function createModel(array $row): ?DependentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new DependentsDto($row);

        return new DependentsModel($dto);
    }
}