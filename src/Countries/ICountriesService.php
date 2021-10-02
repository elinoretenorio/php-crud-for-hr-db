<?php

declare(strict_types=1);

namespace HR\Countries;

interface ICountriesService
{
    public function insert(CountriesModel $model): int;

    public function update(CountriesModel $model): int;

    public function get(string $countryCode): ?CountriesModel;

    public function getAll(): array;

    public function delete(string $countryCode): int;

    public function createModel(array $row): ?CountriesModel;
}