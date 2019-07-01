<?php 

use test\checks\RegexChecker;

class RegexCheckerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testCheck()
    {
        $checker = new RegexChecker();
        $checker->filters = [
            '(f+a+c+e+b+[o0]+[o0]+k+)',
            '(f+(a+)?.{1,2}c+e+b+.{1,2}o+k+)',
            '(f+.{1,3}b+o+[kc]+)',
        ];
        
        $this->assertFalse($checker->check('tdtstsdsf f..ceb.ok facebook'));
        $this->assertTrue($checker->check('tdtstsdsf f..ceb.o'));
    }
}