<?php

declare(strict_types=1);

// Core

$container->add("Pdo", PDO::class)
    ->addArgument("mysql:dbname={$_ENV["DB_NAME"]};host={$_ENV["DB_HOST"]}")
    ->addArgument($_ENV["DB_USER"])
    ->addArgument($_ENV["DB_PASS"])
    ->addArgument([]);
$container->add("Database", HR\Database\PdoDatabase::class)
    ->addArgument("Pdo");

// Regions

$container->add("RegionsRepository", HR\Regions\RegionsRepository::class)
    ->addArgument("Database");
$container->add("RegionsService", HR\Regions\RegionsService::class)
    ->addArgument("RegionsRepository");
$container->add(HR\Regions\RegionsController::class)
    ->addArgument("RegionsService");

// Countries

$container->add("CountriesRepository", HR\Countries\CountriesRepository::class)
    ->addArgument("Database");
$container->add("CountriesService", HR\Countries\CountriesService::class)
    ->addArgument("CountriesRepository");
$container->add(HR\Countries\CountriesController::class)
    ->addArgument("CountriesService");

// Locations

$container->add("LocationsRepository", HR\Locations\LocationsRepository::class)
    ->addArgument("Database");
$container->add("LocationsService", HR\Locations\LocationsService::class)
    ->addArgument("LocationsRepository");
$container->add(HR\Locations\LocationsController::class)
    ->addArgument("LocationsService");

// Jobs

$container->add("JobsRepository", HR\Jobs\JobsRepository::class)
    ->addArgument("Database");
$container->add("JobsService", HR\Jobs\JobsService::class)
    ->addArgument("JobsRepository");
$container->add(HR\Jobs\JobsController::class)
    ->addArgument("JobsService");

// Departments

$container->add("DepartmentsRepository", HR\Departments\DepartmentsRepository::class)
    ->addArgument("Database");
$container->add("DepartmentsService", HR\Departments\DepartmentsService::class)
    ->addArgument("DepartmentsRepository");
$container->add(HR\Departments\DepartmentsController::class)
    ->addArgument("DepartmentsService");

// Employees

$container->add("EmployeesRepository", HR\Employees\EmployeesRepository::class)
    ->addArgument("Database");
$container->add("EmployeesService", HR\Employees\EmployeesService::class)
    ->addArgument("EmployeesRepository");
$container->add(HR\Employees\EmployeesController::class)
    ->addArgument("EmployeesService");

// Dependents

$container->add("DependentsRepository", HR\Dependents\DependentsRepository::class)
    ->addArgument("Database");
$container->add("DependentsService", HR\Dependents\DependentsService::class)
    ->addArgument("DependentsRepository");
$container->add(HR\Dependents\DependentsController::class)
    ->addArgument("DependentsService");

