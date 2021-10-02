<?php

declare(strict_types=1);

namespace HR\Locations;

class LocationsDto 
{
    public int $locationId;
    public string $streetAddress;
    public string $postalCode;
    public string $city;
    public string $stateProvince;
    public string $countryCode;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->locationId = (int) ($row["location_id"] ?? 0);
        $this->streetAddress = $row["street_address"] ?? "";
        $this->postalCode = $row["postal_code"] ?? "";
        $this->city = $row["city"] ?? "";
        $this->stateProvince = $row["state_province"] ?? "";
        $this->countryCode = $row["country_code"] ?? "";
    }
}