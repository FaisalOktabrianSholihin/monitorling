<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class B3InspectionItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:B3InspectionItem');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:B3InspectionItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:B3InspectionItem');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:B3InspectionItem');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:B3InspectionItem');
    }

    public function restore(AuthUser $authUser): bool
    {
        return $authUser->can('Restore:B3InspectionItem');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDelete:B3InspectionItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:B3InspectionItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:B3InspectionItem');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return $authUser->can('Replicate:B3InspectionItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:B3InspectionItem');
    }
}
