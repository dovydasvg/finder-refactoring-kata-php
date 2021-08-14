<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Application\UserFinder\UserFinder;
use CodelyTV\FinderKata\Domain\User\Factory\UserFactory;
use CodelyTV\FinderKata\Domain\User\Model\User;
use DateTime;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{

    protected function setUp()
    {
        $userFactory = new UserFactory();

        $users = [
            "Sue" => new DateTime("1950-01-01"),
            "Greg" => new DateTime("1952-05-01"),
            "Sarah" => new DateTime("1982-01-01"),
            "Mike" => new DateTime("1979-01-01")
            ];
        foreach ($users as $userName => $userBirthdate){
            $this->{strtolower($userName)} = $userFactory->createUser($userName, $userBirthdate);
        }

    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $list   = [];
        $finder = new UserFinder($list);

        $result = $finder->findUsersWithSmallestBirthdateDifference();

        $this->assertEquals(null, $result->getUserBornEarlier());
        $this->assertEquals(null, $result->getUserBornLater());
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $list   = [];
        $list[] = $this->sue;
        $finder = new UserFinder($list);

        $result = $finder->findUsersWithSmallestBirthdateDifference();

        $this->assertEquals(null, $result->getUserBornEarlier());
        $this->assertEquals(null, $result->getUserBornLater());
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new UserFinder($list);

        $result = $finder->findUsersWithSmallestBirthdateDifference();

        $this->assertEquals($this->sue, $result->getUserBornEarlier());
        $this->assertEquals($this->greg, $result->getUserBornLater());
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new UserFinder($list);

        $result = $finder->findUsersWithBiggestBirthdateDifference();

        $this->assertEquals($this->greg, $result->getUserBornEarlier());
        $this->assertEquals($this->mike, $result->getUserBornLater());
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new UserFinder($list);

        $result = $finder->findUsersWithBiggestBirthdateDifference();

        $this->assertEquals($this->sue, $result->getUserBornEarlier());
        $this->assertEquals($this->sarah, $result->getUserBornLater());
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new UserFinder($list);

        $result = $finder->findUsersWithSmallestBirthdateDifference();

        $this->assertEquals($this->sue, $result->getUserBornEarlier());
        $this->assertEquals($this->greg, $result->getUserBornLater());
    }

}
