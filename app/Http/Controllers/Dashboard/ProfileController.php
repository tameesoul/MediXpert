<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('dashboard.profile.edit',[
            'user'=>$user,
            'countries'=>Countries::getNames(),
            'locals'=>Languages::getNames(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name'=>['required','string','max:255'],
            'last_name'=>['required','string','max:255'],
            'birth_date'=>['nullable','date','before:today'],
            'gender'=>['in:m,f'],
            'country'=>['required','string','size:2'],
        ]);
        $user = $request->user();
        $user->profile->fill( $request->all() )->save();
        return redirect()
        ->route('dashboard.profile.edit')
        ->with('success','profile updated');
    }   
}
