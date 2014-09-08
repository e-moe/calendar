<?php

namespace Levi9\CalendarBundle\Service;

use Doctrine\ORM\EntityRepository;
use Levi9\CalendarBundle\Entity\CalendarResults;
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
     * @return CalendarResults
     */
    public function getListData(User $user, \DateTimeImmutable $date = null)
    {
        if (null === $date) {
            $date = new \DateTimeImmutable('today');
        }

        $oneWeekAgo = $date->sub(\DateInterval::createFromDateString('1 week'));
        $twoWeeksAgo = $date->sub(\DateInterval::createFromDateString('2 weeks'));

        $calendarResults = new CalendarResults();

        $calendarResults
            ->setToday(
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => $date,
                ))
            )
            ->setOneWeekAgo(
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => $oneWeekAgo,
                ))
            )
            ->setTwoWeeksAgo(
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => $twoWeeksAgo,
                ))
            );

        return $calendarResults;
    }
}
