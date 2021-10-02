<?php

declare(strict_types=1);

namespace HR\Employees;

use JsonSerializable;

class EmployeesModel implements JsonSerializable
{
    private int $employeeId;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $phoneNumber;
    private string $hireDate;
    private int $jobId;
    private float $salary;
    private int $managerId;
    private int $departmentId;

    public function __construct(EmployeesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->employeeId = $dto->employeeId;
        $this->firstName = $dto->firstName;
        $this->lastName = $dto->lastName;
        $this->email = $dto->email;
        $this->phoneNumber = $dto->phoneNumber;
        $this->hireDate = $dto->hireDate;
        $this->jobId = $dto->jobId;
        $this->salary = $dto->salary;
        $this->managerId = $dto->managerId;
        $this->departmentId = $dto->departmentId;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getHireDate(): string
    {
        return $this->hireDate;
    }

    public function setHireDate(string $hireDate): void
    {
        $this->hireDate = $hireDate;
    }

    public function getJobId(): int
    {
        return $this->jobId;
    }

    public function setJobId(int $jobId): void
    {
        $this->jobId = $jobId;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): void
    {
        $this->salary = $salary;
    }

    public function getManagerId(): int
    {
        return $this->managerId;
    }

    public function setManagerId(int $managerId): void
    {
        $this->managerId = $managerId;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function toDto(): EmployeesDto
    {
        $dto = new EmployeesDto();
        $dto->employeeId = (int) ($this->employeeId ?? 0);
        $dto->firstName = $this->firstName ?? "";
        $dto->lastName = $this->lastName ?? "";
        $dto->email = $this->email ?? "";
        $dto->phoneNumber = $this->phoneNumber ?? "";
        $dto->hireDate = $this->hireDate ?? "";
        $dto->jobId = (int) ($this->jobId ?? 0);
        $dto->salary = (float) ($this->salary ?? 0);
        $dto->managerId = (int) ($this->managerId ?? 0);
        $dto->departmentId = (int) ($this->departmentId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "employee_id" => $this->employeeId,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "email" => $this->email,
            "phone_number" => $this->phoneNumber,
            "hire_date" => $this->hireDate,
            "job_id" => $this->jobId,
            "salary" => $this->salary,
            "manager_id" => $this->managerId,
            "department_id" => $this->departmentId,
        ];
    }
}