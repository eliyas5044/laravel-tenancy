<?php

namespace App\Tenancy\Listeners\Hooks;

use Tenancy\Hooks\Database\Events\Drivers\Configuring;

class DatabaseHook
{
    /**
     * Handle the event.
     *
     * @param Configuring $event
     * @return void
     */
    public function handle(Configuring $event)
    {
        $overrides = array_merge(
            $event->defaults($event->tenant),
            [
                'host' => '%',
                'database' => $event->tenant->subdomain . '_' . $event->tenant->id,
                'username' => $event->tenant->subdomain . '_' . $event->tenant->id,
            ]
        );
        $event->useConnection('mysql', $overrides);
    }
}
