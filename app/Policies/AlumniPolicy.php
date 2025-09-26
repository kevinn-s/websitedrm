<?php

namespace App\Policies;

use App\Models\Alumni;
use Illuminate\Auth\Access\Response;

class AlumniPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Alumni $alumni): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Alumni $user, Alumni $alumni): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Alumni $alumni): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Alumni $alumni)
    {
        // If user is an Admin, they can update any alumni
        if ($user instanceof Admin) {
            return Response::allow();
        }
        
        // If user is an Alumni, they can only update their own profile
        if ($user instanceof User) {
            return $user->id === $alumni->id
                ? Response::allow()
                : Response::deny('You can only edit your own profile.');
        }
        
        // Deny for any other user type
        return Response::denyAsNotFound();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Alumni $user, Alumni $alumni): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Alumni $user, Alumni $alumni): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Alumni $user, Alumni $alumni): bool
    {
        return false;
    }
}
