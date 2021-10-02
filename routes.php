<?php

declare(strict_types=1);

$router->get("/regions", "HR\Regions\RegionsController::getAll");
$router->post("/regions", "HR\Regions\RegionsController::insert");
$router->group("/regions", function ($router) {
    $router->get("/{region_id:number}", "HR\Regions\RegionsController::get");
    $router->post("/{region_id:number}", "HR\Regions\RegionsController::update");
    $router->delete("/{region_id:number}", "HR\Regions\RegionsController::delete");
});

$router->get("/countries", "HR\Countries\CountriesController::getAll");
$router->post("/countries", "HR\Countries\CountriesController::insert");
$router->group("/countries", function ($router) {
    $router->get("/{country_code}", "HR\Countries\CountriesController::get");
    $router->post("/{country_code}", "HR\Countries\CountriesController::update");
    $router->delete("/{country_code}", "HR\Countries\CountriesController::delete");
});

$router->get("/locations", "HR\Locations\LocationsController::getAll");
$router->post("/locations", "HR\Locations\LocationsController::insert");
$router->group("/locations", function ($router) {
    $router->get("/{location_id:number}", "HR\Locations\LocationsController::get");
    $router->post("/{location_id:number}", "HR\Locations\LocationsController::update");
    $router->delete("/{location_id:number}", "HR\Locations\LocationsController::delete");
});

$router->get("/jobs", "HR\Jobs\JobsController::getAll");
$router->post("/jobs", "HR\Jobs\JobsController::insert");
$router->group("/jobs", function ($router) {
    $router->get("/{job_id:number}", "HR\Jobs\JobsController::get");
    $router->post("/{job_id:number}", "HR\Jobs\JobsController::update");
    $router->delete("/{job_id:number}", "HR\Jobs\JobsController::delete");
});

$router->get("/departments", "HR\Departments\DepartmentsController::getAll");
$router->post("/departments", "HR\Departments\DepartmentsController::insert");
$router->group("/departments", function ($router) {
    $router->get("/{department_id:number}", "HR\Departments\DepartmentsController::get");
    $router->post("/{department_id:number}", "HR\Departments\DepartmentsController::update");
    $router->delete("/{department_id:number}", "HR\Departments\DepartmentsController::delete");
});

$router->get("/employees", "HR\Employees\EmployeesController::getAll");
$router->post("/employees", "HR\Employees\EmployeesController::insert");
$router->group("/employees", function ($router) {
    $router->get("/{employee_id:number}", "HR\Employees\EmployeesController::get");
    $router->post("/{employee_id:number}", "HR\Employees\EmployeesController::update");
    $router->delete("/{employee_id:number}", "HR\Employees\EmployeesController::delete");
});

$router->get("/dependents", "HR\Dependents\DependentsController::getAll");
$router->post("/dependents", "HR\Dependents\DependentsController::insert");
$router->group("/dependents", function ($router) {
    $router->get("/{dependent_id:number}", "HR\Dependents\DependentsController::get");
    $router->post("/{dependent_id:number}", "HR\Dependents\DependentsController::update");
    $router->delete("/{dependent_id:number}", "HR\Dependents\DependentsController::delete");
});

