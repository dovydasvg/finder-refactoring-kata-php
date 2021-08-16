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

    public function setUp()
    {
        $this->resultSorter = new ResultSorter();
        $this->userFactory = new UserFactory();

        $users = [
            "Sue" => new DateTime("1950-01-01"),
            "Greg" => new DateTime("1952-05-01"),
            "Sarah" => new DateTime("1982-01-01"),
            "Mike" => new DateTime("1979-01-01")
        ];
        foreach ($users as $userName => $userBirthdate){
            $this->{strtolower($userName)} = $this->userFactory->createUser($userName, $userBirthdate);
        }
    }

    /**
     * @test
     */
    public function result_sorter_class_exists()
    {
        $this->assertInstanceOf(ResultSorter::class,$this->resultSorter);
    }

}