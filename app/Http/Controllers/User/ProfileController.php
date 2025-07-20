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
}
