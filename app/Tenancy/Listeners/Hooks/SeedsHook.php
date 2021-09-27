<?php

namespace App\Tenancy\Listeners\Hooks;

use Database\Seeders\PostsTableSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\UsersTableSeeder;
use Tenancy\Hooks\Migration\Events\ConfigureSeeds;
use Tenancy\Tenant\Events\Created;

class SeedsHook
{
    /**
     * Handle the event.
     *
     * @param ConfigureSeeds $event
     * @return void
     */
    public function handle(ConfigureSeeds $event)
    {
        // only seed during creation
        if ($event->event instanceof Created) {
            $event->seed(RolesAndPermissionsSeeder::class);
            $event->seed(UsersTableSeeder::class);
            $event->seed(PostsTableSeeder::class);
        } else {
            $event->disable();
        }
    }
}
