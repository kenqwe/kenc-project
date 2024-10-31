<?php

class EmployeeRoster {
    private $employees = [];

    public function add(Employee $employee) {
        $this->employees[] = $employee;
    }

    public function getAll() {
        return $this->employees;
    }

    public function delete($index) {
        if (isset($this->employees[$index])) {
            unset($this->employees[$index]);
            $this->employees = array_values($this->employees);
            echo "Employee deleted.\n";
        } else {
            echo "Invalid index.\n";
        }
    }

    public function count() {
        return count($this->employees);
    }

    public function countByType($type) {
        return count(array_filter($this->employees, fn($employee) => get_class($employee) === $type));
    }
}