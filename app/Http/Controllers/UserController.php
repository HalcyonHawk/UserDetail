<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\UserSavedEvent;
use \App\Http\Requests\StoreUserRequest;
use \App\Http\Requests\UpdateUserRequest;
use App\Helpers\ImageHelper;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        //Pass urls and users
        return Inertia::render('User/Index', [
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'firstname' => $user->firstname,
                    'email' => $user->email,
                    'type' => $user->type,
                    'edit_url' => route('user.edit', ['user' => $user]),
                    'destroy_url' => route('user.destroy', ['user' => $user])
                ];
            }),
            'create_url' => route('user.create'),
            'trashed_url' => route('user.trashed'),
        ]);
        //return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('User/Create', [
            'store_url' => route('user.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //Use null when no photo uploaded. Default displayed from logic in model
        $storedFilename = null;
        //If a photo was uploaded
        if ($request->hasFile('photo')) {
            //Use Helper for logic so that code isn't repeated for updating photo
            $storedFilename = ImageHelper::uploadImage($request->file('photo'));
        }

        $request['photo'] = $storedFilename;
        $request['password'] = bcrypt($request->password);

        $user = User::create($request);

        //Update user details
        event(new UserSavedEvent($user));

        //Display page that shows the new user
        return redirect()->route('user.show', ['user' => $user])
            ->with('message', 'New user added');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Inertia::render('User/Show', [
            'user' => $user,
            'edit_url' => route('user.edit', ['user' => $user]),
            'delete_url' => route('user.delete', ['user' => $user])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('User/Edit', [
            'user' => $user,
            'update_url' => route('user.update', ['user' => $user])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //If a photo was uploaded
        if ($request->hasFile('photo')) {
            $request['photo'] = ImageHelper::uploadImage($request->file('photo'));
        } else {
            //If no photo uploaded, don't include it when updating
            unset($request['photo']);
        }

        //If no password enetered in update form, don't change it
        if ($request->password != null) {
            $request['password'] = bcrypt($request->password);
        } else {
            unset($request['password']);
        }


        $user = $user->update($request->except('_method'));

        //Update user details
        event(new UserSavedEvent($user));

        return redirect()->route('user.show', ['user' => $user])
            ->with('message', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('message', 'User soft deleted');
    }

    /**
     * View soft deleted users
     */
    public function trashed()
    {
        $users = User::onlyTrashed()->get();

        return Inertia::render('User/Trashed', [
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'fullName' => $user->fullName,
                    'email' => $user->email,
                    'type' => $user->type,
                    'deleted_at' => $user->deleted_at,
                    'restore_url' => route('user.restore', ['user' => $user]),
                    'force_delete_url' => route('user.delete', ['user' => $user])
                ];
            }),
            'index_url' => route('user.index')
        ]);
        //return Inertia::render('User/Trashed', ['users' => $trashed]);
    }

    /**
     * Restore a soft deleted user
     */
    public function restore(User $user)
    {
        $user->restore();

        return redirect()->route('user.index')
            ->with('message', 'User has been restored');
    }

    /**
     * Permantly delete a user
     */
    public function delete(User $user)
    {
        $user->forceDelete();

        return redirect()->route('user.index')
            ->with('message', 'User deleted');
    }
}
