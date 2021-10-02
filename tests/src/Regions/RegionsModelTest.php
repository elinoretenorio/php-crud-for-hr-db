<?php

declare(strict_types=1);

namespace HR\Tests\Regions;

use PHPUnit\Framework\TestCase;
use HR\Regions\{ RegionsDto, RegionsModel };

class RegionsModelTest extends TestCase
{
    private array $input;
    private RegionsDto $dto;
    private RegionsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "region_id" => 3244,
            "region_name" => "approach",
        ];
        $this->dto = new RegionsDto($this->input);
        $this->model = new RegionsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new RegionsModel(null);

        $this->assertInstanceOf(RegionsModel::class, $model);
    }

    public function testGetRegionId(): void
    {
        $this->assertEquals($this->dto->regionId, $this->model->getRegionId());
    }

    public function testSetRegionId(): void
    {
        $expected = 643;
        $model = $this->model;
        $model->setRegionId($expected);

        $this->assertEquals($expected, $model->getRegionId());
    }

    public function testGetRegionName(): void
    {
        $this->assertEquals($this->dto->regionName, $this->model->getRegionName());
    }

    public function testSetRegionName(): void
    {
        $expected = "avoid";
        $model = $this->model;
        $model->setRegionName($expected);

        $this->assertEquals($expected, $model->getRegionName());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}