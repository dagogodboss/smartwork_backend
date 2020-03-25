<?php
namespace App\Events;

interface NotifiableEvent
{
     /**
     * Returns the display name of the event 
     */
    public function getEventName(): string;
    /**
     * Returns the description of the event
     */
    public function getEventDescription(): string;
}