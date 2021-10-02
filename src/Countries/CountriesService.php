<?php

declare(strict_types=1);

namespace HR\Countries;

class CountriesService implements ICountriesService
{
    private ICountriesRepository $repository;

    public function __construct(ICountriesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(CountriesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(CountriesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(string $countryCode): ?CountriesModel
    {
        $dto = $this->repository->get($countryCode);
        if ($dto === null) {
            return null;
        }

        return new CountriesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var CountriesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new CountriesModel($dto);
        }

        return $result;
    }

    public function delete(string $countryCode): int
    {
        return $this->repository->delete($countryCode);
    }

    public function createModel(array $row): ?CountriesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new CountriesDto($row);

        return new CountriesModel($dto);
    }
}