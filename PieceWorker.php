<?php

require_once 'Employee.php';

class PieceWorker extends Employee {
    private $pieceRate;

    public function __construct($name, $address, $age, $companyName, $pieceRate) {
        parent::__construct($name, $address, $age, $companyName);
        $this->pieceRate = $pieceRate;
    }

    public function getDetails() {
        return "Piece Worker: $this->name, Age: $this->age, Company: $this->companyName, Piece Rate: $this->pieceRate";
    }
}