<?php

declare(strict_types=1);

namespace HR\Employees;

use HR\Database\IDatabase;
use HR\Database\DatabaseException;

class EmployeesRepository implements IEmployeesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(EmployeesDto $dto): int
    {
        $sql = "INSERT INTO `employees` (`first_name`, `last_name`, `email`, `phone_number`, `hire_date`, `job_id`, `salary`, `manager_id`, `department_id`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->email,
                $dto->phoneNumber,
                $dto->hireDate,
                $dto->jobId,
                $dto->salary,
                $dto->managerId,
                $dto->departmentId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(EmployeesDto $dto): int
    {
        $sql = "UPDATE `employees` SET `first_name` = ?, `last_name` = ?, `email` = ?, `phone_number` = ?, `hire_date` = ?, `job_id` = ?, `salary` = ?, `manager_id` = ?, `department_id` = ?
                WHERE `employee_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->email,
                $dto->phoneNumber,
                $dto->hireDate,
                $dto->jobId,
                $dto->salary,
                $dto->managerId,
                $dto->departmentId,
                $dto->employeeId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $employeeId): ?EmployeesDto
    {
        $sql = "SELECT `employee_id`, `first_name`, `last_name`, `email`, `phone_number`, `hire_date`, `job_id`, `salary`, `manager_id`, `department_id`
                FROM `employees` WHERE `employee_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new EmployeesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `employee_id`, `first_name`, `last_name`, `email`, `phone_number`, `hire_date`, `job_id`, `salary`, `manager_id`, `department_id`
                FROM `employees`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new EmployeesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $employeeId): int
    {
        $sql = "DELETE FROM `employees` WHERE `employee_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$employeeId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}