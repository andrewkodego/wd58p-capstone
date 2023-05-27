<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userList = User::withTrashed()->where('id','>',0);

        $filters = $request->all();

        if(array_key_exists('name', $filters)){
            $userList->where('name', 'like','%'.$filters['name'].'%');
        }

        $userList->orderby('deleted_at', 'asc');
        $userList->orderby('name', 'asc');

        $userList = $userList->paginate(config('constants.RECORD_PER_PAGE'));

        return view('console/users/index', compact('userList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $user->id = 0;
        $error = [];
        return view('console/users/edit', compact('error','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) : RedirectResponse
    {
        $validatedData = $request->validate($request->rules());

        $user = new User();
        /*
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if(isset($validatedData['password']) && isset($validatedData['confirm_password'])){
            if($validatedData['password'] == $validatedData['confirm_password']){
                $user->password = $validatedData['password'];
            }
        }

        $user->save();
        */

        $user = $this->doSaveRecord($user, $validatedData);

        return Redirect::route('users.edit', $user->id)->with('status','User record has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $error = [];
        return view('console/users/edit', compact('error','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $error = [];

        return view('console/users/edit', compact('error','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) : RedirectResponse
    {
        $validatedData = $request->validate($request->rules());

        /*
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if(isset($validatedData['password']) && isset($validatedData['confirm_password'])){
            if($validatedData['password'] == $validatedData['confirm_password']){
                $user->password = $validatedData['password'];
            }
        }

        $user->save();
        */

        $user = $this->doSaveRecord($user, $validatedData);

        return Redirect::route('users.edit', $user->id)->with('status','User record has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();

        return Redirect::route('users.index')->with('status','Record has been deleted.');
    }

    public function restore($id) : RedirectResponse
    {
        $user = User::withTrashed()->find($id);
        if($user){
            $user->restore();
            return Redirect::route('users.index')->with('status','Record has been restored.');
        }else{
            return Redirect::route('users.index')->with('status','Record has not been restored.');
        }        
    }

    protected function doSaveRecord($user, $validatedData){

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if(isset($validatedData['password']) && isset($validatedData['confirm_password'])){
            if($validatedData['password'] == $validatedData['confirm_password']){
                $user->password = $validatedData['password'];
            }
        }

        $user->save();

        return $user;
    }
}
