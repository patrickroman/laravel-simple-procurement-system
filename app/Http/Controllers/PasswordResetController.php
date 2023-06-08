<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function resetPassword(Request $request)
    {
        $code = $request->input('code');

        if (!$code) {
            return redirect('login');
        }


        $user = DB::table('users')
            ->where('code', $code)
            ->where('updated_at', '>=', DB::raw('NOW() - INTERVAL 1 DAY'))
            ->first();

        if (!$user) {
            return redirect('login');
        }

        if ($request->isMethod('post')) {
            $email = $request->input('email');
            $newPassword = $request->input('newpass');

            DB::table('users')
                ->where('email', $email)
                ->where('code', $code)
                ->where('updated_at', '>=', DB::raw('NOW() - INTERVAL 1 DAY'))
                ->update(['password' => Hash::make($newPassword)]);

            return redirect('success');
        }

        return redirect('login');
    }
}
