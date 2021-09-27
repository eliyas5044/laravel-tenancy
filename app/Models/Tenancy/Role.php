<?php

namespace App\Models\Tenancy;

use Spatie\Permission\Models\Role as SpatieRole;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class Role extends SpatieRole
{
    use OnTenant;
}
