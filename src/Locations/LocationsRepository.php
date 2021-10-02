<?php

declare(strict_types=1);

namespace HR\Locations;

use HR\Database\IDatabase;
use HR\Database\DatabaseException;

class LocationsRepository implements ILocationsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(LocationsDto $dto): int
    {
        $sql = "INSERT INTO `locations` (`street_address`, `postal_code`, `city`, `state_province`, `country_code`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->streetAddress,
                $dto->postalCode,
                $dto->city,
                $dto->stateProvince,
                $dto->countryCode
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(LocationsDto $dto): int
    {
        $sql = "UPDATE `locations` SET `street_address` = ?, `postal_code` = ?, `city` = ?, `state_province` = ?, `country_code` = ?
                WHERE `location_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->streetAddress,
                $dto->postalCode,
                $dto->city,
                $dto->stateProvince,
                $dto->countryCode,
                $dto->locationId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $locationId): ?LocationsDto
    {
        $sql = "SELECT `location_id`, `street_address`, `postal_code`, `city`, `state_province`, `country_code`
                FROM `locations` WHERE `location_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$locationId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new LocationsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `location_id`, `street_address`, `postal_code`, `city`, `state_province`, `country_code`
                FROM `locations`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new LocationsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $locationId): int
    {
        $sql = "DELETE FROM `locations` WHERE `location_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$locationId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}