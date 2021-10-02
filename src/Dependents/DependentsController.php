<?php

declare(strict_types=1);

namespace HR\Dependents;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class DependentsController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private IDependentsService $service;

    public function __construct(IDependentsService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var DependentsModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $dependentId = (int) ($args["dependent_id"] ?? 0);
        if ($dependentId <= 0) {
            return new JsonResponse(["result" => $dependentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var DependentsModel $model */
        $model = $this->service->createModel($data);
        $model->setDependentId($dependentId);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $dependentId = (int) ($args["dependent_id"] ?? 0);
        if ($dependentId <= 0) {
            return new JsonResponse(["result" => $dependentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var DependentsModel $model */
        $model = $this->service->get($dependentId);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var DependentsModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $dependentId = (int) ($args["dependent_id"] ?? 0);
        if ($dependentId <= 0) {
            return new JsonResponse(["result" => $dependentId, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($dependentId);

        return new JsonResponse(["result" => $result]);
    }
}