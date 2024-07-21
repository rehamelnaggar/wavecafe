<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with a list of all users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        return view('dashAdmin.users', compact('users'));
    }

    /**
     * Insert a new user into the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('dashAdmin.addUser');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'active' => $request->has('active') ? true : false, 
        ]);
    
        return redirect()->route('admin.users')->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        // Retrieve the user from the database
        $user = User::findOrFail($id);

        // Pass the user data to the edit view
        return view('dashAdmin.editUser', compact('user'));
    }

    /**
     * Update the specified user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        Log::info('Received update request', $request->all());       

    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $id,
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'active' => 'boolean',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    Log::info('Validation passed');

    // Retrieve the user from the database
    $user = User::findOrFail($id);
    Log::info('User found', ['user' => $user]);

    // Update user data
    $user->name = $request->input('name');
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->active = $request->boolean('active');

    // Update other fields as needed
    if ($request->filled('password')) {
        $user->password = $request->input('password');
    }

    $user->save();
    Log::info('User updated', ['user' => $user]);

    return redirect()->route('admin.users')->with('success', 'User updated successfully');
}
    }