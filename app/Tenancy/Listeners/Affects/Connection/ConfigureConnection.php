<?php

namespace App\Tenancy\Listeners\Affects\Connection;

use Tenancy\Affects\Connections\Events\Drivers\Configuring;

class ConfigureConnection
{
    /**
     * Handle the event.
     *
     * @param Configuring $event
     * @return void
     */
    public function handle(Configuring $event)
    {
        $tenant = $event->tenant;
        if (!is_null($tenant)) {
            $overrides = array_merge(
                $event->defaults($event->tenant),
                [
                    'database' => $event->tenant->subdomain . '_' . $event->tenant->id,
                    'username' => $event->tenant->subdomain . '_' . $event->tenant->id,
                ]
            );
            $event->useConnection('mysql', $overrides);
        }
    }
}
