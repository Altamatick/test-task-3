<?php
namespace test\checks;

class RegexChecker extends BaseChecker
{
    public $filters = [];

    public function check(string $value) : bool
    {
        $this->clearErrors();
        foreach ($this->filters as $regex) {
            if (preg_match_all('/'.$regex.'/', $value, $matches)) {
                $this->addError($matches[0][0]);
            }
        }
        return $this->hasErrors() === false;
    }

    public static function getName() : string
    {
        return "regex";
    }
}

