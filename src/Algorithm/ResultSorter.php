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
        $usersCount = count($users);
        $searchResultList = [];
        foreach ($users as $i => $user) {
            for ($j = $i + 1; $j < $usersCount; $j++) {
                $birthdateDifferenceValueObject = new UserBirthdateDifferenceValueObject();

                $this->setValueObjectUsersByBirthdate($user, $users[$j], $birthdateDifferenceValueObject);

                $this->setValueObjectBirthdateDifference($birthdateDifferenceValueObject);

                $searchResultList[] = $birthdateDifferenceValueObject;
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

    /**
     * @param User $user
     * @param $users
     * @param UserBirthdateDifferenceValueObject $birthdateDifferenceValueObject
     */
    private function setValueObjectUsersByBirthdate(User $user, $users, UserBirthdateDifferenceValueObject $birthdateDifferenceValueObject)
    {
        if ($user->getBirthDate() < $users->getBirthDate()) {
            $birthdateDifferenceValueObject->setUserBornEarlier($user);
            $birthdateDifferenceValueObject->setUserBornLater($users);
        } else {
            $birthdateDifferenceValueObject->setUserBornEarlier($users);
            $birthdateDifferenceValueObject->setUserBornLater($user);
        }
    }
    /**
     * @param UserBirthdateDifferenceValueObject $birthdateDifferenceValueObject
     */
    private function setValueObjectBirthdateDifference(UserBirthdateDifferenceValueObject $birthdateDifferenceValueObject)
    {
        $userBornEarlier = $birthdateDifferenceValueObject->getUserBornEarlier();
        $userBornLater = $birthdateDifferenceValueObject->getUserBornLater();
        if($userBornEarlier === null || $userBornLater === null){
            return;
        }
        $difference = $userBornLater->getBirthDate()->getTimestamp()
            - $userBornEarlier->getBirthDate()->getTimestamp();
        $birthdateDifferenceValueObject->setBirthdateDifference($difference);
    }
}