<?php

namespace Levi9\CalendarBundle\Tests\Service;

use Levi9\CalendarBundle\Entity\CalendarResults;
use Levi9\CalendarBundle\Service\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetListData()
    {
        $expected = new CalendarResults();

        $exerciseRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $exerciseRepository->expects($this->exactly(3))
            ->method('findBy')
            ->withConsecutive(
                array(array('date' => new \DateTime('today')), null, null, null),
                array(array('date' => new \DateTime('1 week ago')),null, null, null),
                array(array('date' => new \DateTime('2 weeks ago')), null, null, null)
            )
            ->will($this->returnValue(array()));


        $calendar = new Calendar($exerciseRepository);
        $actual = $calendar->getListData();

        $this->assertEquals($expected, $actual);
    }
}
