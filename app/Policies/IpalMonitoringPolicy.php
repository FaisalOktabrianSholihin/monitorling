<?php

namespace App\Policies;

use App\Models\User; // Gunakan model User dari aplikasi Anda
use App\Models\IpalMonitoring; // Import model terkait
use Illuminate\Auth\Access\HandlesAuthorization;

class IpalMonitoringPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('ViewAny:IpalMonitoring');
    }

    public function view(User $user, IpalMonitoring $ipalMonitoring): bool
    {
        return $user->can('View:IpalMonitoring');
    }

    public function create(User $user): bool
    {
        return $user->can('Create:IpalMonitoring');
    }

    public function update(User $user, IpalMonitoring $ipalMonitoring): bool
    {
        return $user->can('Update:IpalMonitoring');
    }

    public function delete(User $user, IpalMonitoring $ipalMonitoring): bool
    {
        return $user->can('Delete:IpalMonitoring');
    }

    public function restore(User $user, IpalMonitoring $ipalMonitoring): bool
    {
        return $user->can('Restore:IpalMonitoring');
    }

    public function forceDelete(User $user, IpalMonitoring $ipalMonitoring): bool
    {
        return $user->can('ForceDelete:IpalMonitoring');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('ForceDeleteAny:IpalMonitoring');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('RestoreAny:IpalMonitoring');
    }

    public function replicate(User $user, IpalMonitoring $ipalMonitoring): bool
    {
        return $user->can('Replicate:IpalMonitoring');
    }

    public function reorder(User $user): bool
    {
        return $user->can('Reorder:IpalMonitoring');
    }
}
