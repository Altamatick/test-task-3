<?php
namespace test;

interface ChecksControlInterface
{
    public function addFilter(CheckInterface $filter) :  self;

    public function hasFilter(string $name) : bool;

    public function deleteFilter(string $name) :  self;

    public function check(string $text) : bool;

    public function getErrors() : array;

    public function hasErrors() : bool;
}
