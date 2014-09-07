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

    public function getListData(User $user)
    {

        $calendarResults = new CalendarResults();

        $calendarResults
            ->setToday(
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => new \DateTime('today'),
                ))
            )
            ->setOneWeekAgo(
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => new \DateTime('1 week ago'),
                ))
            )
            ->setTwoWeeksAgo(
                $this->repository->findBy(array(
                    'user' => $user,
                    'date' => new \DateTime('2 weeks ago'),
                ))
            );

        return $calendarResults;
    }
}
