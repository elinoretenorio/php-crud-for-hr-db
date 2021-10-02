<?php

declare(strict_types=1);

namespace HR\Countries;

use HR\Database\IDatabase;
use HR\Database\DatabaseException;

class CountriesRepository implements ICountriesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CountriesDto $dto): int
    {
        $sql = "INSERT INTO `countries` (`country_id`, `country_name`, `region_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->countryId,
                $dto->countryName,
                $dto->regionId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CountriesDto $dto): int
    {
        $sql = "UPDATE `countries` SET `country_id` = ?, `country_name` = ?, `region_id` = ?
                WHERE `country_code` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->countryId,
                $dto->countryName,
                $dto->regionId,
                $dto->countryCode
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(string $countryCode): ?CountriesDto
    {
        $sql = "SELECT `country_id`, `country_code`, `country_name`, `region_id`
                FROM `countries` WHERE `country_code` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$countryCode]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CountriesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `country_id`, `country_code`, `country_name`, `region_id`
                FROM `countries`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CountriesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(string $countryCode): int
    {
        $sql = "DELETE FROM `countries` WHERE `country_code` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$countryCode]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}