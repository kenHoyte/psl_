<?php

namespace App\Http\Controllers;

use App\Models\Member;
// use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function createStaff(Request $request){
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('staffs', 'email')],
            'contact' => ['required', 'string', 'max:255'],
            'staff_id' => ['required', 'string', 'max:255', Rule::unique('staffs', 'staff_id')],
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'role' => 'staff',
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
        ]);

        $staff = Member::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'staff_id' => $request->staff_id,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/home');
    }
}
