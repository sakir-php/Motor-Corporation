<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name'     => 'required|string',
            'user_email'    => 'required|email|unique:users,email',
            'user_phone'    => 'nullable|string|max:11|unique:users,phone',
            'user_address'  => 'nullable|string',
            'user_pass'     => 'nullable|min:4',
            'image'         => 'nullable|image',
        ]);

        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;
        $user->address = $request->user_address;
        $user->password = Hash::make($request->user_pass ?? Str::random(8));
        if ($request->file('image')) {
            $user->image = file_uploader('uploads/user-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') . '-' . Str::slug($request->user_name, '-'));
        }
        $user->save();
        toastr()->success('Successfully Saved!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (request()->ajax()) {
            return $user;
        }
        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'user_name'     => 'required|string',
            'user_email'    => 'required|unique:users,email,' . $user->id,
            'user_phone'    => 'nullable|string|max:11|unique:users,phone,' . $user->id,
            'user_pass'     => 'nullable|min:4',
            'user_address'     => 'nullable',
            'image' => 'nullable|image',
        ]);

        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->phone = $request->user_phone;
        $user->address = $request->user_address;
        if ($request->user_pass) {
            $user->password = Hash::make($request->user_pass);
        }
        if ($request->file('image')) {
            $user->image = file_uploader('uploads/user-image/', $request->image, Carbon::now()->format('Y-m-d H-i-s-a') . '-' . Str::slug($request->user_name, '-'));
        }
        $user->save();

        toastr()->success('Successfully Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $user->delete();
        return [
            'type' => 'success',
            'message' => 'Successfully destroy',
        ];
    }
}
