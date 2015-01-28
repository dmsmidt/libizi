<?php

/**
 * @file
 * Contains \Triquanta\IziTravel\DataType\Schedule.
 */

namespace Triquanta\IziTravel\DataType;

/**
 * Provides a schedule data type.
 */
class Schedule implements ScheduleInterface
{

    use FactoryTrait;

    /**
     * The schedule.
     *
     * @var array[]
     *   Keys are three-letter weekday abbreviations and values are arrays of
     *   opening and closing hours respectively, in a 24-hour format.
     */
    protected $schedule = [];

    /**
     * Creates a new instance.
     *
     * @param array[] $schedule
     *   Keys are three-letter weekday abbreviations and values are arrays of
     *   opening and closing hours respectively, in a 24-hour format.
     */
    public function __construct(array $schedule)
    {
        $this->schedule = $schedule;
    }

    public static function createFromData($data)
    {
        return new static((array) $data);
    }

    public function getMondaySchedule()
    {
        return $this->schedule['mon'];
    }

    public function getTuesdaySchedule()
    {
        return $this->schedule['tue'];
    }

    public function getWednesdaySchedule()
    {
        return $this->schedule['wed'];
    }

    public function getThursdaySchedule()
    {
        return $this->schedule['thu'];
    }

    public function getFridaySchedule()
    {
        return $this->schedule['fri'];
    }

    public function getSaturdaySchedule()
    {
        return $this->schedule['sat'];
    }

    public function getSundaySchedule()
    {
        return $this->schedule['sun'];
    }

}
