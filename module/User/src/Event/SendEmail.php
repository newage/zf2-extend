<?php

namespace User\Event;

use Zend\EventManager\Event;

/**
 * Send emails
 * @package User\Event
 */
class SendEmail
{

    /**
     * Send email after registration
     * @param Event $event
     */
    public function registration(Event $event)
    {
        $event->getParam('email');
        /* Send email */
    }
}