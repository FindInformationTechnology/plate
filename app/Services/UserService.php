<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class UserService
{
    /**
     * Get all users
     *
     * @return Collection
     */

    public function login($userData): User|null{
        $user = User::where('email', $userData['email'])->first();

        if (!$user || !Hash::check($userData['password'], $user->password)) {
            return null;
        } else {  
            return $user;
         }

    }
    

    public function getAllUsers(): Collection
    {
        return User::all();
    }

    /**
     * Get user by ID
     *
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * Create a new user
     *
     * @param array $userData
     * @return User
     */
    public function createUser(array $userData, $verify = true): User
    {
        $cleanUserData = $this->prepareUserData($userData);
        
        $user = User::create($cleanUserData);

        if ($verify) {
            // $user->sendEmailVerificationNotification();
        }

        return $user;

    }

    /**
     * Update an existing user
     *
     * @param int $id
     * @param array $userData
     * @return User|null
     */
    public function updateUser(int $id, array $userData): ?User
    {
        $user = $this->getUserById($id);

        if (!$user) {
            return null;
        }

        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        }

        $user->update($userData);
        return $user;
    }

    /**
     * Delete a user
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->getUserById($id);

        if (!$user) {
            return false;
        }

        return $user->delete();
    }

    protected function prepareUserData(array $data): array
    {
        return [
            'name' => ucfirst($data['name']),
            'email' => strtolower($data['email']),
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'emirate' => $data['emirate'] ?? null,
            'nationality' => $data['nationality'] ?? null,
            'status' => $data['status'] ?? 'active',
            'remember_token' => Str::random(60),
        ];
    }
}