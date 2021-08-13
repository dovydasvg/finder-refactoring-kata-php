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
        /** @var SearchResult[] $tr */
        $tr = [];

        for ($i = 0; $i < count($this->_p); $i++) {
            for ($j = $i + 1; $j < count($this->_p); $j++) {
                $r = new SearchResult();

                if ($this->_p[$i]->getBirthDate() < $this->_p[$j]->getBirthDate()) {
                    $r->User1 = $this->_p[$i];
                    $r->User2 = $this->_p[$j];
                } else {
                    $r->User1 = $this->_p[$j];
                    $r->User2 = $this->_p[$i];
                }

                $r->d = $r->User2->getBirthDate()->getTimestamp()
                    - $r->User1->getBirthDate()->getTimestamp();

                $tr[] = $r;
            }
        }

        if (count($tr) < 1) {
            return new SearchResult();
        }

        $answer = $tr[0];

        foreach ($tr as $result) {
            switch ($ft) {
                case FT::ONE:
                    if ($result->d < $answer->d) {
                        $answer = $result;
                    }
                    break;

                case FT::TWO:
                    if ($result->d > $answer->d) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }
}
