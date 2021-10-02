<?php

declare(strict_types=1);

namespace HR\Countries;

use JsonSerializable;

class CountriesModel implements JsonSerializable
{
    private int $countryId;
    private string $countryCode;
    private string $countryName;
    private int $regionId;

    public function __construct(CountriesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->countryId = $dto->countryId;
        $this->countryCode = $dto->countryCode;
        $this->countryName = $dto->countryName;
        $this->regionId = $dto->regionId;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function setCountryId(int $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): void
    {
        $this->countryName = $countryName;
    }

    public function getRegionId(): int
    {
        return $this->regionId;
    }

    public function setRegionId(int $regionId): void
    {
        $this->regionId = $regionId;
    }

    public function toDto(): CountriesDto
    {
        $dto = new CountriesDto();
        $dto->countryId = (int) ($this->countryId ?? 0);
        $dto->countryCode = $this->countryCode ?? "";
        $dto->countryName = $this->countryName ?? "";
        $dto->regionId = (int) ($this->regionId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "country_id" => $this->countryId,
            "country_code" => $this->countryCode,
            "country_name" => $this->countryName,
            "region_id" => $this->regionId,
        ];
    }
}