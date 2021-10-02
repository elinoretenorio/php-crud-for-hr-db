<?php

declare(strict_types=1);

namespace HR\Regions;

use JsonSerializable;

class RegionsModel implements JsonSerializable
{
    private int $regionId;
    private string $regionName;

    public function __construct(RegionsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->regionId = $dto->regionId;
        $this->regionName = $dto->regionName;
    }

    public function getRegionId(): int
    {
        return $this->regionId;
    }

    public function setRegionId(int $regionId): void
    {
        $this->regionId = $regionId;
    }

    public function getRegionName(): string
    {
        return $this->regionName;
    }

    public function setRegionName(string $regionName): void
    {
        $this->regionName = $regionName;
    }

    public function toDto(): RegionsDto
    {
        $dto = new RegionsDto();
        $dto->regionId = (int) ($this->regionId ?? 0);
        $dto->regionName = $this->regionName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "region_id" => $this->regionId,
            "region_name" => $this->regionName,
        ];
    }
}