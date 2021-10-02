<?php

declare(strict_types=1);

namespace HR\Employees;

class EmployeesDto 
{
    public int $employeeId;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phoneNumber;
    public string $hireDate;
    public int $jobId;
    public float $salary;
    public int $managerId;
    public int $departmentId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->employeeId = (int) ($row["employee_id"] ?? 0);
        $this->firstName = $row["first_name"] ?? "";
        $this->lastName = $row["last_name"] ?? "";
        $this->email = $row["email"] ?? "";
        $this->phoneNumber = $row["phone_number"] ?? "";
        $this->hireDate = $row["hire_date"] ?? "";
        $this->jobId = (int) ($row["job_id"] ?? 0);
        $this->salary = (float) ($row["salary"] ?? 0);
        $this->managerId = (int) ($row["manager_id"] ?? 0);
        $this->departmentId = (int) ($row["department_id"] ?? 0);
    }
}