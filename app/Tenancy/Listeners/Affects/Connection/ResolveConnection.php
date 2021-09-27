<?php

namespace App\Tenancy\Listeners\Affects\Connection;

use Tenancy\Affects\Connections\Contracts\ProvidesConfiguration;
use Tenancy\Affects\Connections\Events\Drivers\Configuring;
use Tenancy\Affects\Connections\Events\Resolving;
use Tenancy\Identification\Contracts\Tenant;

class ResolveConnection implements ProvidesConfiguration
{

    /**
     * Handle the event.
     *
     * @param Resolving $event
     * @return ProvidesConfiguration
     */
    public function handle(Resolving $event): ProvidesConfiguration
    {
        return $this;
    }

    /**
     * @param Tenant $tenant
     *
     * @return array
     */
    public function configure(Tenant $tenant): array
    {
        $config = [];

        event(new Configuring($tenant, $config, $this));

        return $config;
    }
}
