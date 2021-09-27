<?php

namespace App\Tenancy\Listeners\Hooks;

use Tenancy\Hooks\Migration\Events\ConfigureMigrations;
use Tenancy\Tenant\Events\Deleted;

class MigrationsHook
{
    /**
     * Handle the event.
     *
     * @param ConfigureMigrations $event
     * @return void
     */
    public function handle(ConfigureMigrations $event)
    {
        $event->flush();
        $event->path(database_path('migrations/tenancy'));

        if ($event->event instanceof Deleted) {
            $event->disable();
        }
    }
}
