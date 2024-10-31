<?php

require_once 'Employee.php';

class CommissionEmployee extends Employee {
    private $commissionRate;
    private $sales;

    public function __construct($name, $address, $age, $companyName, $commissionRate) {
        parent::__construct($name, $address, $age, $companyName);
        $this->commissionRate = $commissionRate;
        $this->sales = 0;
    }

    public function recordSale($amount) {
        $this->sales += $amount;
    }

    public function earnings() {
        return $this->sales * $this->commissionRate;
    }
}
