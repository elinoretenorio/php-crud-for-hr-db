curl -X GET "localhost:8080/regions"

curl -X POST "localhost:8080/regions" -H 'Content-Type: application/json' -d'
{
  "region_name": "religious"
}
'

curl -X POST "localhost:8080/regions/6584" -H 'Content-Type: application/json' -d'
{
  "region_id": 6584,
  "region_name": "religious"
}
'

curl -X GET "localhost:8080/regions/6584"

curl -X DELETE "localhost:8080/regions/6584"

# --

curl -X GET "localhost:8080/countries"

curl -X POST "localhost:8080/countries" -H 'Content-Type: application/json' -d'
{
  "country_id": 5002,
  "country_name": "mention",
  "region_id": 2503
}
'

curl -X POST "localhost:8080/countries/believe" -H 'Content-Type: application/json' -d'
{
  "country_code": "believe",
  "country_id": 5002,
  "country_name": "mention",
  "region_id": 2503
}
'

curl -X GET "localhost:8080/countries/believe"

curl -X DELETE "localhost:8080/countries/believe"

# --

curl -X GET "localhost:8080/locations"

curl -X POST "localhost:8080/locations" -H 'Content-Type: application/json' -d'
{
  "city": "condition",
  "country_code": "wait",
  "postal_code": "think",
  "state_province": "expert",
  "street_address": "see"
}
'

curl -X POST "localhost:8080/locations/4092" -H 'Content-Type: application/json' -d'
{
  "city": "condition",
  "country_code": "wait",
  "location_id": 4092,
  "postal_code": "think",
  "state_province": "expert",
  "street_address": "see"
}
'

curl -X GET "localhost:8080/locations/4092"

curl -X DELETE "localhost:8080/locations/4092"

# --

curl -X GET "localhost:8080/jobs"

curl -X POST "localhost:8080/jobs" -H 'Content-Type: application/json' -d'
{
  "job_title": "card",
  "max_salary": 976.5,
  "min_salary": 252.66712
}
'

curl -X POST "localhost:8080/jobs/441" -H 'Content-Type: application/json' -d'
{
  "job_id": 441,
  "job_title": "card",
  "max_salary": 976.5,
  "min_salary": 252.66712
}
'

curl -X GET "localhost:8080/jobs/441"

curl -X DELETE "localhost:8080/jobs/441"

# --

curl -X GET "localhost:8080/departments"

curl -X POST "localhost:8080/departments" -H 'Content-Type: application/json' -d'
{
  "department_name": "concern",
  "location_id": 5055
}
'

curl -X POST "localhost:8080/departments/9470" -H 'Content-Type: application/json' -d'
{
  "department_id": 9470,
  "department_name": "concern",
  "location_id": 5055
}
'

curl -X GET "localhost:8080/departments/9470"

curl -X DELETE "localhost:8080/departments/9470"

# --

curl -X GET "localhost:8080/employees"

curl -X POST "localhost:8080/employees" -H 'Content-Type: application/json' -d'
{
  "department_id": 2462,
  "email": "wdaugherty@example.org",
  "first_name": "moment",
  "hire_date": "2021-09-16",
  "job_id": 7135,
  "last_name": "protect",
  "manager_id": 5499,
  "phone_number": "city",
  "salary": 497.0
}
'

curl -X POST "localhost:8080/employees/7638" -H 'Content-Type: application/json' -d'
{
  "department_id": 2462,
  "email": "wdaugherty@example.org",
  "employee_id": 7638,
  "first_name": "moment",
  "hire_date": "2021-09-16",
  "job_id": 7135,
  "last_name": "protect",
  "manager_id": 5499,
  "phone_number": "city",
  "salary": 497.0
}
'

curl -X GET "localhost:8080/employees/7638"

curl -X DELETE "localhost:8080/employees/7638"

# --

curl -X GET "localhost:8080/dependents"

curl -X POST "localhost:8080/dependents" -H 'Content-Type: application/json' -d'
{
  "employee_id": 8735,
  "first_name": "body",
  "last_name": "young",
  "relationship": "agree"
}
'

curl -X POST "localhost:8080/dependents/4930" -H 'Content-Type: application/json' -d'
{
  "dependent_id": 4930,
  "employee_id": 8735,
  "first_name": "body",
  "last_name": "young",
  "relationship": "agree"
}
'

curl -X GET "localhost:8080/dependents/4930"

curl -X DELETE "localhost:8080/dependents/4930"

# --

