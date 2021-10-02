<?php

declare(strict_types=1);

namespace HR\Countries;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Laminas\Diactoros\Response\JsonResponse;

class CountriesController 
{
    const ERROR_INVALID_INPUT = "Invalid input";

    private ICountriesService $service;

    public function __construct(ICountriesService $service)
    {
        $this->service = $service;        
    }

    public function insert(RequestInterface $request, array $args): ResponseInterface
    {
        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CountriesModel $model */
        $model = $this->service->createModel($data);

        $result = $this->service->insert($model);

        return new JsonResponse(["result" => $result]);
    }

    public function update(RequestInterface $request, array $args): ResponseInterface
    {
        $countryCode = $args["country_code"] ?? "";
        if (empty($countryCode)) {
            return new JsonResponse(["result" => $countryCode, "message" => self::ERROR_INVALID_INPUT]);
        }

        $data = json_decode($request->getBody()->getContents(), true);
        if (empty($data)) {
            $data = $request->getParsedBody();
        }

        /** @var CountriesModel $model */
        $model = $this->service->createModel($data);
        $model->setCountryCode($countryCode);

        $result = $this->service->update($model);

        return new JsonResponse(["result" => $result]);
    }

    public function get(RequestInterface $request, array $args): ResponseInterface
    {
        $countryCode = $args["country_code"] ?? "";
        if (empty($countryCode)) {
            return new JsonResponse(["result" => $countryCode, "message" => self::ERROR_INVALID_INPUT]);
        }

        /** @var CountriesModel $model */
        $model = $this->service->get($countryCode);

        return new JsonResponse(["result" => $model->jsonSerialize()]);
    }

    public function getAll(RequestInterface $request, array $args): ResponseInterface
    {
        $models = $this->service->getAll();

        $result = [];

        /** @var CountriesModel $model */
        foreach ($models as $model) {
            $result[] = $model->jsonSerialize();
        }

        return new JsonResponse(["result" => $result]);
    }

    public function delete(RequestInterface $request, array $args): ResponseInterface
    {
        $countryCode = $args["country_code"] ?? "";
        if (empty($countryCode)) {
            return new JsonResponse(["result" => $countryCode, "message" => self::ERROR_INVALID_INPUT]);
        }

        $result = $this->service->delete($countryCode);

        return new JsonResponse(["result" => $result]);
    }
}