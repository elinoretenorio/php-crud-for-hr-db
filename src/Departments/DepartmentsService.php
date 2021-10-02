<?php

declare(strict_types=1);

namespace HR\Departments;

class DepartmentsService implements IDepartmentsService
{
    private IDepartmentsRepository $repository;

    public function __construct(IDepartmentsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(DepartmentsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(DepartmentsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $departmentId): ?DepartmentsModel
    {
        $dto = $this->repository->get($departmentId);
        if ($dto === null) {
            return null;
        }

        return new DepartmentsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var DepartmentsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new DepartmentsModel($dto);
        }

        return $result;
    }

    public function delete(int $departmentId): int
    {
        return $this->repository->delete($departmentId);
    }

    public function createModel(array $row): ?DepartmentsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new DepartmentsDto($row);

        return new DepartmentsModel($dto);
    }
}