<?php

namespace Levi9\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        $calendarResults = $this->get('levi9_calendar.calendar')->getListData();
        return $this->render(
            'Levi9CalendarBundle:Default:index.html.twig',
            array('calendarResults' => $calendarResults)
        );
    }
}
