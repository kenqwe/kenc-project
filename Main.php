<?php

require_once 'EmployeeRoster.php';
require_once 'Employee.php';

class Main {
    private EmployeeRoster $roster;
    private $size;

    public function __construct() {
        $this->roster = new EmployeeRoster();
    }

    public function start() {
        $this->clear();
        $this->size = $this->getIntInput("Enter the size of the roster: ");
        if ($this->size < 1) {
            echo "Invalid roster size. Please try again.\n";
            readline("Press \"Enter\" key to continue...");
            $this->start();
        } else {
            $this->entrance();
        }
    }

    public function entrance() {
        while (true) {
            $this->clear();
            $this->menu();
            $choice = $this->getIntInput("Select an option: ");

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
                    exit;
                default:
                    echo "Invalid input. Please try again.\n";
                    readline("Press \"Enter\" key to continue...");
            }
        }
    }

    public function menu() {
        echo "*** EMPLOYEE ROSTER MENU ***\n";
        echo "[1] Add Employee\n";
        echo "[2] Delete Employee\n";
        echo "[3] Other Menu\n";
        echo "[0] Exit\n";
    }

    public function addMenu() {
        if ($this->roster->count() >= $this->size) {
            echo "Roster limit reached. Cannot add more employees.\n";
            $this->promptContinue();
            return;
        }

        $this->clear();
        echo "*** Add Employee ***\n";
        $name = readline("Enter name: ");
        $address = readline("Enter address: ");
        $age = $this->getIntInput("Enter age: ");
        $cName = readline("Enter company name: ");
        $this->empType($name, $address, $age, $cName);
    }

    public function empType($name, $address, $age, $cName) {
        $this->clear();
        echo "--- Employee Details ---\n";
        echo "[1] Commission Employee\n";
        echo "[2] Hourly Employee\n";
        echo "[3] Piece Worker\n";
        $type = $this->getIntInput("Type of Employee: ");

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
                return $this->addMenu();
        }

        $this->roster->add($employee);
        echo "Employee Added!\n";
        $this->promptContinue();
    }

    public function deleteMenu() {
        $this->clear();
        echo "*** List of Employees on the current Roster ***\n";
        $employees = $this->roster->getAll();
    
        if (empty($employees)) {
            echo "No record found.\n";
            $this->promptContinue();
            return;
        }
    
        foreach ($employees as $index => $employee) {
            echo "[" . ($index + 1) . "] " . $employee->getDetails() . "\n";
        }
    
        echo "[0] Return\n";
        $index = $this->getIntInput("Enter the index of the employee to delete: ");
        if ($index > 0 && $index <= count($employees)) {
            $this->roster->delete($index - 1);
            echo "Employee deleted successfully.\n";
        } else if ($index != 0) {
            echo "Invalid index. Try again.\n";
        }
        $this->promptContinue();
    }
    

    public function otherMenu() {
        $this->clear();
        echo "[1] Display\n";
        echo "[2] Count\n";
        echo "[0] Return\n";
        $choice = $this->getIntInput("Select Menu: ");

        switch ($choice) {
            case 1:
                $this->displayMenu();
                break;
            case 2:
                $this->countMenu();
                break;
            case 0:
                return;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
        }
    }

    public function displayMenu() {
        $this->clear();
        echo "[1] Display All Employees\n";
        echo "[2] Display Commission Employees\n";
        echo "[3] Display Hourly Employees\n";
        echo "[4] Display Piece Workers\n";
        echo "[0] Return\n";
        $choice = $this->getIntInput("Select Menu: ");
    
        $employees = $this->roster->getAll();
        if (empty($employees)) {
            echo "No record found.\n";
            $this->promptContinue();
            return;
        }
    
        switch ($choice) {
            case 0:
                return;
            case 1:
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
        }
        $this->promptContinue();
    }
    
    public function displaySpecificEmployees($type) {
        $employees = $this->roster->getAll();
        $found = false;
    
        foreach ($employees as $employee) {
            if (get_class($employee) === $type) {
                echo $employee->getDetails() . "\n";
                $found = true;
            }
        }
    
        if (!$found) {
            echo "No record found.\n";
        }
        $this->promptContinue();
    }
    
    public function countMenu() {
        $this->clear();
        echo "[1] Count All Employees\n";
        echo "[2] Count Commission Employees\n";
        echo "[3] Count Hourly Employees\n";
        echo "[4] Count Piece Workers\n";
        echo "[0] Return\n";
        $choice = $this->getIntInput("Select Menu: ");

        switch ($choice) {
            case 0:
                return;
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
        }
        $this->promptContinue();
    }

    public function getIntInput($message) {
        $input = readline($message);
        while (!is_numeric($input)) {
            echo "Invalid input. Please enter a number.\n";
            $input = readline($message);
        }
        return (int)$input;
    }

    public function promptContinue() {
        readline("Press \"Enter\" key to continue...");
    }

    public function clear() {
        if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
            system('cls');
        } else {
            system('clear');
        }
    }
}

$main = new Main();
$main->start();
