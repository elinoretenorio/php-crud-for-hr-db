<?php

declare(strict_types=1);

namespace HR\Regions;

class RegionsDto 
{
    public int $regionId;
    public string $regionName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->regionId = (int) ($row["region_id"] ?? 0);
        $this->regionName = $row["region_name"] ?? "";
    }
}