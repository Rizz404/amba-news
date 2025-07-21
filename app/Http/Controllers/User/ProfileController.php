<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class ProfileController extends Controller
{
    //
    public function show(string $id): View
    {
        return view('pages.user.profile.index', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function upgradeRole(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'user') {
            $user->role = 'author';
            $user->save();
        }
        return redirect()->route('profile', $user->id)->with('success', 'Role berhasil diupgrade menjadi author.');
    }
}
