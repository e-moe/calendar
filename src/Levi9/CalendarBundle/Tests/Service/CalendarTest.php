<?php

namespace Levi9\CalendarBundle\Tests\Service;

use Levi9\CalendarBundle\Entity\CalendarResults;
use Levi9\CalendarBundle\Service\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetListData()
    {


        //todo: about CalendarResults. This is not a Unit test, because you are testing integration of service class and CalendarResults class.
        // there are two options, how to make this test "Unit test":
        // Option 1: You should inject a factory into service class. (Factory is another service, that just creates new instances of CalendarResults via "new" operator)
        // Then in the test, you will define mock of this Factory. When factory method is executed - Factory will return mock of CalendarResults
        // And then you will assert, that "setToday" method is called on CalendarResults mock with expected arguments.

        // Option 2: Use associative array instead of CalendarResults class.
        // For this task (application) I'd rather go for array. Because this will simplify a lot - service, test, CalendarResults is not needed.
        // And this class is used only twice - in service to set data, and in 1 template to render data
        // Laziness in writing big Unit test here helps to make simple architecture :)

        $expected = array(
            'today'         => array(),
            '1_week_ago'    => array(),
            '2_weeks_ago'   => array(),
        );

        $user = $this->getMock('\Levi9\CalendarBundle\Entity\User');

        $date = new \DateTimeImmutable('today');
        $oneWeekAgo = $date->sub(\DateInterval::createFromDateString('1 week'));
        $twoWeeksAgo = $date->sub(\DateInterval::createFromDateString('2 weeks'));

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
