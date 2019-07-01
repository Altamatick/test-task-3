<?php
namespace test;

class ComplexChecker implements ChecksControlInterface
{
    private $filters = [];
    private $errors = [];

    public function addFilter(CheckInterface $filter) :  ChecksControlInterface
    {
        $this->filters[$filter::getName()] = $filter;
        return $this;
    }

    public function hasFilter(string $name) : bool
    {
        return array_key_exists($name, $this->filters);
    }

    public function deleteFilter(string $name) :  ChecksControlInterface
    {
        if ($this->hasFilter($name)) {
            unset($this->filters[$name]);
        }
        return $this;
    }

    public function check(string $text) : bool
    {
        $this->errors = [];
        foreach ($this->filters as $filter) {
            if ($filter->check($text) === false) {
                foreach ($filter->getErrors() as $error) {
                    $this->errors[] = [
                        'name' => $filter->getName(),
                        'value' => $error
                    ];
                }
            }
        }
        return $this->hasErrors() === false;
    }

    public function getErrors() : array
    {
        return $this->errors;
    }

    public function hasErrors() : bool
    {
        return count($this->errors) !== 0;
    }
}
