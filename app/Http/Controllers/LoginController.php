<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\AuditTrailModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->input('remember');
        $data = DB::select('SELECT * FROM users WHERE Email = ? AND Password = ?', [$username, $password]);

        if ($data == NULL) {
            return redirect('/')->with('alert', 'Invalid Email or Password');
        }

        foreach ($data as  $data) {
            $name = $data->userID;
            $department = $data->Department;
            $role = $data->Role;
        }

        if ($role == "Admin") {
            Session::put('user', $name);
            Session::put('username', $username);
            Session::put('password', $password);


            // Retrieve the username and password from the session
            $username = session('username');
            $password = session('password');

            if (!$request->session()->has('username') || !$request->session()->has('password')) {
                return redirect('/login');
            }

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }

            return redirect('admin')->with('message', ' ');
        } else if ($department == "CSA") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('csadashboard')->with('message', ' ');
        } else if ($department == "CEAT") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('ceatdashboard')->with('message', ' ');
        } else if ($department == "CAS") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('casdashboard')->with('message', ' ');
        } else if ($department == "CBET") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('cbetdashboard')->with('message', ' ');
        } else if ($department == "CED") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('ceddashboard')->with('message', ' ');
        } else if ($department == "IPE") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('ipedashboard')->with('message', ' ');
        } else if ($department == "Supply Office" && $role == "Approver") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();
            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('sodashboard')->with('message', ' ');
        } else if ($department == "Supply Office" && $role == "Requestor") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();
            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('supplydashboard')->with('message', ' ');
        } else if ($department == "Finance Office" && $role == "Approver") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();
            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('fodashboard')->with('message', ' ');
        } else if ($department == "Finance Office" && $role == "Requestor") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();
            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('financedashboard')->with('message', ' ');
        } else if ($department == "Office of the President" && $role == "Approver") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();
            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }

            return redirect('opdashboard')->with('message', ' ');
        } else if ($department == "Office of the President" && $role == "Requestor") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();
            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }

            return redirect('presidentdashboard')->with('message', ' ');
        } else if ($department == "BAC Office" && $role == "Approver") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();
            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('bacpage')->with('message', ' ');
        } else if ($department == "BAC Office" && $role == "Requestor") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();
            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('bacdashboard')->with('message', ' ');
        } else if ($department == "MIC") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('micdashboard')->with('message', ' ');
        } else if ($department == "DRRMO") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('drrmodashboard')->with('message', ' ');
        } else if ($department == "GCSC") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('gcscdashboard')->with('message', ' ');
        } else if ($department == "OVP") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('ovpdashboard')->with('message', ' ');
        } else if ($department == "SGO") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('sgodashboard')->with('message', ' ');
        } else if ($department == "SRAC") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('sracdashboard')->with('message', ' ');
        } else if ($department == "HRDC") {
            Session::put('user', $name);

            $insert = new AuditTrailModel;

            $insert->user = $name;
            $insert->action_made =  "Logged in to the System";

            $insert->save();

            if ($remember) {
                $cookie_name = 'login_cookie';
                $cookie_data = array(
                    'username' => $username,
                    'password' => $password
                );
                $cookie_duration = 60 * 24 * 30; // 30 days
                Cookie::queue($cookie_name, json_encode($cookie_data), $cookie_duration);
            } else {
                // Remove the login cookie if "Remember Me" is unchecked
                Cookie::queue(Cookie::forget('login_cookie'));
            }
            return redirect('hrdcdashboard')->with('message', ' ');
        } else {
            return redirect('/');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flush();
        if (session()->has('user')) {
            session()->forget('user');
            return redirect('/');
        }
        return redirect('/');
    }
}
