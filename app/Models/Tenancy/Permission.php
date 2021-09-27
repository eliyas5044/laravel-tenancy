<?php

namespace App\Models\Tenancy;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class Permission extends SpatiePermission
{
    use OnTenant;
}
