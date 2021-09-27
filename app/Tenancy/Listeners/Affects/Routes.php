<?php

namespace App\Tenancy\Listeners\Affects;

use Tenancy\Affects\Routes\Events\ConfigureRoutes;

class Routes
{
    /**
     * Handle the event.
     *
     * @param ConfigureRoutes $event
     * @return void
     */
    public function handle(ConfigureRoutes $event)
    {
        $tenant = $event->event->tenant;
        if (!is_null($tenant)) {
            $event->flush()
                ->fromFile(
                    ['middleware' => ['web'], 'prefix' => 'tenancy/' . $tenant->subdomain],
                    base_path('routes/tenancy/web.php')
                )->fromFile(
                    ['middleware' => ['api'], 'prefix' => 'tenancy/' . $tenant->subdomain],
                    base_path('routes/tenancy/api.php')
                );
        }
    }
}
