<?php

declare(strict_types=1);

namespace HR\Departments;

use HR\Database\IDatabase;
use HR\Database\DatabaseException;

class DepartmentsRepository implements IDepartmentsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(DepartmentsDto $dto): int
    {
        $sql = "INSERT INTO `departments` (`department_name`, `location_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->departmentName,
                $dto->locationId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(DepartmentsDto $dto): int
    {
        $sql = "UPDATE `departments` SET `department_name` = ?, `location_id` = ?
                WHERE `department_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->departmentName,
                $dto->locationId,
                $dto->departmentId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $departmentId): ?DepartmentsDto
    {
        $sql = "SELECT `department_id`, `department_name`, `location_id`
                FROM `departments` WHERE `department_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$departmentId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new DepartmentsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `department_id`, `department_name`, `location_id`
                FROM `departments`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new DepartmentsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $departmentId): int
    {
        $sql = "DELETE FROM `departments` WHERE `department_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$departmentId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}