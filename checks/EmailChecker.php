<?php
namespace test\checks;

class EmailChecker extends BaseChecker
{
    public $regex = "/\w+@[a-z0-9-]+\.[a-z]{2,}/i";

    public function check(string $value) : bool
    {
        $this->clearErrors();
        if (preg_match_all($this->regex, $value, $matches)) {
            foreach ($matches as $v) {
                $this->addError($v[0]);
            }
        }
        return $this->hasErrors() === false;
    }

    public static function getName() : string
    {
        return "email";
    }
}

