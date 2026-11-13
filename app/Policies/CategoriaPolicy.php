<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoriaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
<<<<<<< HEAD
        return in_array($user->rol, ['administrador', 'coordinador', 'asistente']);
=======
        return in_array($user->rol, ['admin', 'coordinador', 'asistente']);
>>>>>>> 649496a72bd9272ad32d545f09b85399bfa544ca
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Categoria $categoria): bool
    {
<<<<<<< HEAD
        return in_array($user->rol, ['administrador', 'coordinador', 'asistente']);
=======
        return in_array($user->rol, ['admin', 'coordinador', 'asistente']);
>>>>>>> 649496a72bd9272ad32d545f09b85399bfa544ca
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
<<<<<<< HEAD
        return $user->rol === 'administrador';
=======
        return $user->rol === 'admin';
>>>>>>> 649496a72bd9272ad32d545f09b85399bfa544ca
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Categoria $categoria): bool
    {
<<<<<<< HEAD
        return in_array($user->rol, ['administrador', 'asistente']);
=======
        return in_array($user->rol, ['admin', 'asistente']);
>>>>>>> 649496a72bd9272ad32d545f09b85399bfa544ca
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Categoria $categoria): bool
    {
<<<<<<< HEAD
        return in_array($user->rol, ['administrador']);
=======
        return in_array($user->rol, ['admin']);
>>>>>>> 649496a72bd9272ad32d545f09b85399bfa544ca
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Categoria $categoria): bool
    {
<<<<<<< HEAD
        return in_array($user->rol, ['administrador']);
=======
        return in_array($user->rol, ['admin']);
>>>>>>> 649496a72bd9272ad32d545f09b85399bfa544ca
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Categoria $categoria): bool
    {
<<<<<<< HEAD
        return in_array($user->rol, ['administrador']);
    }
}
=======
        return in_array($user->rol, ['admin']);
    }
}
>>>>>>> 649496a72bd9272ad32d545f09b85399bfa544ca
