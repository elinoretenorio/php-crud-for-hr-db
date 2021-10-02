<?php

declare(strict_types=1);

namespace HR\Locations;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class LocationsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ILocationsService $service;

    public function __construct(ILocationsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var LocationsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $locationId = (int) ($args["location_id"] ?? 0);
        if ($locationId <= 0) {
            return new JsonResponse(["result" => $locationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var LocationsModel $model */
        $model = $this->service->createModel($data);
        $model->setLocationId($locationId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $locationId = (int) ($args["location_id"] ?? 0);
        if ($locationId <= 0) {
            return new JsonResponse(["result" => $locationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var LocationsModel $model */
        $model = $this->service->get($locationId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var LocationsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $locationId = (int) ($args["location_id"] ?? 0);
        if ($locationId <= 0) {
            return new JsonResponse(["result" => $locationId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($locationId);

        return new JsonResponse(["result" => $result]);
    }
}