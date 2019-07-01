<?php 

use test\checks\ForbiddenWordChecker;

class ForbiddenWordCheckerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testCheck()
    {
        $checker = new ForbiddenWordChecker();
        $checker->filters = [
            'SiteAnalyst',
            'SiteAdmin',
            'Administration',
        ];
        $this->assertFalse($checker->check(' ew  er we example@gmail.com  e ergerg Administration dgredg'));
        $this->assertTrue($checker->check('wet wvt example@gmail. feses g administration'));

        $checker->caseSensitive = false;
        $this->assertFalse($checker->check(' ew  er we example@gmail.com  e ergerg Administration dgredg'));
        $this->assertFalse($checker->check('wet wvt example@gmail. feses g administration'));
        $this->assertTrue($checker->check('wet wvt example@gmail. feses g'));
    }
}