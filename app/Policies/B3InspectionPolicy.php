<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class B3InspectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:B3Inspection');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:B3Inspection');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:B3Inspection');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:B3Inspection');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:B3Inspection');
    }

    public function restore(AuthUser $authUser): bool
    {
        return $authUser->can('Restore:B3Inspection');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDelete:B3Inspection');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:B3Inspection');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:B3Inspection');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return $authUser->can('Replicate:B3Inspection');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:B3Inspection');
    }
}
