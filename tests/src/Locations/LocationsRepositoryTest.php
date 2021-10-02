<?php

declare(strict_types=1);

namespace HR\Tests\Locations;

use PHPUnit\Framework\TestCase;
use HR\Database\DatabaseException;
use HR\Locations\{ LocationsDto, ILocationsRepository, LocationsRepository };

class LocationsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private LocationsDto $dto;
    private ILocationsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("HR\Database\IDatabase");
        $this->result = $this->createMock("HR\Database\IDatabaseResult");
        $this->input = [
            "location_id" => 9080,
            "street_address" => "score",
            "postal_code" => "land",
            "city" => "under",
            "state_province" => "cause",
            "country_code" => "source",
        ];
        $this->dto = new LocationsDto($this->input);
        $this->repository = new LocationsRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 7544;

        $sql = "INSERT INTO `locations` (`street_address`, `postal_code`, `city`, `state_province`, `country_code`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->streetAddress,
                $this->dto->postalCode,
                $this->dto->city,
                $this->dto->stateProvince,
                $this->dto->countryCode
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 1975;

        $sql = "UPDATE `locations` SET `street_address` = ?, `postal_code` = ?, `city` = ?, `state_province` = ?, `country_code` = ?
                WHERE `location_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->streetAddress,
                $this->dto->postalCode,
                $this->dto->city,
                $this->dto->stateProvince,
                $this->dto->countryCode,
                $this->dto->locationId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $locationId = 6239;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($locationId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $locationId = 4429;

        $sql = "SELECT `location_id`, `street_address`, `postal_code`, `city`, `state_province`, `country_code`
                FROM `locations` WHERE `location_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$locationId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($locationId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `location_id`, `street_address`, `postal_code`, `city`, `state_province`, `country_code`
                FROM `locations`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $locationId = 2255;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($locationId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $locationId = 5830;
        $expected = 5646;

        $sql = "DELETE FROM `locations` WHERE `location_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$locationId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($locationId);
        $this->assertEquals($expected, $actual);
    }
}