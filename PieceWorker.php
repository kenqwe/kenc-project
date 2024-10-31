<?php

require_once 'Employee.php';

class PieceWorker extends Employee {
    private $piecesProduced;
    private $payPerPiece;

    public function __construct($name, $address, $age, $companyName, $payPerPiece) {
        parent::__construct($name, $address, $age, $companyName);
        $this->piecesProduced = 0;
        $this->payPerPiece = $payPerPiece;
    }

    public function recordPieces($pieces) {
        $this->piecesProduced += $pieces;
    }

    public function earnings() {
        return $this->piecesProduced * $this->payPerPiece;
    }
}
