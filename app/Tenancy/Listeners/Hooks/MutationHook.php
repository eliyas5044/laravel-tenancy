<?php

namespace App\Tenancy\Listeners\Hooks;

use Tenancy\Hooks\Database\Events\ConfigureDatabaseMutation;
use Tenancy\Tenant\Events\Deleted;

class MutationHook
{
    /**
     * Handle the event.
     *
     * @param ConfigureDatabaseMutation $event
     * @return void
     */
    public function handle(ConfigureDatabaseMutation $event)
    {
        if ($event->event instanceof Deleted) {
//            if (!$event->event->tenant->forceDeleting) {
//                $event->disable();
//            }
        }
    }
}
