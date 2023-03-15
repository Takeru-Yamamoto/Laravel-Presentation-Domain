<?php

namespace MyCustom\Services;

use MyCustom\Events\BaseEvent;

trait Event
{
    /**
     * eventをpublishするときの簡略化
     *
     * @param BaseEvent $event
     * @param bool|null $isLogging
     */
    function publishEvent(BaseEvent $event, bool $isLogging = null): void
    {
        if (is_null($isLogging)) $isLogging = config("mycustoms.presentation-domain.logging_event", false);

        $className = className($event);

        if ($isLogging) emphasisLogStart("EVENT " . $className . " PUBLISHING");

        try {
            if ($isLogging) {
                foreach ($event->params() as $key => $parameter) {
                    infoLog("EVENT PARAMS " . $key . ": " . jsonEncode($parameter));
                }
            }

            event($event);

            if ($isLogging) infoLog("EVENT " . $className . " IS PUBLISHED");
        } catch (\Exception $e) {
            errorLog("EVENT " . $className . " PUBLISHING FAILURE");
            errorLog("ERROR: " . $e->getMessage());
        }

        if ($isLogging) emphasisLogEnd("EVENT " . $className . " PUBLISHING");
    }
}
