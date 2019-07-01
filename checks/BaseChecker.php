<?php
namespace test\checks;

use test\CheckInterface;

abstract class BaseChecker implements CheckInterface
{
    private $errors = [];
    
    abstract public function check(string $value) : bool;

    abstract public static function getName() : string;

    public function getErrors() : array
    {
        return $this->errors;
    }

    public function addError(string $error) : void
    {
        if (in_array($error,  $this->errors) === false) {
            $this->errors[] = $error;
        }
    }

    public function hasErrors() : bool
    {
        return count($this->errors) !== 0;
    }

    public function clearErrors() : void
    {
        $this->errors = [];
    }
}

