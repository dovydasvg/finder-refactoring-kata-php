<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class Finder
{
    /** @var User[] */
    private $_p;

    public function __construct(array $p)
    {
        $this->_p = $p;
    }

    public function find(int $ft): SearchResult
    {
        /** @var SearchResult[] $searchResultList */
        $searchResultList = [];

        for ($i = 0; $i < count($this->_p); $i++) {
            for ($j = $i + 1; $j < count($this->_p); $j++) {
                $r = new SearchResult();

                if ($this->_p[$i]->getBirthDate() < $this->_p[$j]->getBirthDate()) {
                    $r->user2 = $this->_p[$i];
                    $r->user1 = $this->_p[$j];
                } else {
                    $r->user2 = $this->_p[$j];
                    $r->user1 = $this->_p[$i];
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
