<?php

declare(strict_types=1);

namespace HR\Regions;

use HR\Database\IDatabase;
use HR\Database\DatabaseException;

class RegionsRepository implements IRegionsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(RegionsDto $dto): int
    {
        $sql = "INSERT INTO `regions` (`region_name`)
                VALUES (?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->regionName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(RegionsDto $dto): int
    {
        $sql = "UPDATE `regions` SET `region_name` = ?
                WHERE `region_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->regionName,
                $dto->regionId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $regionId): ?RegionsDto
    {
        $sql = "SELECT `region_id`, `region_name`
                FROM `regions` WHERE `region_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$regionId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new RegionsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `region_id`, `region_name`
                FROM `regions`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new RegionsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $regionId): int
    {
        $sql = "DELETE FROM `regions` WHERE `region_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$regionId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}