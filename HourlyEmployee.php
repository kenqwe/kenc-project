<?php

require_once 'Employee.php';

class HourlyEmployee extends Employee {
    private $hourlyRate;
    private $hoursWorked;

    public function __construct($name, $address, $age, $companyName, $hourlyRate) {
        parent::__construct($name, $address, $age, $companyName);
        $this->hourlyRate = $hourlyRate;
        $this->hoursWorked = 0;
    }

    public function recordHours($hours) {
        $this->hoursWorked += $hours;
    }

    public function earnings() {
        return $this->hourlyRate * $this->hoursWorked;
    }
}
