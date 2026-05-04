<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class B3LogbookPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:B3Logbook');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:B3Logbook');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:B3Logbook');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:B3Logbook');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:B3Logbook');
    }

    public function restore(AuthUser $authUser): bool
    {
        return $authUser->can('Restore:B3Logbook');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDelete:B3Logbook');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:B3Logbook');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:B3Logbook');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return $authUser->can('Replicate:B3Logbook');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:B3Logbook');
    }
}
