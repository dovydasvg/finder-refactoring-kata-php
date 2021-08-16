<?php


namespace CodelyTV\FinderKataTest\Application\UserFinder;


use CodelyTV\FinderKata\Application\UserFinder\ResultSorter;
use CodelyTV\FinderKata\Domain\User\Factory\UserFactory;
use DateTime;
use PHPUnit\Framework\TestCase;

final class ResultSorterTest extends TestCase
{
    /**
     * @var ResultSorter
     */
    private $resultSorter;
    /**
     * @var UserFactory
     */
    private $userFactory;
    /**
     * @var array
     */
    private $users;

    public function setUp()
    {
        $this->resultSorter = new ResultSorter();
        $this->userFactory = new UserFactory();
        $this->users = [];

        $users = [
            "Sue" => new DateTime("1950-01-01"),
            "Greg" => new DateTime("1952-05-01"),
            "Sarah" => new DateTime("1982-01-01"),
            "Mike" => new DateTime("1979-01-01")
        ];
        foreach ($users as $userName => $userBirthdate){
            $this->users[] = $this->{strtolower($userName)} = $this->userFactory->createUser($userName, $userBirthdate);
        }
    }

    /**
     * @test
     */
    public function result_sorter_class_exists()
    {
        $this->assertInstanceOf(ResultSorter::class,$this->resultSorter);
    }

    /**
     * @test
     */
    public function result_sorter_returns_sorted_user_array_by_birthdate()
    {
        $sorted_users = $this->resultSorter->sortUsersByBirthdate($this->users);
        $correct_sorted_users_array = [
            0 => $this->sue,
            1 => $this->greg,
            2 => $this->mike,
            3 => $this->sarah
        ];
        $this->assertEquals($correct_sorted_users_array, $sorted_users);
    }

}