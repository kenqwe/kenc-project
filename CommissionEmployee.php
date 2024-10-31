<?php

require_once 'Employee.php';

class CommissionEmployee extends Employee {
    private $commissionRate;

    public function __construct($name, $address, $age, $companyName, $commissionRate) {
        parent::__construct($name, $address, $age, $companyName);
        $this->commissionRate = $commissionRate;
    }

    public function getDetails() {
        return "Commission Employee: $this->name, Age: $this->age, Company: $this->companyName, Rate: $this->commissionRate";
    }
}

