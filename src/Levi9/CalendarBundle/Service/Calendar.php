<?php

namespace Levi9\CalendarBundle\Service;

use Doctrine\ORM\EntityRepository;
use Levi9\CalendarBundle\Entity\CalendarResults;

class Calendar
{
    /** @var EntityRepository */
    protected $repository;

    public function __construct(EntityRepository $entityRepository)
    {
        $this->repository = $entityRepository;
    }

    public function getListData()
    {

        $calendarResults = new CalendarResults();

        $calendarResults
            ->setToday(
                $this->repository->findBy(array(
                    'date' => new \DateTime('today')
                ))
            )
            ->setOneWeekAgo(
                $this->repository->findBy(array(
                    'date' => new \DateTime('1 week ago')
                ))
            )
            ->setTwoWeeksAgo(
                $this->repository->findBy(array(
                    'date' => new \DateTime('2 weeks ago')
                ))
            );

        return $calendarResults;
    }
}
