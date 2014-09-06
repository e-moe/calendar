<?php

namespace Levi9\CalendarBundle\Tests\Service;

use Levi9\CalendarBundle\Service\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetListData()
    {
        $expected = array(
            '2_week' => array(),
            '1_week' => array(),
            'today' => array(),
        );


        $exerciseRepository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $exerciseRepository->expects($this->exactly(3))
            ->method('findBy')
            ->will($this->returnValue(array()));


        $calendar = new Calendar($exerciseRepository);
        $actual = $calendar->getListData();

        $this->assertEquals($expected, $actual);
    }
}