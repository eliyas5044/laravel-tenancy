<?php

namespace App\Tenancy\Listeners\Packages\SpatiePermission;

use App\Models\Tenancy\Permission;
use App\Models\Tenancy\Role;
use Illuminate\Notifications\DatabaseNotification;
use Tenancy\Affects\Configs\Events\ConfigureConfig;

class Config
{
    /**
     * Handle the event.
     *
     * @param ConfigureConfig $event
     * @return void
     */
    public function handle(ConfigureConfig $event)
    {
        $tenant = $event->event->tenant;
        if (!is_null($tenant)) {
            $event->config->set('permission.models', [
                'role' => Role::class,
                'permission' => Permission::class,
            ]);
        }
    }
}
