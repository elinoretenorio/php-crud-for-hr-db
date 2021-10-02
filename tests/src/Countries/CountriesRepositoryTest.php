<?php

declare(strict_types=1);

namespace HR\Tests\Countries;

use PHPUnit\Framework\TestCase;
use HR\Database\DatabaseException;
use HR\Countries\{ CountriesDto, ICountriesRepository, CountriesRepository };

class CountriesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CountriesDto $dto;
    private ICountriesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("HR\Database\IDatabase");
        $this->result = $this->createMock("HR\Database\IDatabaseResult");
        $this->input = [
            "country_id" => 1112,
            "country_code" => "firm",
            "country_name" => "for",
            "region_id" => 1893,
        ];
        $this->dto = new CountriesDto($this->input);
        $this->repository = new CountriesRepository($this->db);
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
        $expected = 3285;

        $sql = "INSERT INTO `countries` (`country_id`, `country_name`, `region_id`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->countryId,
                $this->dto->countryName,
                $this->dto->regionId
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
        $expected = 2274;

        $sql = "UPDATE `countries` SET `country_id` = ?, `country_name` = ?, `region_id` = ?
                WHERE `country_code` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->countryId,
                $this->dto->countryName,
                $this->dto->regionId,
                $this->dto->countryCode
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $countryCode = "raise";

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($countryCode);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $countryCode = "feeling";

        $sql = "SELECT `country_id`, `country_code`, `country_name`, `region_id`
                FROM `countries` WHERE `country_code` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$countryCode]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($countryCode);
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
        $sql = "SELECT `country_id`, `country_code`, `country_name`, `region_id`
                FROM `countries`";

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
        $countryCode = "interest";
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($countryCode);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $countryCode = "culture";
        $expected = 4379;

        $sql = "DELETE FROM `countries` WHERE `country_code` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$countryCode]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($countryCode);
        $this->assertEquals($expected, $actual);
    }
}