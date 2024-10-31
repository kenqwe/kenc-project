<?php

require_once 'EmployeeRoster.php';
require_once 'Employee.php';

class Main {
    private EmployeeRoster $roster;
    private $size;
    private $repeat;

    public function __construct() {
        $this->roster = new EmployeeRoster();
    }

    public function start() {
        $this->clear();
        $this->repeat = true;

        $this->size = (int)readline("Enter the size of the roster: ");

        if ($this->size < 1) {
            echo "Invalid input. Please try again.\n";
            readline("Press \"Enter\" key to continue...");
            $this->start();
        } else {
            $this->entrance();
        }
    }

    public function entrance() {
        $choice = 0;

        while ($this->repeat) {
            $this->clear();
            $this->menu();

            $choice = (int)readline("Select an option: ");

            switch ($choice) {
                case 1:
                    $this->addMenu();
                    break;
                case 2:
                    $this->deleteMenu();
                    break;
                case 3:
                    $this->otherMenu();
                    break;
                case 0:
                    echo "Exiting...\n";
                    $this->repeat = false;
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    readline("Press \"Enter\" key to continue...");
                    break;
            }
        }
        echo "Process terminated.\n";
        exit;
    }

    public function menu() {
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] Other Menu\n";
        echo "[0] Exit\n";
    }

    public function addMenu() {
        $this->clear();
        echo "*** Add Employee ***\n";

        $name = readline("Enter name: ");
        $address = readline("Enter address: ");
        $age = (int)readline("Enter age: ");
        $cName = readline("Enter company name: ");

        $this->empType($name, $address, $age, $cName);
    }

    public function empType($name, $address, $age, $cName) {
        $this->clear();
        echo "--- Employee Details ---\n";
        echo "Enter name: $name\n";
        echo "Enter address: $address\n";
        echo "Enter company name: $cName\n";
        echo "Enter age: $age\n";
        echo "[1] Commission Employee\n";
        echo "[2] Hourly Employee\n";
        echo "[3] Piece Worker\n";
        $type = (int)readline("Type of Employee: ");

        switch ($type) {
            case 1:
                $employee = new CommissionEmployee($name, $address, $age, $cName, 0.1);
                break;
            case 2:
                $employee = new HourlyEmployee($name, $address, $age, $cName, 20);
                break;
            case 3:
                $employee = new PieceWorker($name, $address, $age, $cName, 5);
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->addMenu();
                return;
        }

        $this->roster->add($employee);
        $this->repeat();
    }

    public function deleteMenu() {
        $this->clear();

        echo "*** List of Employees on the current Roster ***\n";
        $employees = $this->roster->getAll();
        foreach ($employees as $index => $employee) {
            echo "[$index] " . $employee->getDetails() . "\n";
        }

        echo "\n[0] Return\n";
        $index = (int)readline("Enter the index of the employee to delete: ");
        if ($index != 0) {
            $this->roster->delete($index);
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->deleteMenu();
    }

    public function otherMenu() {
        $this->clear();
        echo "[1] Display\n";
        echo "[2] Count\n";
        echo "[0] Return\n";
        $choice = (int)readline("Select Menu: ");

        switch ($choice) {
            case 1:
                $this->displayMenu();
                break;
            case 2:
                $this->countMenu();
                break;
            case 0:
                break;

            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->otherMenu();
                break;
        }
    }

    public function displayMenu() {
        $this->clear();
        echo "[1] Display All Employees\n";
        echo "[2] Display Commission Employees\n";
        echo "[3] Display Hourly Employees\n";
        echo "[4] Display Piece Workers\n";
        echo "[0] Return\n";
        $choice = (int)readline("Select Menu: ");

        switch ($choice) {
            case 0:
                break;
            case 1:
                $employees = $this->roster->getAll();
                foreach ($employees as $employee) {
                    echo $employee->getDetails() . "\n";
                }
                break;
            case 2:
                $this->displaySpecificEmployees('CommissionEmployee');
                break;
            case 3:
                $this->displaySpecificEmployees('HourlyEmployee');
                break;
            case 4:
                $this->displaySpecificEmployees('PieceWorker');
                break;
            default:
                echo "Invalid Input!\n";
                break;
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->displayMenu();
    }

    public function displaySpecificEmployees($type) {
        $employees = $this->roster->getAll();
        foreach ($employees as $employee) {
            if (get_class($employee) === $type) {
                echo $employee->getDetails() . "\n";
            }
        }
    }

    public function countMenu() {
        $this->clear();
        echo "[1] Count All Employees\n";
        echo "[2] Count Commission Employees\n";
        echo "[3] Count Hourly Employees\n";
        echo "[4] Count Piece Workers\n";
        echo "[0] Return\n";
        $choice = (int)readline("Select Menu: ");

        switch ($choice) {
            case 0:
                break;
            case 1:
                echo "Total employees: " . $this->roster->count() . "\n";
                break;
            case 2:
                echo "Total commission employees: " . $this->roster->countByType('CommissionEmployee') . "\n";
                break;
            case 3:
                echo "Total hourly employees: " . $this->roster->countByType('HourlyEmployee') . "\n";
                break;
            case 4:
                echo "Total piece workers: " . $this->roster->countByType('PieceWorker') . "\n";
                break;
            default:
                echo "Invalid Input!\n";
                break;
        }

        readline("\nPress \"Enter\" key to continue...");
        $this->countMenu();
    }

    public function clear() {
        system('clear');
    }

    public function repeat() {
        echo "Employee Added!\n";
        if ($this->roster->count() < $this->size) {
            $c = readline("Add more? (y to continue): ");
            if (strtolower($c) == 'y') {
                $this->addMenu();
            } else {
                $this->entrance();
            }
        } else {
            echo "Roster is Full\n";
            readline("Press \"Enter\" key to continue...");
            $this->entrance();
        }
    }
}

$main = new Main();
$main->start();
