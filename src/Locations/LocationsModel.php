<?php

declare(strict_types=1);

namespace HR\Locations;

use JsonSerializable;

class LocationsModel implements JsonSerializable
{
    private int $locationId;
    private string $streetAddress;
    private string $postalCode;
    private string $city;
    private string $stateProvince;
    private string $countryCode;

    public function __construct(LocationsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->locationId = $dto->locationId;
        $this->streetAddress = $dto->streetAddress;
        $this->postalCode = $dto->postalCode;
        $this->city = $dto->city;
        $this->stateProvince = $dto->stateProvince;
        $this->countryCode = $dto->countryCode;
    }

    public function getLocationId(): int
    {
        return $this->locationId;
    }

    public function setLocationId(int $locationId): void
    {
        $this->locationId = $locationId;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function setStreetAddress(string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getStateProvince(): string
    {
        return $this->stateProvince;
    }

    public function setStateProvince(string $stateProvince): void
    {
        $this->stateProvince = $stateProvince;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function toDto(): LocationsDto
    {
        $dto = new LocationsDto();
        $dto->locationId = (int) ($this->locationId ?? 0);
        $dto->streetAddress = $this->streetAddress ?? "";
        $dto->postalCode = $this->postalCode ?? "";
        $dto->city = $this->city ?? "";
        $dto->stateProvince = $this->stateProvince ?? "";
        $dto->countryCode = $this->countryCode ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "location_id" => $this->locationId,
            "street_address" => $this->streetAddress,
            "postal_code" => $this->postalCode,
            "city" => $this->city,
            "state_province" => $this->stateProvince,
            "country_code" => $this->countryCode,
        ];
    }
}