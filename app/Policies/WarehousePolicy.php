<?php

namespace App\Policies;

use App\Models\User;
use App\Models\warehouse;
use Illuminate\Auth\Access\HandlesAuthorization;

class WarehousePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['Super Admin','Admin']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, warehouse $warehouse): bool
    {
        if ($user->hasPermissionTo('View Warehouse')) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasPermissionTo('Create Warehouse')) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, warehouse $warehouse): bool
    {
        if ($user->hasPermissionTo('Update Warehouse')) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, warehouse $warehouse): bool
    {
        if ($user->hasPermissionTo('Delete Warehouse')) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, warehouse $warehouse): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, warehouse $warehouse): bool
    {
        //
    }
}
