<?php

declare(strict_types=1);

namespace HR\Dependents;

class DependentsDto 
{
    public int $dependentId;
    public string $firstName;
    public string $lastName;
    public string $relationship;
    public int $employeeId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->dependentId = (int) ($row["dependent_id"] ?? 0);
        $this->firstName = $row["first_name"] ?? "";
        $this->lastName = $row["last_name"] ?? "";
        $this->relationship = $row["relationship"] ?? "";
        $this->employeeId = (int) ($row["employee_id"] ?? 0);
    }
}