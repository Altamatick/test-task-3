<?php
namespace test\checks;

class ForbiddenWordChecker extends BaseChecker
{
    public $filters = [];

    public $caseSensitive = true;

    public function check(string $value) : bool
    {
        foreach ($this->filters as $word) {
            if ($this->caseSensitive === false) {
                $value = strtolower($value);
                $word = strtolower($word);
            }
            if (strpos($value, $word) !== false) {
                $this->addError($word);
            }
        }
        return $this->hasErrors() === false;
    }

    public static function getName() : string
    {
        return "forbidden word";
    }
}

