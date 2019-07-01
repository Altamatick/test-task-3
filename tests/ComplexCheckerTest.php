<?php 

use test\checks\{
    EmailChecker,
    ForbiddenWordChecker,
    RegexChecker,
};
use test\ComplexChecker;

class ComplexCheckerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    // tests
    public function testCheck()
    {
        $complexChecker = new ComplexChecker();
        $regexChecker = new RegexChecker();
        $regexChecker->filters = [
            '(f+a+c+e+b+[o0]+[o0]+k+)',
            '(f+(a+)?.{1,2}c+e+b+.{1,2}o+k+)',
            '(f+.{1,3}b+o+[kc]+)',
        ];
        $forbiddenWordChecker = new ForbiddenWordChecker();
        $forbiddenWordChecker->filters = [
            'SiteAnalyst',
            'SiteAdmin',
            'Administration',
        ];
        $emailChecker = new EmailChecker();

        $complexChecker
            ->addFilter($regexChecker)
            ->addFilter($forbiddenWordChecker)
            ->addFilter($emailChecker);

        $this->assertFalse($complexChecker->check("tdtstsdsf f..ceb.ok example@gmail.com facebook SiteAdmin Administration"));
        $this->assertTrue($complexChecker->hasErrors());
        $this->assertEquals(
            [
                [
                    "name" => "regex",
                    "value" => "facebook",
                ],
                [
                    "name" => "regex",
                    "value" => "f..ceb.ok",
                ],
                [
                    "name" => "forbidden word",
                    "value" => "SiteAdmin",
                ],
                [
                    "name" => "forbidden word",
                    "value" => "Administration",
                ],
                [
                    "name" => "email",
                    "value" => "example@gmail.com",
                ],
            ], $complexChecker->getErrors()
        );

        $this->assertFalse($complexChecker->check("f..ceb.ok"));
        $this->assertTrue($complexChecker->hasErrors());
        $this->assertEquals(
            [
                [
                    "name" => "regex",
                    "value" => "f..ceb.ok",
                ]
            ], $complexChecker->getErrors()
        );

        $this->assertFalse($complexChecker->check("k example@gmail.com facon"));
        $this->assertTrue($complexChecker->hasErrors());
        $this->assertEquals(
            [
                [
                    "name" => "email",
                    "value" => "example@gmail.com",
                ]
            ], $complexChecker->getErrors()
        );

        $this->assertFalse($complexChecker->check("ook SiteAdmin Administration dfgdfg"));
        $this->assertTrue($complexChecker->hasErrors());
        $this->assertEquals(
            [
                [
                    "name" => "forbidden word",
                    "value" => "SiteAdmin",
                ],
                [
                    "name" => "forbidden word",
                    "value" => "Administration",
                ],
            ], $complexChecker->getErrors()
        );

        $this->assertTrue($complexChecker->check('wet wvt example@gmail. feses g'));
        $this->assertFalse($complexChecker->hasErrors());
        $this->assertEquals([], $complexChecker->getErrors());

        $this->assertTrue($complexChecker->check('wet wvt example@sdf gmail. administration feses g'));
        $this->assertFalse($complexChecker->hasErrors());
        $this->assertEquals([], $complexChecker->getErrors());
    }
}