<?php

require_once 'Person.php';
require_once 'Employee.php';
require_once 'CommissionEmployee.php';
require_once 'HourlyEmployee.php';
require_once 'PieceWorker.php';
require_once 'EmployeeRoster.php';
require_once 'Main.php';

$entry = new Main();
$entry->start();