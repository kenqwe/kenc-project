<?php

abstract class Employee {
    protected $name;
    protected $address;
    protected $age;
    protected $companyName;

    public function __construct($name, $address, $age, $companyName) {
        $this->name = $name;
        $this->address = $address;
        $this->age = $age;
        $this->companyName = $companyName;
    }

    abstract public function getDetails();
}

