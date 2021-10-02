<?php

declare(strict_types=1);

namespace HR\Jobs;

use HR\Database\IDatabase;
use HR\Database\DatabaseException;

class JobsRepository implements IJobsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(JobsDto $dto): int
    {
        $sql = "INSERT INTO `jobs` (`job_title`, `min_salary`, `max_salary`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->jobTitle,
                $dto->minSalary,
                $dto->maxSalary
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(JobsDto $dto): int
    {
        $sql = "UPDATE `jobs` SET `job_title` = ?, `min_salary` = ?, `max_salary` = ?
                WHERE `job_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->jobTitle,
                $dto->minSalary,
                $dto->maxSalary,
                $dto->jobId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $jobId): ?JobsDto
    {
        $sql = "SELECT `job_id`, `job_title`, `min_salary`, `max_salary`
                FROM `jobs` WHERE `job_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$jobId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new JobsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `job_id`, `job_title`, `min_salary`, `max_salary`
                FROM `jobs`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new JobsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $jobId): int
    {
        $sql = "DELETE FROM `jobs` WHERE `job_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$jobId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}