<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Algorithm\Finder;
use CodelyTV\FinderKata\Algorithm\SearchLogic;
use CodelyTV\FinderKata\Algorithm\User;
use DateTime;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{
    /** @var User */
    private $sue;

    /** @var User */
    private $greg;

    /** @var User */
    private $sarah;

    /** @var User */
    private $mike;

    protected function setUp()
    {
        $this->sue = new User();
        $this->sue->setName("Sue");
        $birthday = new DateTime("1950-01-01");
        $this->sue->setBirthDate($birthday);

        $this->greg = new User();
        $this->greg->setName("Greg");
        $birthday = new DateTime("1952-05-01");
        $this->greg->setBirthDate($birthday);

        $this->sarah = new User();
        $this->greg->setName("Sarah");
        $birthday = new DateTime("1982-01-01");
        $this->sarah->setBirthDate($birthday);

        $this->mike = new User();
        $this->mike->setName("Mike");
        $birthday = new DateTime("1979-01-01");
        $this->mike->setBirthDate($birthday);
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $list   = [];
        $finder = new Finder($list);

        $result = $finder->findUsersWithSmallestBirthdateDifference();

        $this->assertEquals(null, $result->user2);
        $this->assertEquals(null, $result->user1);
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $list   = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->findUsersWithSmallestBirthdateDifference();

        $this->assertEquals(null, $result->user2);
        $this->assertEquals(null, $result->user1);
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->findUsersWithSmallestBirthdateDifference();

        $this->assertEquals($this->sue, $result->user2);
        $this->assertEquals($this->greg, $result->user1);
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->findUsersWithBiggestBirthdateDifference();

        $this->assertEquals($this->greg, $result->user2);
        $this->assertEquals($this->mike, $result->user1);
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->findUsersWithBiggestBirthdateDifference();

        $this->assertEquals($this->sue, $result->user2);
        $this->assertEquals($this->sarah, $result->user1);
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
        $finder = new Finder($list);

        $result = $finder->findUsersWithSmallestBirthdateDifference();

        $this->assertEquals($this->sue, $result->user2);
        $this->assertEquals($this->greg, $result->user1);
    }

}
