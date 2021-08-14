<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class Finder
{
    /** @var User[] */
    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function find(int $ft): SearchResult
    {
        /** @var SearchResult[] $searchResultList */
        $searchResultList = [];

        $usersCount = count($this->users);

        for ($i = 0; $i < $usersCount; $i++) {
            for ($j = $i + 1; $j < $usersCount; $j++) {
                $r = new SearchResult();

                if ($this->users[$i]->getBirthDate() < $this->users[$j]->getBirthDate()) {
                    $r->user2 = $this->users[$i];
                    $r->user1 = $this->users[$j];
                } else {
                    $r->user2 = $this->users[$j];
                    $r->user1 = $this->users[$i];
                }

                $difference = $r->user1->getBirthDate()->getTimestamp()
                    - $r->user2->getBirthDate()->getTimestamp();

                $r->setBirthdateDifference($difference);

                $searchResultList[] = $r;
            }
        }

        if (count($searchResultList) < 1) {
            return new SearchResult();
        }

        $answer = $searchResultList[0];

        foreach ($searchResultList as $result) {
            switch ($ft) {
                case FT::ONE:
                    if ($result->getBirthdateDifference() < $answer->getBirthdateDifference()) {
                        $answer = $result;
                    }
                    break;

                case FT::TWO:
                    if ($result->getBirthdateDifference() > $answer->getBirthdateDifference()) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }
}
