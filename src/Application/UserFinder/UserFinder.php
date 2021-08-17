<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Application\UserFinder;

use CodelyTV\FinderKata\Domain\User\Model\User;

final class UserFinder
{

    /** @var User[] */
    private $users;
    /** @var UserSorter */
    private $resultSorter;

    public function __construct(array $users)
    {
        $this->users = $users;
        $this->resultSorter = new UserSorter();
    }

    public function findUsersWithBiggestBirthdateDifference(): UserBirthdateDifferenceValueObject
    {
        if(count($this->users) < 2){
            return new UserBirthdateDifferenceValueObject();
        }
        $sortedUsers = $this->resultSorter->sortUsersByBirthdate($this->users);
        $lastUserIndex = count($sortedUsers)-1;
        $difference = $sortedUsers[$lastUserIndex]->getBirthDate()->getTimestamp()
            - $sortedUsers[0]->getBirthDate()->getTimestamp();
        return new UserBirthdateDifferenceValueObject($sortedUsers[$lastUserIndex],$sortedUsers[0],$difference);
    }

    public function findUsersWithSmallestBirthdateDifference(): UserBirthdateDifferenceValueObject
    {
        if(count($this->users) < 2){
            return new UserBirthdateDifferenceValueObject();
        }
        $sortedUsers = $this->resultSorter->sortUsersByBirthdate($this->users);
        print_r($sortedUsers);
        return $this->findSmallestBirthdateDifference($sortedUsers);
    }

    /**
     * @param array $sortedUsers
     * @return UserBirthdateDifferenceValueObject
     */
    private function findSmallestBirthdateDifference(array $sortedUsers): UserBirthdateDifferenceValueObject
    {
        $smallestDifference = null;
        $firstUser = null;
        $slightlyOlderUser = null;
        for ($i = 0, $iMax = count($sortedUsers); $i < $iMax - 1; $i++) {
            $User1 = $sortedUsers[$i];
            $User2 = $sortedUsers[$i + 1];
            if ($smallestDifference === null) {
                $firstUser = $User1;
                $slightlyOlderUser = $User2;
                $smallestDifference = $slightlyOlderUser->getBirthdate()->getTimestamp() - $firstUser->getBirthdate()->getTimestamp();
            } else {
                $difference = $User2->getBirthdate()->getTimestamp() - $User1->getBirthdate()->getTimestamp();
                if ($difference < $smallestDifference) {
                    $firstUser = $User1;
                    $slightlyOlderUser = $User2;
                    $smallestDifference = $difference;
                }
            }
        }
        return new UserBirthdateDifferenceValueObject($slightlyOlderUser, $firstUser, $smallestDifference);
    }

}
