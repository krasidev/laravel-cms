<?php

namespace App\Repository\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LazyElePHPant\Repository\Repository;

class UserRepository extends Repository
{
    public function model()
    {
        return User::class;
    }

    public function data($data)
    {
		$users = $this->getModel()
			->select('users.*');

        if (request()->trashed) {
            $users->onlyTrashed();
        }

        $datatable = datatables()->eloquent($users);

        $datatable->addColumn('actions', function($user) {
			return view('backend.users.table.table-actions', compact('user'));
		});

        return $datatable->make(true);
    }

    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->getModel()->create($data);

        return $user;
    }

    public function update(array $data, $id, $attribute = 'id')
    {
		if (isset($data['password'])) {
			$data['password'] = Hash::make($data['password']);
		} else {
			unset($data['password']);
		}

        $user = $this->getModel()->findOrFail($id);

        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        if ($this->getModel()->where('id', $id)->where('id', '<>', auth()->user()->id)->exists()) {
            return $this->getModel()->destroy($id);
        }
    }

    public function restore($id)
    {
        return $this->getModel()->withTrashed()->findOrFail($id)->restore();
    }

    public function forceDelete($id)
    {
        if ($this->getModel()->withTrashed()->where('id', $id)->where('id', '<>', auth()->user()->id)->exists()) {
            return $this->getModel()->withTrashed()->findOrFail($id)->forceDelete();
        }
    }
}
