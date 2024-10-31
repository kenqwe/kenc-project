<?php

class EmployeeRoster {
    private array $employees = [];

    public function add(Employee $employee) {
        $this->employees[] = $employee;
    }

    public function delete(int $index) {
        if (isset($this->employees[$index])) {
            unset($this->employees[$index]);
            $this->employees = array_values($this->employees);
        }
    }

    public function getAll(): array {
        return $this->employees;
    }

    public function count(): int {
        return count($this->employees);
    }

    public function countByType(string $type): int {
        return count(array_filter($this->employees, fn($e) => get_class($e) === $type));
    }
}
