<?php

namespace Levi9\CalendarBundle\Entity;

use Levi9\CalendarBundle\Entity\Exercise;

class CalendarResults
{
    /** @var Exercise[] */
    protected $today = array();

    /** @var Exercise[] */
    protected $oneWeekAgo = array();

    /** @var Exercise[] */
    protected $twoWeeksAgo = array();

    /**
     * @param \Levi9\CalendarBundle\Entity\Exercise[] $oneWeekAgo
     * @return CalendarResults
     */
    public function setOneWeekAgo(array $oneWeekAgo)
    {
        $this->oneWeekAgo = $oneWeekAgo;
        return $this;
    }

    /**
     * @return \Levi9\CalendarBundle\Entity\Exercise[]
     */
    public function getOneWeekAgo()
    {
        return $this->oneWeekAgo;
    }

    /**
     * @param \Levi9\CalendarBundle\Entity\Exercise[] $today
     * @return CalendarResults
     */
    public function setToday(array $today)
    {
        $this->today = $today;
        return $this;
    }

    /**
     * @return \Levi9\CalendarBundle\Entity\Exercise[]
     */
    public function getToday()
    {
        return $this->today;
    }

    /**
     * @param \Levi9\CalendarBundle\Entity\Exercise[] $twoWeeksAgo
     * @return CalendarResults
     */
    public function setTwoWeeksAgo(array $twoWeeksAgo)
    {
        $this->twoWeeksAgo = $twoWeeksAgo;
        return $this;
    }

    /**
     * @return \Levi9\CalendarBundle\Entity\Exercise[]
     */
    public function getTwoWeeksAgo()
    {
        return $this->twoWeeksAgo;
    }
}
