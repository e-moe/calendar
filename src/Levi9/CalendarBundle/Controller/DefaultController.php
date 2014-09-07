<?php

namespace Levi9\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route(
     *      "/{_locale}",
     *      name="calendar_index",
     *      requirements={"_locale" = "en|ru"},
     *      defaults={"_locale" = "en"}
     *  )
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
