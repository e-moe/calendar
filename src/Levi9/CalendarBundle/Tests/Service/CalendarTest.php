<?php

namespace Levi9\CalendarBundle\Tests\Service;

use Levi9\CalendarBundle\Entity\CalendarResults;
use Levi9\CalendarBundle\Service\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetListData()
    {
        $expected = new CalendarResults();

        $user = $this->getMock('\Levi9\CalendarBundle\Entity\User');

        $exerciseRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $exerciseRepository->expects($this->exactly(3))
            ->method('findBy')
            ->withConsecutive(
                array(array('user' => $user, 'date' => new \DateTime('today')), null, null, null),
                array(array('user' => $user, 'date' => new \DateTime('1 week ago')),null, null, null),
                array(array('user' => $user, 'date' => new \DateTime('2 weeks ago')), null, null, null)
            )
            ->will($this->returnValue(array()));


        $calendar = new Calendar($exerciseRepository);
        $actual = $calendar->getListData($user);

        $this->assertEquals($expected, $actual);
    }
}
