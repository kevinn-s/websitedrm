<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AlumniPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Alumni $alumni): bool
    {
        if ($this->isAdmin($user)) {
            return true;
        }

        return $this->isOwner($user, $alumni);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Alumni $alumni): bool
    {
        if ($this->isAdmin($user)) {
            return true;
        }

        return $this->isOwner($user, $alumni);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Alumni $alumni): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Alumni $alumni): bool
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Alumni $alumni): bool
    {
        return $this->isAdmin($user);
    }

    protected function isAdmin(User $user): bool
    {
        $role = $user->role;

        if ($role instanceof UserRole) {
            return $role->isAdmin();
        }

        return $role === UserRole::Admin->value;
    }

    protected function isOwner(User $user, Alumni $alumni): bool
    {
        $userAlumni = $user->alumni;

        return $userAlumni ? $userAlumni->is($alumni) : false;
    }
}
