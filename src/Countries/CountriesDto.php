<?php

declare(strict_types=1);

namespace HR\Countries;

class CountriesDto 
{
    public int $countryId;
    public string $countryCode;
    public string $countryName;
    public int $regionId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->countryId = (int) ($row["country_id"] ?? 0);
        $this->countryCode = $row["country_code"] ?? "";
        $this->countryName = $row["country_name"] ?? "";
        $this->regionId = (int) ($row["region_id"] ?? 0);
    }
}