<?php

namespace Levi9\CalendarBundle\Service;

use Doctrine\ORM\EntityRepository;
use Levi9\CalendarBundle\Entity\User;

class Calendar
{
    /** @var EntityRepository */
    protected $repository;

    public function __construct(EntityRepository $entityRepository)
    {
        $this->repository = $entityRepository;
    }

    /**
     * Get exercises results
     *
     * @param User $user
     * @param \DateTimeImmutable $date
     * @return array
     */
    public function getListData(User $user, \DateTimeImmutable $date = null)
    {
        if (null === $date) {
            $date = new \DateTimeImmutable('today');
        }

        $oneWeekAgo = $date->modify('1 week ago');
        $twoWeeksAgo = $date->modify('2 weeks ago');

        $calendarResults = array(
            'today' =>
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => $date,
                )),
            '1_week_ago' =>
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => $oneWeekAgo,
                )),
            '2_weeks_ago' =>
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => $twoWeeksAgo,
                )),
        );

        return $calendarResults;
    }
}
