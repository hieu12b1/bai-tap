<?php

namespace App\Http\Services;

use App\Models\User;
use Exception;

class UserService
{
    /**
     * Retrieve a list of all User records ordered by their status.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(array $searchParams)
    {
        $query = User::query()->orderByDesc('id');

        if (!empty($searchParams['name'])) {
            $query->where('name', 'LIKE', '%' . $searchParams['name'] . '%');
        }

        if (!empty($searchParams['phone'])) {
            $query->where('phone', 'LIKE', '%' . $searchParams['phone'] . '%');
        }

        if (!empty($searchParams['email'])) {
            $query->where('email', 'LIKE', '%' . $searchParams['email'] . '%');
        }

        $perPage = $searchParams['per_page'] ?? User::DEFAULT_LIMIT;
        return $query->paginate($perPage);
    }

    /**
     * Update an existing User record identified by its ID, along with an optional new image.
     *
     * @param array $data The updated data for the User record.
     * @param \Illuminate\Http\UploadedFile|null $file The new uploaded image file.
     * @param int $id The ID of the User record to update.
     * @return bool Indicates whether the update was successful.
     * @throws Exception If the User record does not exist.
     */
    public function updateStatus(array $data, $id)
    {
        $user = User::query()->findOrFail($id);
        if (!$user) {
            throw new Exception("user does not exist");
        }

        $user->status = $data['status'];
        return $user->save();
    }
}
