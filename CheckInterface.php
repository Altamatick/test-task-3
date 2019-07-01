<?php
namespace test;

interface CheckInterface
{
    public function check(string $value) : bool;

    public function getErrors() : array;

    public function addError(string $error) : void;

    public function hasErrors() : bool;

    public function clearErrors() : void;

    public static function getName() : string;
}

