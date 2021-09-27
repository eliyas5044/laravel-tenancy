<?php

namespace App\Tenancy;

use App\Models\Company;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Tenancy\Identification\Contracts\ResolvesTenants;
use Tenancy\Providers\Provides\ProvidesHooks;

class TenancyServiceProvider extends EventServiceProvider
{
    use ProvidesHooks;

    /**
     * T/T Ecosystem Custom Integration Hooks
     */
    protected array $hooks = [
        //
    ];

    /**
     * T/T Ecosystem Integration Event Listener Mappings
     *
     * @var array
     */
    protected $listen = [
        /**
         * Affects
         */
        \Tenancy\Affects\Connections\Events\Resolving::class => [
            Listeners\Affects\Connection\ResolveConnection::class,
        ],
        \Tenancy\Affects\Connections\Events\Drivers\Configuring::class => [
            Listeners\Affects\Connection\ConfigureConnection::class,
        ],
        \Tenancy\Affects\Routes\Events\ConfigureRoutes::class => [
            Listeners\Affects\Routes::class,
        ],
        \Tenancy\Affects\Configs\Events\ConfigureConfig::class => [
            Listeners\Packages\SpatiePermission\Config::class,
        ],

        /**
         * Hooks
         */
        \Tenancy\Hooks\Database\Events\Drivers\Configuring::class => [
            Listeners\Hooks\DatabaseHook::class,
        ],
        \Tenancy\Hooks\Database\Events\ConfigureDatabaseMutation::class => [
            Listeners\Hooks\MutationHook::class,
        ],
        \Tenancy\Hooks\Migration\Events\ConfigureMigrations::class => [
            Listeners\Hooks\MigrationsHook::class,
        ],
        \Tenancy\Hooks\Migration\Events\ConfigureSeeds::class => [
            Listeners\Hooks\SeedsHook::class,
        ],
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
        $this->runTrait('register');

        $this->app->resolving(ResolvesTenants::class, function (ResolvesTenants $resolver) {
            $resolver->addModel(Company::class);

            return $resolver;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->runTrait('boot');
    }

    /**
     * Ensure we run the appropriate methods
     * from the T/T trait we are forcing to be included
     * ensuring maximum flexibility for integration
     *
     * @return void
     * @var  string
     */
    protected function runTrait(string $runtime)
    {
        $class = static::class;

        foreach (class_uses_recursive($class) as $trait) {
            if (method_exists($class, $method = $runtime . class_basename($trait))) {
                call_user_func([$this, $method]);
            }
        }
    }
}
