<?php

declare(strict_types=1);

namespace HR\Countries;

interface ICountriesRepository
{
    public function insert(CountriesDto $dto): int;

    public function update(CountriesDto $dto): int;

    public function get(string $countryCode): ?CountriesDto;

    public function getAll(): array;

    public function delete(string $countryCode): int;
}