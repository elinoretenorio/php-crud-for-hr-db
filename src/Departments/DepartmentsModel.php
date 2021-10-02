<?php

declare(strict_types=1);

namespace HR\Departments;

use JsonSerializable;

class DepartmentsModel implements JsonSerializable
{
    private int $departmentId;
    private string $departmentName;
    private int $locationId;

    public function __construct(DepartmentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->departmentId = $dto->departmentId;
        $this->departmentName = $dto->departmentName;
        $this->locationId = $dto->locationId;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getDepartmentName(): string
    {
        return $this->departmentName;
    }

    public function setDepartmentName(string $departmentName): void
    {
        $this->departmentName = $departmentName;
    }

    public function getLocationId(): int
    {
        return $this->locationId;
    }

    public function setLocationId(int $locationId): void
    {
        $this->locationId = $locationId;
    }

    public function toDto(): DepartmentsDto
    {
        $dto = new DepartmentsDto();
        $dto->departmentId = (int) ($this->departmentId ?? 0);
        $dto->departmentName = $this->departmentName ?? "";
        $dto->locationId = (int) ($this->locationId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "department_id" => $this->departmentId,
            "department_name" => $this->departmentName,
            "location_id" => $this->locationId,
        ];
    }
}