<?php

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Algorithm\UserBirthdateDifferenceValueObject;
use PHPUnit\Framework\TestCase;

class UserBirthdateDifferenceValueObjectTest extends TestCase
{
    /**
     * @var UserBirthdateDifferenceValueObject
     */
    private $UserBirthdateDifferenceVO;

    protected function setUp()
    {
        $this->UserBirthdateDifferenceVO = new UserBirthdateDifferenceValueObject();
    }

    /**
     * @test
     */
    public function should_throw_exception_if_birthdate_difference_is_negative()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->UserBirthdateDifferenceVO->setBirthdateDifference(-3);

    }

}
