<?php

namespace AllDigitalRewards\NeoCurrency\Campaigns;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class Campaign extends AbstractEntity
{
    protected $id;
    protected $name;
    protected $description;
    protected $status;
    protected $start_date;
    protected $end_date;
    protected $timezone;
    protected $project_id;
    protected $fund_id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function setStartDate($start_date): void
    {
        $this->start_date = $start_date;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function setEndDate($end_date): void
    {
        $this->end_date = $end_date;
    }

    public function getTimezone()
    {
        return $this->timezone;
    }

    public function setTimezone($timezone): void
    {
        $this->timezone = $timezone;
    }

    public function getProjectId()
    {
        return $this->project_id;
    }

    public function setProjectId($project_id): void
    {
        $this->project_id = $project_id;
    }

    public function getFundId()
    {
        return $this->fund_id;
    }

    public function setFundId($fund_id): void
    {
        $this->fund_id = $fund_id;
    }
}
