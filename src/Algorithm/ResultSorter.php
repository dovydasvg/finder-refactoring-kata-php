<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;


class ResultSorter
{
    /**
     * @param User[] $users
     * @return SearchResult[]
     */
    public function sortByUserBirthdays(array $users): array
    {
        $searchResultList = [];
        $usersCount = count($users);
        foreach ($users as $i => $user) {
            for ($j = $i + 1; $j < $usersCount; $j++) {
                $r = new SearchResult();

                if ($user->getBirthDate() < $users[$j]->getBirthDate()) {
                    $r->user2 = $user;
                    $r->user1 = $users[$j];
                } else {
                    $r->user2 = $users[$j];
                    $r->user1 = $user;
                }

                $difference = $r->user1->getBirthDate()->getTimestamp()
                    - $r->user2->getBirthDate()->getTimestamp();

                $r->setBirthdateDifference($difference);

                $searchResultList[] = $r;
            }
        }
        if(count($searchResultList) < 1)
        {
            $searchResultList[0] = new SearchResult();
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