<?php

namespace Levi9\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/", name="calendar_index")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $calendarResults = $this->get('levi9_calendar.calendar')->getListData($user);
        return $this->render(
            'Levi9CalendarBundle:Default:index.html.twig',
            array('calendarResults' => $calendarResults)
        );
    }
}
