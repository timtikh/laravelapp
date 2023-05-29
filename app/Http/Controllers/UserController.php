<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {

            $users = User::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->get();

        } else {
            $users = User::all();
        }

        return view('user.index')->with('users', $users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        if (auth()->user()->role('admin')) {
            return view('user.create');
        }
        return redirect()->route('user.index')
            ->with('error', 'You do not have permission to create users.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
            'email' => 'required|email',
        ]);

        $user = User::create($validated);

        return view('user.show')->with('user', $user);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }

        if (auth()->user()->can('product.delete')) {
            return view('user.show')->with('user', $user);
        } else {
            return abort(403);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        if (auth()->user()->can('product.edit')) {
            return view('user.edit')->with('user', $user);
        }
        return redirect()->route('user.index')
            ->with('error', 'You do not have permission to edit users.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string',
            'email' => 'required|string',
        ]);

        $user->update($validated);

        return redirect()->route('user.show', $user->id)
            ->with('success', 'User updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        if (auth()->user()->can('product.destroy')) {
            $user->delete();
            return redirect()->route('user.index', $user->id)
                ->with('success', 'User deleted successfully.');
        }
        return abort(403);
    }
}
