<?php

namespace Levi9\CalendarBundle\Tests\Service;

use Levi9\CalendarBundle\Service\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetListData()
    {
        $expected = array(
            'today'         => array(),
            '1_week_ago'    => array(),
            '2_weeks_ago'   => array(),
        );

        $user = $this->getMock('\Levi9\CalendarBundle\Entity\User');

        $date = new \DateTimeImmutable('2014-09-08');
        $oneWeekAgo = $date->modify('1 week ago');
        $twoWeeksAgo = $date->modify('2 weeks ago');

        $exerciseRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $exerciseRepository->expects($this->exactly(3))
            ->method('findBy')
            ->withConsecutive(
                array(array('user' => $user, 'date' => $date), null, null, null),
                array(array('user' => $user, 'date' => $oneWeekAgo), null, null, null),
                array(array('user' => $user, 'date' => $twoWeeksAgo), null, null, null)
            )
            ->will($this->returnValue(array()));


        $calendar = new Calendar($exerciseRepository);
        $actual = $calendar->getListData($user, $date);

        $this->assertEquals($expected, $actual);
    }
}
