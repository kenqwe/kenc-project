<?php

require_once 'Employee.php';

class HourlyEmployee extends Employee {
    private $hourlyRate;

    public function __construct($name, $address, $age, $companyName, $hourlyRate) {
        parent::__construct($name, $address, $age, $companyName);
        $this->hourlyRate = $hourlyRate;
    }

    public function getDetails() {
        return "Hourly Employee: $this->name, Age: $this->age, Company: $this->companyName, Hourly Rate: $this->hourlyRate";
    }
}