<?php

namespace Levi9\CalendarBundle\Tests\Service;

use Levi9\CalendarBundle\Entity\CalendarResults;
use Levi9\CalendarBundle\Service\Calendar;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetListData()
    {
        //todo: there are two issues with this test and service - with dates and with CalendarResults.

        //todo: about Dates. In current implementation test might fail in midnight and if computer is slow.
        // This is because date, generated in test could be not the same like date generated in service class a moment ago.
        // To make this in a right way you should pass date into service. For example - via not required argument "currentDate".
        // If currentDate was not passed in call of getListData - service will generate date. But you will pass it from test.
        // (You could find out another option, how to pass Date into service, for example via extra setter, if you want)
        // Also it is not good to work with current dates from test. It's better to run test with predefined dates,
        // for example, 15-th of May, 8-th of May and 1-th of May.

        //todo: about CalendarResults. This is not a Unit test, because you are testing integration of service class and CalendarResults class.
        // there are two options, how to make this test "Unit test":
        // Option 1: You should inject a factory into service class. (Factory is another service, that just creates new instances of CalendarResults via "new" operator)
        // Then in the test, you will define mock of this Factory. When factory method is executed - Factory will return mock of CalendarResults
        // And then you will assert, that "setToday" method is called on CalendarResults mock with expected arguments.

        // Option 2: Use associative array instead of CalendarResults class.
        // For this task (application) I'd rather go for array. Because this will simplify a lot - service, test, CalendarResults is not needed.
        // And this class is used only twice - in service to set data, and in 1 template to render data
        // Laziness in writing big Unit test here helps to make simple architecture :)

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
