<?php

declare(strict_types=1);

namespace HR\Departments;

class DepartmentsDto 
{
    public int $departmentId;
    public string $departmentName;
    public int $locationId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->departmentId = (int) ($row["department_id"] ?? 0);
        $this->departmentName = $row["department_name"] ?? "";
        $this->locationId = (int) ($row["location_id"] ?? 0);
    }
}