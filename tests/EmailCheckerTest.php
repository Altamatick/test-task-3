<?php 

use test\checks\EmailChecker;

class EmailCheckerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testCheck()
    {
        $checker = new EmailChecker();
        $this->assertFalse($checker->check(' ew  er we example@gmail.com  e ergerg'));
        $this->assertTrue($checker->check('wet wvt example@gmail. feses g'));
    }
}