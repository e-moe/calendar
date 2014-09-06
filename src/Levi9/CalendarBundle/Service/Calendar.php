<?php

namespace Levi9\CalendarBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry;

class Calendar
{
    /** @var \Doctrine\Bundle\DoctrineBundle\Registry */
    protected $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getListData()
    {
        $data = array(
            'today' => $this->doctrine->getRepository('Levi9CalendarBundle:Exercise')->findBy(array(
                'date' => new \DateTime('today')
            )),
            '1_week' => $this->doctrine->getRepository('Levi9CalendarBundle:Exercise')->findBy(array(
                'date' => new \DateTime('1 week ago')
            )),
            '2_week' => $this->doctrine->getRepository('Levi9CalendarBundle:Exercise')->findBy(array(
                'date' => new \DateTime('2 weeks ago')
            ))
        );

        return $data;
    }


}
