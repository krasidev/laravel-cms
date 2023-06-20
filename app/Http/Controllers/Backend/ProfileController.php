<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdatePasswordProfileRequest;
use App\Http\Requests\Backend\UpdateProfileRequest;
use App\Repository\Backend\ProfileRepository;

class ProfileController extends Controller
{
    private $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('backend.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Backend\UpdateProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $this->repository->update($request->only(['name', 'email']), auth()->user()->id);

        return redirect()->route('backend.profile.edit')
            ->with('success', [
                'title' => __('messages.backend.profile.update_success.title'),
                'text' => __('messages.backend.profile.update_success.text')
            ]);
    }

    /**
     * Update password in storage.
     *
     * @param  \App\Http\Requests\Backend\UpdatePasswordProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordProfileRequest $request)
    {
        $this->repository->updatePassword($request->only(['current_password', 'password']), auth()->user()->id);

        return redirect()->route('backend.profile.edit')
            ->with('success', [
                'title' => __('messages.backend.profile.update_password_success.title'),
                'text' => __('messages.backend.profile.update_password_success.text')
            ]);
    }
}
