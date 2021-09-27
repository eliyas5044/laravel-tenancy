<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\InputInterface;
use Tenancy\Facades\Tenancy;
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Contracts\Tenant;
use Tenancy\Identification\Drivers\Console\Contracts\IdentifiesByConsole;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;
use Tenancy\Identification\Drivers\Queue\Contracts\IdentifiesByQueue;
use Tenancy\Identification\Drivers\Queue\Events\Processing;
use Tenancy\Tenant\Events\Created;
use Tenancy\Tenant\Events\Deleted;
use Tenancy\Tenant\Events\Updated;

class Company extends Model implements Tenant, IdentifiesByHttp, IdentifiesByQueue, IdentifiesByConsole
{
    use HasFactory, AllowsTenantIdentification;

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'created' => Created::class,
        'updated' => Updated::class,
        'deleted' => Deleted::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'uuid',
        'status',
        'subdomain',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Specify whether the tenant model is matching the request.
     *
     * @param Request $request
     *
     * @return Tenant|null
     */
    public function tenantIdentificationByHttp(Request $request): ?Tenant
    {
        // get request segment 1 as subdomain
        $segment = $request->segment(1);
        if ($segment === 'tenancy') {
            $subdomain = $request->segment(2);
            return $this->newQuery()
                ->where('subdomain', '=', $subdomain)
                ->first();
        }

        return null;
    }

    /**
     * Specify whether the tenant model is matching the queue job.
     *
     * @param Processing $event
     *
     * @return Tenant|null
     */
    public function tenantIdentificationByQueue(Processing $event): ?Tenant
    {
        if ($event->tenant) {
            return $event->tenant;
        }

        if ($event->tenant_key && $event->tenant_identifier === $this->getTenantIdentifier()) {
            return $this->newQuery()
                ->where($this->getTenantKeyName(), $event->tenant_key)
                ->first();
        }

        return null;
    }

    /**
     * Specify whether the tenant model is matching the request.
     *
     * @param InputInterface $input
     *
     * @return null|Tenant
     */
    public function tenantIdentificationByConsole(InputInterface $input): ?Tenant
    {
        if ($input->hasParameterOption('--tenant')) {
            return $this->newQuery()
                ->where('subdomain', '=', $input->getParameterOption('--tenant'))
                ->first();
        }

        return null;
    }
}
