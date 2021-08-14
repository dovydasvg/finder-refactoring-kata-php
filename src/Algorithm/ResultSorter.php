<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;


class ResultSorter
{
    /**
     * @param User[] $users
     * @return UserBirthdateDifferenceValueObject[]
     */
    public function sortByUserBirthdates(array $users): array
    {
        $searchResultList = [];
        $usersCount = count($users);
        foreach ($users as $i => $user) {
            for ($j = $i + 1; $j < $usersCount; $j++) {
                $birthdateDifference = new UserBirthdateDifferenceValueObject();

                if ($user->getBirthDate() < $users[$j]->getBirthDate()) {
                    $birthdateDifference->user2 = $user;
                    $birthdateDifference->user1 = $users[$j];
                } else {
                    $birthdateDifference->user2 = $users[$j];
                    $birthdateDifference->user1 = $user;
                }

                $difference = $birthdateDifference->user1->getBirthDate()->getTimestamp()
                    - $birthdateDifference->user2->getBirthDate()->getTimestamp();

                $birthdateDifference->setBirthdateDifference($difference);

                $searchResultList[] = $birthdateDifference;
            }
        }
        if(count($searchResultList) < 1)
        {
            $searchResultList[0] = new UserBirthdateDifferenceValueObject();
        }
        return $searchResultList;
    }

    public function findResultWithSmallestDifference(array $searchResultList)
    {
        if (count($searchResultList) === 1) {
            return $searchResultList[0];
        }
        $first = array_shift($searchResultList);
        $second = $this->findResultWithSmallestDifference($searchResultList);
        if ($first->getBirthdateDifference() < $second->getBirthdateDifference()) {
            return $first;
        }
        return $second;
    }

    public function findResultWithBiggestDifference(array $searchResultList)
    {
        if (count($searchResultList) === 1) {
            return $searchResultList[0];
        }
        $first = array_shift($searchResultList);
        $second = $this->findResultWithBiggestDifference($searchResultList);
        if ($first->getBirthdateDifference() > $second->getBirthdateDifference()) {
            return $first;
        }
        return $second;
    }
}