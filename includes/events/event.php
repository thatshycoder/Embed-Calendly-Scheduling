<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

class EMCS_Event
{
    private $name = '';
    private $description = '';
    private $status = false;
    private $url = '';

    public function __construct($name, $description, $status, $url)
    {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->url = $url;
    }

    public function get_event_name()
    {
        return $this->name;
    }

    public function get_event_description()
    {
        return $this->description;
    }

    public function get_event_status()
    {
        return $this->status;
    }

    public function get_event_url()
    {
        return $this->url;
    }
}
