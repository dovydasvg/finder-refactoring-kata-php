<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Application\UserFinder;

use CodelyTV\FinderKata\Domain\User\Model\User;

class ResultSorter
{

    public function sortUsersByBirthdate(array $users): array
    {
        usort($users, 'self::sortingByBirthdate');
        return $users;
    }

    private static function sortingByBirthdate(User $a,User $b): int
    {
        $firstBirthdate = $a->getBirthDate();
        $secondBirthdate = $b->getBirthDate();
        if ($firstBirthdate === $secondBirthdate) {
            return 0;
        }
        return ($firstBirthdate < $secondBirthdate) ? -1:1;

    }
}