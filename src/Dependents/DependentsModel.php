<?php

declare(strict_types=1);

namespace HR\Dependents;

use JsonSerializable;

class DependentsModel implements JsonSerializable
{
    private int $dependentId;
    private string $firstName;
    private string $lastName;
    private string $relationship;
    private int $employeeId;

    public function __construct(DependentsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->dependentId = $dto->dependentId;
        $this->firstName = $dto->firstName;
        $this->lastName = $dto->lastName;
        $this->relationship = $dto->relationship;
        $this->employeeId = $dto->employeeId;
    }

    public function getDependentId(): int
    {
        return $this->dependentId;
    }

    public function setDependentId(int $dependentId): void
    {
        $this->dependentId = $dependentId;
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

    public function getRelationship(): string
    {
        return $this->relationship;
    }

    public function setRelationship(string $relationship): void
    {
        $this->relationship = $relationship;
    }

    public function getEmployeeId(): int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    public function toDto(): DependentsDto
    {
        $dto = new DependentsDto();
        $dto->dependentId = (int) ($this->dependentId ?? 0);
        $dto->firstName = $this->firstName ?? "";
        $dto->lastName = $this->lastName ?? "";
        $dto->relationship = $this->relationship ?? "";
        $dto->employeeId = (int) ($this->employeeId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "dependent_id" => $this->dependentId,
            "first_name" => $this->firstName,
            "last_name" => $this->lastName,
            "relationship" => $this->relationship,
            "employee_id" => $this->employeeId,
        ];
    }
}