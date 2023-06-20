<?php

namespace App\Repository\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LazyElePHPant\Repository\Repository;

class ProfileRepository extends Repository
{
    public function model()
    {
        return User::class;
    }

    public function updatePassword(array $data, $id)
    {
        $profile = $this->getModel()->findOrFail($id);

        if (Hash::check($data['current_password'], $profile->password)) {
            $profile->update([
                'password' => Hash::make($data['password'])
            ]);
        }

        return $profile;
    }
}
