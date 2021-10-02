<?php

declare(strict_types=1);

namespace HR\Dependents;

use HR\Database\IDatabase;
use HR\Database\DatabaseException;

class DependentsRepository implements IDependentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(DependentsDto $dto): int
    {
        $sql = "INSERT INTO `dependents` (`first_name`, `last_name`, `relationship`, `employee_id`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->relationship,
                $dto->employeeId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(DependentsDto $dto): int
    {
        $sql = "UPDATE `dependents` SET `first_name` = ?, `last_name` = ?, `relationship` = ?, `employee_id` = ?
                WHERE `dependent_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->firstName,
                $dto->lastName,
                $dto->relationship,
                $dto->employeeId,
                $dto->dependentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $dependentId): ?DependentsDto
    {
        $sql = "SELECT `dependent_id`, `first_name`, `last_name`, `relationship`, `employee_id`
                FROM `dependents` WHERE `dependent_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$dependentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new DependentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `dependent_id`, `first_name`, `last_name`, `relationship`, `employee_id`
                FROM `dependents`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new DependentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $dependentId): int
    {
        $sql = "DELETE FROM `dependents` WHERE `dependent_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$dependentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}