<?php


namespace CodelyTV\FinderKata\Algorithm;


class ResultSorter
{

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