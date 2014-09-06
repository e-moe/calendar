<?php

namespace Levi9\CalendarBundle\Service;

use Doctrine\ORM\EntityRepository;

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

        $data = array(
            'today' => $this->repository->findBy(array(
                'date' => new \DateTime('today')
            )),
            '1_week' => $this->repository->findBy(array(
                'date' => new \DateTime('1 week ago')
            )),
            '2_week' => $this->repository->findBy(array(
                'date' => new \DateTime('2 weeks ago')
            ))
        );

        return $data;
    }


}
