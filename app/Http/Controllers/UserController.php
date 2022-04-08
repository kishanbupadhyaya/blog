<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', \Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();

        return view('users.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required'],
            'phone' => ['required', 'numeric'],
            'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'same:confirm_password'],
            'confirm_password' => ['required', 'string', 'min:8'],
        ]);

        $data = request()->all();

        DB::beginTransaction();

        try {
            User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'dob' => $data['dob'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'password' => Hash::make($data['password']),
            ]);

            DB::commit();

        } catch(\ModelException $e) {
            DB::rollback();
        }

        return redirect()->route('users.index')->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact(['user', 'id']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'dob' => ['required'],
            'phone' => ['required', 'numeric'],
            'gender' => ['required'],
        ];

        if (request('password') != '') {
            $rules['password'] = ['required', 'string', 'min:8', 'same:confirm_password'];
            $rules['confirm_password'] = ['required', 'string', 'min:8'];
        }

        $this->validate(request(), $rules);

        DB::beginTransaction();

        try {
            $data   = request()->all();
            $user   = User::findOrFail($id);

            $user->first_name   = $data['first_name'];
            $user->last_name    = $data['last_name'];
            $user->email        = $data['email'];
            $user->phone        = $data['phone'];
            $user->gender       = $data['gender'];
            $user->dob          = $data['dob'];
            $user->save();

            DB::commit();

        } catch(\ModelException $e) {
            DB::rollback();
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user   = User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
