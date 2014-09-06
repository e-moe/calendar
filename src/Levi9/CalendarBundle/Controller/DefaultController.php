<?php

namespace Levi9\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Levi9CalendarBundle:Default:index.html.twig', array('name' => $name));
    }
}
