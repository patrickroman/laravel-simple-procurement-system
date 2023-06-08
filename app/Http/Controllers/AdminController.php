<?php
//AdminController
namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\CSAModel;
use App\Models\CEATModel;
use App\Models\CASModel;
use App\Models\CBETModel;
use App\Models\CEDModel;
use App\Models\IPEModel;
use App\Models\SupplyOfficeModel;
use App\Models\FinanceModel;
use App\Models\OfficePresModel;
use App\Models\BACModel;
use App\Models\MICModel;
use App\Models\DRRMOModel;
use App\Models\GCSCModel;
use App\Models\OVPModel;
use App\Models\SGOModel;
use App\Models\SRACModel;
use App\Models\HRDCModel;
use App\Models\AuditTrailModel;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    public function admin()
    {
        $usersession = Session::get('user');

        // Check if user is authenticated
        if (!session()->has('user')) {

            return redirect('/')->with('alert', 'Login to access this page');
        }

        $user = AdminModel::find($usersession);
        $username = $user->Firstname;

        $user = DB::select('SELECT * FROM users');
        $countUser = count($user);

        $activeRequest = DB::select('SELECT * FROM request WHERE request_status != 4 AND request_status != 5 ');
        $countActive = count($activeRequest);

        $closeRequest = DB::select('SELECT * FROM request WHERE  request_status = 4 OR request_status = 5 ');
        $countClosed = count($closeRequest);

        $department = 'CSA';
        $item = DB::select('SELECT * FROM csappmp WHERE checkbox = 1');
        $itemJson = json_encode($item);

        return view('admin/admin_template', ['username' => $username], compact('countUser', 'countActive', 'countClosed', 'itemJson', 'department'));
    }

    public function adminDashboard(Request $request)
    {

        $department = $request->input('department');

        $user = DB::select('SELECT * FROM users');
        $countUser = count($user);

        $activeRequest = DB::select('SELECT * FROM request WHERE request_status != 4 AND request_status != 5 ');
        $countActive = count($activeRequest);

        $closeRequest = DB::select('SELECT * FROM request WHERE  request_status = 4 OR request_status = 5 ');
        $countClosed = count($closeRequest);

        if ($department == 'CSA') {
            $item = DB::select('SELECT * FROM csappmp WHERE checkbox = 1');
        } else if ($department == 'CBET') {
            $item = DB::select('SELECT * FROM cbetppmp WHERE checkbox = 1');
        } else if ($department == 'CED') {
            $item = DB::select('SELECT * FROM cedppmp WHERE checkbox = 1');
        } else if ($department == 'CAS') {
            $item = DB::select('SELECT * FROM casppmp WHERE checkbox = 1');
        } else if ($department == 'CEAT') {
            $item = DB::select('SELECT * FROM ceatppmp WHERE checkbox = 1');
        } else if ($department == 'IPE') {
            $item = DB::select('SELECT * FROM ipeppmp WHERE checkbox = 1');
        } else if ($department == 'MIC') {
            $item = DB::select('SELECT * FROM micppmp WHERE checkbox = 1');
        } else if ($department == 'DRRMO') {
            $item = DB::select('SELECT * FROM drrmoppmp WHERE checkbox = 1');
        } else if ($department == 'GCSC') {
            $item = DB::select('SELECT * FROM gcscppmp WHERE checkbox = 1');
        } else if ($department == 'OVP') {
            $item = DB::select('SELECT * FROM ovpppmp WHERE checkbox = 1');
        } else if ($department == 'SGO') {
            $item = DB::select('SELECT * FROM sgoppmp WHERE checkbox = 1');
        } else if ($department == 'SRAC') {
            $item = DB::select('SELECT * FROM sracppmp WHERE checkbox = 1');
        } else if ($department == 'HRDC') {
            $item = DB::select('SELECT * FROM hrdcppmp WHERE checkbox = 1');
        } else if ($department == 'Supply') {
            $item = DB::select('SELECT * FROM supply WHERE checkbox = 1');
        } else if ($department == 'Finance') {
            $item = DB::select('SELECT * FROM finance WHERE checkbox = 1');
        } else if ($department == 'President') {
            $item = DB::select('SELECT * FROM president WHERE checkbox = 1');
        } else if ($department == 'BAC') {
            $item = DB::select('SELECT * FROM bac WHERE checkbox = 1');
        }

        $itemJson = json_encode($item);

        return view('admin/admin_template', compact('countUser', 'countActive', 'countClosed', 'itemJson', 'department'));
    }

    public function userlist()
    {


        $data = DB::select('SELECT * FROM users');

        return view('admin/usermanagement', ['userdata' => $data]);
    }

    public function adduser(Request $request)
    {

        $fname = $request->input('addfirstname');
        $lname = $request->input('addlastname');
        $email = $request->input('addemail');
        $pass = $request->input('adduserpass');
        $role = $request->input('addrole');
        $dept = $request->input('adddepartment');
        $user_name = $request->input('user_name');

        $insert = new AdminModel;

        $insert->Firstname = $fname;
        $insert->Lastname = $lname;
        $insert->Email = $email;
        $insert->Password = $pass;
        $insert->Department = $dept;
        $insert->Role = $role;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new user in to the System";

        $insertlogs->save();
        return redirect('usermanagement')->with('message', 'success user');
    }

    public function useredit(Request $request)
    {

        $user_id = $request->input('edituser');

        $data = DB::select('SELECT * FROM users WHERE userID = ?', [$user_id]);

        return view('admin/useredit', ['userdata' => $data]);
    }

    public function edituserdata(Request $request)
    {

        $user_id = $request->input('Id');
        $fname = $request->input('editfirstname');
        $lname = $request->input('editlastname');
        $email = $request->input('editemail');
        $pass = $request->input('edituserpass');
        $role = $request->input('editrole');
        $dept = $request->input('editdepartment');
        $user_name = $request->input('user_name');

        $update = AdminModel::find($user_id);

        $update->Firstname =  $fname;
        $update->Lastname =  $lname;
        $update->Email =  $email;
        $update->Password =  $pass;
        $update->Department =  $dept;
        $update->Role = $role;

        $update->save();

        $updatelogs = new AuditTrailModel;
        $updatelogs->user = $user_name;
        $updatelogs->action_made =  "Edited " . $fname . "'s data in the System";

        $updatelogs->save();
        return redirect('usermanagement')->with('message', 'update user');
    }

    public function userdelete(Request $request)
    {

        $user_id = $request->input('removeid');

        $data = AdminModel::find($user_id);
        $data->delete();

        return redirect('usermanagement')->with('message', 'delete user');
    }

    public function csaproplan()
    {

        $data = DB::select('SELECT * FROM csappmp WHERE checkbox = 0');

        return view('admin/ppmpcsa', ['proplandata' => $data]);
    }

    public function addcsaitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new CSAModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for CSA Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpcsa')->with('message', 'success');
    }

    public function csaedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM csappmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/csaedit', ['proplandata' => $data]);
    }

    public function editcsaitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = CSAModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for CSA Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpcsa')->with('message', 'update');
    }

    public function csadelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = CSAModel::find($item_id);
        $data->delete();

        return redirect('ppmpcsa')->with('message', 'delete item');
    }

    public function casproplan()
    {

        $data = DB::select('SELECT * FROM casppmp WHERE checkbox = 0');

        return view('admin/ppmpcas', ['proplandata' => $data]);
    }

    public function addcasitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new CASModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for CAS Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpcas')->with('message', 'success');
    }

    public function casedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM casppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/casedit', ['proplandata' => $data]);
    }

    public function editcasitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = CASModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for CAS Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpcas')->with('message', 'update');
    }

    public function casdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = CASModel::find($item_id);
        $data->delete();

        return redirect('ppmpcas')->with('message', 'delete item');
    }

    public function cbetproplan()
    {

        $data = DB::select('SELECT * FROM cbetppmp WHERE checkbox = 0');

        return view('admin/ppmpcbet', ['proplandata' => $data]);
    }

    public function addcbetitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new CBETModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for CBET Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpcbet')->with('message', 'success');
    }

    public function cbetedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM cbetppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/cbetedit', ['proplandata' => $data]);
    }

    public function editcbetitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = CBETModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for CBET Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpcbet')->with('message', 'update');
    }

    public function cbetdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = CBETModel::find($item_id);
        $data->delete();

        return redirect('ppmpcbet')->with('message', 'delete item');
    }

    public function ceatproplan()
    {

        $data = DB::select('SELECT * FROM ceatppmp WHERE checkbox = 0');

        return view('admin/ppmpceat', ['proplandata' => $data]);
    }

    public function addceatitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new CEATModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for CEAT Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpceat')->with('message', 'success');
    }

    public function ceatedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM ceatppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/ceatedit', ['proplandata' => $data]);
    }

    public function editceatitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = CEATModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for CEAT Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpceat')->with('message', 'update');
    }

    public function ceatdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = CEATModel::find($item_id);
        $data->delete();

        return redirect('ppmpceat')->with('message', 'delete item');
    }

    public function cedproplan()
    {

        $data = DB::select('SELECT * FROM cedppmp WHERE checkbox = 0');

        return view('admin/ppmpced', ['proplandata' => $data]);
    }

    public function addceditem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new CEDModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for CED Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpced')->with('message', 'success');
    }

    public function cededit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM cedppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/cededit', ['proplandata' => $data]);
    }

    public function editceditem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = CEDModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for CED Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpced')->with('message', 'update');
    }

    public function ceddelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = CEDModel::find($item_id);
        $data->delete();

        return redirect('ppmpced')->with('message', 'delete item');
    }

    public function ipeproplan()
    {

        $data = DB::select('SELECT * FROM ipeppmp WHERE checkbox = 0');

        return view('admin/ppmpipe', ['proplandata' => $data]);
    }

    public function addipeitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new IPEModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for IPE Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpipe')->with('message', 'success');
    }

    public function ipeedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM ipeppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/ipeedit', ['proplandata' => $data]);
    }

    public function editipeitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = IPEModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for IPE Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpipe')->with('message', 'update');
    }

    public function ipedelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = IPEModel::find($item_id);
        $data->delete();

        return redirect('ppmpipe')->with('message', 'delete item');
    }

    public function micproplan()
    {

        $data = DB::select('SELECT * FROM micppmp WHERE checkbox = 0');

        return view('admin/ppmpmic', ['proplandata' => $data]);
    }
    public function addmicitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new MICModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for MIC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpmic')->with('message', 'success');
    }
    public function micedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM micppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/micedit', ['proplandata' => $data]);
    }
    public function editmicitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = MICModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for MIC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpmic')->with('message', 'update');
    }
    public function micdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = MICModel::find($item_id);
        $data->delete();

        return redirect('ppmpmic')->with('message', 'delete item');
    }

    public function drrmoproplan()
    {

        $data = DB::select('SELECT * FROM drrmoppmp WHERE checkbox = 0');

        return view('admin/ppmpdrrmo', ['proplandata' => $data]);
    }
    public function adddrrmoitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new DRRMOModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for DRRMO Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpdrrmo')->with('message', 'success');
    }
    public function drrmoedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM drrmoppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/drrmoedit', ['proplandata' => $data]);
    }
    public function editdrrmoitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = DRRMOModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for DRRMO Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpdrrmo')->with('message', 'update');
    }
    public function drrmodelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = DRRMOModel::find($item_id);
        $data->delete();

        return redirect('ppmpdrrmo')->with('message', 'delete item');
    }

    public function gcscproplan()
    {

        $data = DB::select('SELECT * FROM gcscppmp WHERE checkbox = 0');

        return view('admin/ppmpgcsc', ['proplandata' => $data]);
    }
    public function addgcscitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new GCSCModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for GCSC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpgcsc')->with('message', 'success');
    }
    public function gcscedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM gcscppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/gcscedit', ['proplandata' => $data]);
    }
    public function editgcscitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = GCSCModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for GCSC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpgcsc')->with('message', 'update');
    }
    public function gcscdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = GCSCModel::find($item_id);
        $data->delete();

        return redirect('ppmpgcsc')->with('message', 'delete item');
    }

    public function ovpproplan()
    {

        $data = DB::select('SELECT * FROM ovpppmp WHERE checkbox = 0');

        return view('admin/ppmpovp', ['proplandata' => $data]);
    }
    public function addovpitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new OVPModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for OVP Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpovp')->with('message', 'success');
    }
    public function ovpedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM ovpppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/ovpedit', ['proplandata' => $data]);
    }
    public function editovpitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = OVPModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for OVP Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpovp')->with('message', 'update');
    }
    public function ovpdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = OVPModel::find($item_id);
        $data->delete();

        return redirect('ppmpovp')->with('message', 'delete item');
    }

    public function sgoproplan()
    {

        $data = DB::select('SELECT * FROM sgoppmp WHERE checkbox = 0');

        return view('admin/ppmpsgo', ['proplandata' => $data]);
    }
    public function addsgoitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new SGOModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for SGO Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpsgo')->with('message', 'success');
    }
    public function sgoedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM sgoppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/sgoedit', ['proplandata' => $data]);
    }
    public function editsgoitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = SGOModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for SGO Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpsgo')->with('message', 'update');
    }
    public function sgodelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = SGOModel::find($item_id);
        $data->delete();

        return redirect('ppmpsgo')->with('message', 'delete item');
    }

    public function sracproplan()
    {

        $data = DB::select('SELECT * FROM sracppmp WHERE checkbox = 0');

        return view('admin/ppmpsrac', ['proplandata' => $data]);
    }
    public function addsracitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new SRACModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for SRAC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpsrac')->with('message', 'success');
    }
    public function sracedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM sracppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/sracedit', ['proplandata' => $data]);
    }
    public function editsracitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = SRACModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for SRAC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpsrac')->with('message', 'update');
    }
    public function sracdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = SRACModel::find($item_id);
        $data->delete();

        return redirect('ppmpsrac')->with('message', 'delete item');
    }

    public function hrdcproplan()
    {

        $data = DB::select('SELECT * FROM hrdcppmp WHERE checkbox = 0');

        return view('admin/ppmphrdc', ['proplandata' => $data]);
    }
    public function addhrdcitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new HRDCModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for HRDC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmphrdc')->with('message', 'success');
    }
    public function hrdcedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM hrdcppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/hrdcedit', ['proplandata' => $data]);
    }
    public function edithrdcitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = HRDCModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for HRDC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmphrdc')->with('message', 'update');
    }
    public function hrdcdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = HRDCModel::find($item_id);
        $data->delete();

        return redirect('ppmphrdc')->with('message', 'delete item');
    }

    public function supplyproplan()
    {

        $data = DB::select('SELECT * FROM supply WHERE checkbox = 0');

        return view('admin/ppmpsupply', ['proplandata' => $data]);
    }
    public function addsupplyitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new SupplyOfficeModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for Office of the Supply Office Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpsupply')->with('message', 'success');
    }
    public function supplyedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM supply WHERE ppmpID = ?', [$item_id]);

        return view('admin/supplyedit', ['proplandata' => $data]);
    }
    public function editsupplyitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = SupplyOfficeModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for Supply Office Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpsupply')->with('message', 'update');
    }
    public function supplydelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = SupplyOfficeModel::find($item_id);
        $data->delete();

        return redirect('ppmpsupply')->with('message', 'delete item');
    }

    public function financeproplan()
    {

        $data = DB::select('SELECT * FROM finance WHERE checkbox = 0');

        return view('admin/ppmpfinance', ['proplandata' => $data]);
    }
    public function addfinanceitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new FinanceModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for Office of the Finance Office Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpfinance')->with('message', 'success');
    }
    public function financeedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM finance WHERE ppmpID = ?', [$item_id]);

        return view('admin/financeedit', ['proplandata' => $data]);
    }
    public function editfinanceitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = FinanceModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for Finance Office Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpfinance')->with('message', 'update');
    }
    public function financedelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = FinanceModel::find($item_id);
        $data->delete();

        return redirect('ppmpfinance')->with('message', 'delete item');
    }

    public function presidentproplan()
    {

        $data = DB::select('SELECT * FROM president WHERE checkbox = 0');

        return view('admin/ppmppresident', ['proplandata' => $data]);
    }
    public function addpresidentitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new OfficePresModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for Office of the President Procurement Plan";

        $insertlogs->save();
        return redirect('ppmppresident')->with('message', 'success');
    }
    public function presidentedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM president WHERE ppmpID = ?', [$item_id]);

        return view('admin/presidentedit', ['proplandata' => $data]);
    }
    public function editpresidentitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = OfficePresModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for Office of the President Procurement Plan";

        $insertlogs->save();
        return redirect('ppmppresident')->with('message', 'update');
    }
    public function presidentdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = OfficePresModel::find($item_id);
        $data->delete();

        return redirect('ppmppresident')->with('message', 'delete item');
    }

    public function bacproplan()
    {

        $data = DB::select('SELECT * FROM bac WHERE checkbox = 0');

        return view('admin/ppmpbac', ['proplandata' => $data]);
    }
    public function addbacitem(Request $request)
    {

        $item_name = $request->input('item_name');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');
        $user_name = $request->input('user_name');

        foreach ($item_name as $index => $data) {

            $first_two = substr($item_name[$index], 0, 2);

            $insert = new BACModel;

            $insert->ItemDet =  $data;
            $insert->ItemCode = (sprintf("%'.08d", mt_rand(1, 99999999))) . "-" . $first_two . "-" . str_repeat(chr(mt_rand(65, 90)), 1) . "01";
            $insert->UnitMeas = $unit[$index];
            $insert->Price = $price[$index];
            $insert->Jan = 0;
            $insert->Feb = 0;
            $insert->Mar = 0;
            $insert->Q1 = $q1[$index];
            $insert->Q1Amount = $insert->Price * $insert->Q1;
            $insert->Apr = 0;
            $insert->May = 0;
            $insert->June = 0;
            $insert->Q2 = $q2[$index];
            $insert->Q2Amount = $insert->Price * $insert->Q2;
            $insert->July = 0;
            $insert->Aug = 0;
            $insert->Sept = 0;
            $insert->Q3 = $q3[$index];
            $insert->Q3Amount = $insert->Price * $insert->Q3;
            $insert->Oct = 0;
            $insert->Nov = 0;
            $insert->Dec = 0;
            $insert->Q4 = $q4[$index];
            $insert->Q4Amount = $insert->Price * $insert->Q4;
            $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
            $insert->TotalAmount = $insert->TotalQ * $insert->Price;

            $insert->save();
        }
        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Added new item for BAC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpbac')->with('message', 'success');
    }

    public function bacedit(Request $request)
    {

        $item_id = $request->input('editproplan');

        $data = DB::select('SELECT * FROM bacppmp WHERE ppmpID = ?', [$item_id]);

        return view('admin/bacedit', ['proplandata' => $data]);
    }
    public function editbacitem(Request $request)
    {

        $item_id = $request->input('Id');
        $item_name = $request->input('newitemdetail');
        $unit = $request->input('newunitmeasure');
        $q1 = $request->input('newq1');
        $q2 = $request->input('newq2');
        $q3 = $request->input('newq3');
        $q4 = $request->input('newq4');
        $price = $request->input('newprice');
        $user_name = $request->input('user_name');

        $insert = BACModel::find($item_id);

        $insert->ItemDet =  $item_name;
        $insert->UnitMeas = $unit;
        $insert->Price = $price;
        $insert->Q1 = $q1;
        $insert->Q1Amount = $insert->Price * $insert->Q1;
        $insert->Q2 = $q2;
        $insert->Q2Amount = $insert->Price * $insert->Q2;
        $insert->Q3 = $q3;
        $insert->Q3Amount = $insert->Price * $insert->Q3;
        $insert->Q4 = $q4;
        $insert->Q4Amount = $insert->Price * $insert->Q4;
        $insert->TotalQ = $insert->Q1 + $insert->Q2 + $insert->Q3 + $insert->Q4;
        $insert->TotalAmount = $insert->TotalQ * $insert->Price;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited an item details for BAC Procurement Plan";

        $insertlogs->save();
        return redirect('ppmpbac')->with('message', 'update');
    }
    public function bacdelete(Request $request)
    {

        $item_id = $request->input('removeid');

        $data = BACModel::find($item_id);
        $data->delete();

        return redirect('ppmpbac')->with('message', 'delete item');
    }


    public function approvedppmpcsa()
    {

        $data = DB::select('SELECT * FROM csappmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpcsa', ['proplandata' => $data]);
    }
    public function approvedppmpcas()
    {

        $data = DB::select('SELECT * FROM casppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpcas', ['proplandata' => $data]);
    }
    public function approvedppmpcbet()
    {

        $data = DB::select('SELECT * FROM cbetppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpcbet', ['proplandata' => $data]);
    }
    public function approvedppmpceat()
    {

        $data = DB::select('SELECT * FROM ceatppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpceat', ['proplandata' => $data]);
    }
    public function approvedppmpced()
    {

        $data = DB::select('SELECT * FROM cedppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpced', ['proplandata' => $data]);
    }
    public function approvedppmpipe()
    {

        $data = DB::select('SELECT * FROM ipeppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpipe', ['proplandata' => $data]);
    }
    public function approvedppmpmic()
    {

        $data = DB::select('SELECT * FROM micppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpmic', ['proplandata' => $data]);
    }
    public function approvedppmpdrrmo()
    {

        $data = DB::select('SELECT * FROM drrmoppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpdrrmo', ['proplandata' => $data]);
    }
    public function approvedppmpgcsc()
    {

        $data = DB::select('SELECT * FROM gcscppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpgcsc', ['proplandata' => $data]);
    }
    public function approvedppmpovp()
    {

        $data = DB::select('SELECT * FROM ovpppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpovp', ['proplandata' => $data]);
    }
    public function approvedppmpsgo()
    {

        $data = DB::select('SELECT * FROM sgoppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpsgo', ['proplandata' => $data]);
    }
    public function approvedppmpsrac()
    {

        $data = DB::select('SELECT * FROM sracppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmpsrac', ['proplandata' => $data]);
    }
    public function approvedppmphrdc()
    {

        $data = DB::select('SELECT * FROM hrdcppmp  WHERE checkbox = 1 ');

        return view('admin/approvedppmphrdc', ['proplandata' => $data]);
    }
    public function approvedppmpsupply()
    {

        $data = DB::select('SELECT * FROM supply  WHERE checkbox = 1 ');

        return view('admin/approvedppmpsupply', ['proplandata' => $data]);
    }
    public function approvedppmpfinance()
    {

        $data = DB::select('SELECT * FROM finance  WHERE checkbox = 1 ');

        return view('admin/approvedppmpfinance', ['proplandata' => $data]);
    }
    public function approvedppmppresident()
    {

        $data = DB::select('SELECT * FROM president  WHERE checkbox = 1 ');

        return view('admin/approvedppmppresident', ['proplandata' => $data]);
    }
    public function approvedppmpbac()
    {

        $data = DB::select('SELECT * FROM bac  WHERE checkbox = 1 ');

        return view('admin/approvedppmpbac', ['proplandata' => $data]);
    }

    public function audittrail()
    {

        $data = DB::select('SELECT * FROM logs');

        foreach ($data as  $userfind) {
            $username = $userfind->user;
            $user_data[] = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
        }

        return view('admin/audittrail', compact('data', 'user_data'));
    }

    public function adminreqlist()
    {

        $data = DB::select('SELECT * FROM request WHERE request_status != 4 AND request_status != 5 AND deleted_at IS NULL');

        if ($data == NULL) {
            $requestor_data = [];
        } else {
            foreach ($data as  $finduser) {
                $username = $finduser->requested_by;
                $requestor_data[] = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        return view('admin/reqlist', compact('data', 'requestor_data'));
    }

    public function adminreqlist2()
    {

        $data = DB::select('SELECT * FROM request WHERE deleted_at IS NULL AND request_status = 4 OR request_status = 5 ');

        if ($data == NULL) {
            $requestor_data = [];
        } else {
            foreach ($data as  $finduser) {
                $username = $finduser->requested_by;
                $requestor_data[] = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        return view('admin/reqlist2', compact('data', 'requestor_data'));
    }

    public function requesthistory(Request $request)
    {

        $req_id = $request->input('history');

        $req_data = DB::select('SELECT * FROM request WHERE request_id = ?', [$req_id]);

        foreach ($req_data as  $finduser) {
            $username = $finduser->requested_by;
            $requestor_data = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
        }

        foreach ($req_data as  $userfind) {
            $username = $userfind->updated_by_id;
            if ($username == NULL) {
                $user_data = [];
            } else {
                $user_data = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        foreach ($req_data as  $req_data) {
            $department = $req_data->department;
        }

        if ($department == 'CSA') {
            $order_data = DB::select('SELECT * FROM csa_order_list WHERE csa_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM csa_order_list WHERE csa_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'CEAT') {
            $order_data = DB::select('SELECT * FROM ceat_order_list WHERE ceat_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM ceat_order_list WHERE ceat_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'CAS') {
            $order_data = DB::select('SELECT * FROM cas_order_list WHERE cas_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM cas_order_list WHERE cas_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'CBET') {
            $order_data = DB::select('SELECT * FROM cbet_order_list WHERE cbet_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM cbet_order_list WHERE cbet_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'CED') {
            $order_data = DB::select('SELECT * FROM ced_order_list WHERE ced_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM ced_order_list WHERE ced_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'IPE') {
            $order_data = DB::select('SELECT * FROM ipe_order_list WHERE ipe_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM ipe_order_list WHERE ipe_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'MIC') {
            $order_data = DB::select('SELECT * FROM mic_order_list WHERE mic_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM mic_order_list WHERE mic_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'DRRMO') {
            $order_data = DB::select('SELECT * FROM drrmo_order_list WHERE drrmo_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM drrmo_order_list WHERE drrmo_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'GCSC') {
            $order_data = DB::select('SELECT * FROM gcsc_order_list WHERE gcsc_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM gcsc_order_list WHERE gcsc_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'OVP') {
            $order_data = DB::select('SELECT * FROM ovp_order_list WHERE ovp_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM ovp_order_list WHERE ovp_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'SGO') {
            $order_data = DB::select('SELECT * FROM sgo_order_list WHERE sgo_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM sgo_order_list WHERE sgo_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'SRAC') {
            $order_data = DB::select('SELECT * FROM srac_order_list WHERE srac_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM srac_order_list WHERE srac_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'HRDC') {
            $order_data = DB::select('SELECT * FROM hrdc_order_list WHERE hrdc_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM hrdc_order_list WHERE hrdc_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'Supply') {
            $order_data = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'Finance') {
            $order_data = DB::select('SELECT * FROM finance_order_list WHERE finance_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM finance_order_list WHERE finance_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'President') {
            $order_data = DB::select('SELECT * FROM president_order_list WHERE president_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM president_order_list WHERE president_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'BAC') {
            $order_data = DB::select('SELECT * FROM bac_order_list WHERE bac_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM bac_order_list WHERE bac_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        }

        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            if ($department == 'CSA') {
                $item_data[] = DB::select('SELECT ItemDet FROM csappmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CEAT') {
                $item_data[] = DB::select('SELECT ItemDet FROM ceatppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CAS') {
                $item_data[] = DB::select('SELECT ItemDet FROM casppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CBET') {
                $item_data[] = DB::select('SELECT ItemDet FROM cbetppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CED') {
                $item_data[] = DB::select('SELECT ItemDet FROM cedppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'IPE') {
                $item_data[] = DB::select('SELECT ItemDet FROM ipeppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'Supply Office') {
                $item_data[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'Finance') {
                $item_data[] = DB::select('SELECT ItemDet FROM finance WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'President') {
                $item_data[] = DB::select('SELECT ItemDet FROM president WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'BAC') {
                $item_data[] = DB::select('SELECT ItemDet FROM bac WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'MIC') {
                $item_data[] = DB::select('SELECT ItemDet FROM micppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'DRRMO') {
                $item_data[] = DB::select('SELECT ItemDet FROM drrmoppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'GCSC') {
                $item_data[] = DB::select('SELECT ItemDet FROM gcscppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'OVP') {
                $item_data[] = DB::select('SELECT ItemDet FROM ovpppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'SGO') {
                $item_data[] = DB::select('SELECT ItemDet FROM sgoppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'SRAC') {
                $item_data[] = DB::select('SELECT ItemDet FROM sracppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'HRDC') {
                $item_data[] = DB::select('SELECT ItemDet FROM hrdcppmp WHERE ppmpID = ?', [$itemname]);
            }
        }

        if ($approve_order == NULL) {
            $approve_item = NULL;
        } else {
            foreach ($approve_order as  $itemcheck) {
                $item = $itemcheck->item_id;
                if ($department == 'CSA') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM csappmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'CEAT') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM ceatppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'CAS') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM casppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'CBET') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM cbetppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'CED') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM cedppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'IPE') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM ipeppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'Supply Office') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'Finance') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM finance WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'President') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM president WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'BAC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM bac WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'MIC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM micppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'DRRMO') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM drrmoppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'GCSC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM gcscppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'OVP') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM ovpppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'SGO') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM sgoppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'SRAC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM sracppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'HRDC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM hrdcppmp WHERE ppmpID = ?', [$itemname]);
                }
            }
        }

        return view('admin/reqhistory', ['requesthistory' => $req_data], compact('order_data', 'item_data', 'approve_order', 'approve_item', 'user_data', 'requestor_data'));
    }

    public function requesthistory2(Request $request)
    {

        $req_id = $request->input('history');

        $req_data = DB::select('SELECT * FROM request WHERE request_id = ?', [$req_id]);

        foreach ($req_data as  $finduser) {
            $username = $finduser->requested_by;
            $requestor_data = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
        }

        foreach ($req_data as  $userfind) {
            $username = $userfind->updated_by_id;
            if ($username == NULL) {
                $user_data = [];
            } else {
                $user_data = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        foreach ($req_data as  $req_data) {
            $department = $req_data->department;
        }

        if ($department == 'CSA') {
            $order_data = DB::select('SELECT * FROM csa_order_list WHERE csa_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM csa_order_list WHERE csa_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'CEAT') {
            $order_data = DB::select('SELECT * FROM ceat_order_list WHERE ceat_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM ceat_order_list WHERE ceat_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'CAS') {
            $order_data = DB::select('SELECT * FROM cas_order_list WHERE cas_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM cas_order_list WHERE cas_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'CBET') {
            $order_data = DB::select('SELECT * FROM cbet_order_list WHERE cbet_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM cbet_order_list WHERE cbet_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'CED') {
            $order_data = DB::select('SELECT * FROM ced_order_list WHERE ced_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM ced_order_list WHERE ced_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'IPE') {
            $order_data = DB::select('SELECT * FROM ipe_order_list WHERE ipe_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM ipe_order_list WHERE ipe_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'MIC') {
            $order_data = DB::select('SELECT * FROM mic_order_list WHERE mic_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM mic_order_list WHERE mic_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'DRRMO') {
            $order_data = DB::select('SELECT * FROM drrmo_order_list WHERE drrmo_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM drrmo_order_list WHERE drrmo_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'GCSC') {
            $order_data = DB::select('SELECT * FROM gcsc_order_list WHERE gcsc_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM gcsc_order_list WHERE gcsc_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'OVP') {
            $order_data = DB::select('SELECT * FROM ovp_order_list WHERE ovp_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM ovp_order_list WHERE ovp_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'SGO') {
            $order_data = DB::select('SELECT * FROM sgo_order_list WHERE sgo_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM sgo_order_list WHERE sgo_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'SRAC') {
            $order_data = DB::select('SELECT * FROM srac_order_list WHERE srac_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM srac_order_list WHERE srac_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'HRDC') {
            $order_data = DB::select('SELECT * FROM hrdc_order_list WHERE hrdc_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM hrdc_order_list WHERE hrdc_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'Supply') {
            $order_data = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'Finance') {
            $order_data = DB::select('SELECT * FROM finance_order_list WHERE finance_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM finance_order_list WHERE finance_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'President') {
            $order_data = DB::select('SELECT * FROM president_order_list WHERE president_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM president_order_list WHERE president_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        } else if ($department == 'BAC') {
            $order_data = DB::select('SELECT * FROM bac_order_list WHERE bac_preriv_id = ?', [$req_id]);
            $approve_order = DB::select('SELECT * FROM bac_order_list WHERE bac_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        }

        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            if ($department == 'CSA') {
                $item_data[] = DB::select('SELECT ItemDet FROM csappmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CEAT') {
                $item_data[] = DB::select('SELECT ItemDet FROM ceatppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CAS') {
                $item_data[] = DB::select('SELECT ItemDet FROM casppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CBET') {
                $item_data[] = DB::select('SELECT ItemDet FROM cbetppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CED') {
                $item_data[] = DB::select('SELECT ItemDet FROM cedppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'IPE') {
                $item_data[] = DB::select('SELECT ItemDet FROM ipeppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'Supply Office') {
                $item_data[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'Finance') {
                $item_data[] = DB::select('SELECT ItemDet FROM finance WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'President') {
                $item_data[] = DB::select('SELECT ItemDet FROM president WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'BAC') {
                $item_data[] = DB::select('SELECT ItemDet FROM bac WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'MIC') {
                $item_data[] = DB::select('SELECT ItemDet FROM micppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'DRRMO') {
                $item_data[] = DB::select('SELECT ItemDet FROM drrmoppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'GCSC') {
                $item_data[] = DB::select('SELECT ItemDet FROM gcscppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'OVP') {
                $item_data[] = DB::select('SELECT ItemDet FROM ovpppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'SGO') {
                $item_data[] = DB::select('SELECT ItemDet FROM sgoppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'SRAC') {
                $item_data[] = DB::select('SELECT ItemDet FROM sracppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'HRDC') {
                $item_data[] = DB::select('SELECT ItemDet FROM hrdcppmp WHERE ppmpID = ?', [$itemname]);
            }
        }

        if ($approve_order == NULL) {
            $approve_item = NULL;
        } else {
            foreach ($approve_order as  $itemcheck) {
                $item = $itemcheck->item_id;
                if ($department == 'CSA') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM csappmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'CEAT') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM ceatppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'CAS') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM casppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'CBET') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM cbetppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'CED') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM cedppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'IPE') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM ipeppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'Supply Office') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'Finance') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM finance WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'President') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM president WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'BAC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM bac WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'MIC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM micppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'DRRMO') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM drrmoppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'GCSC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM gcscppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'OVP') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM ovpppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'SGO') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM sgoppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'SRAC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM sracppmp WHERE ppmpID = ?', [$itemname]);
                } else if ($department == 'HRDC') {
                    $approve_item[] = DB::select('SELECT ItemDet FROM hrdcppmp WHERE ppmpID = ?', [$itemname]);
                }
            }
        }

        return view('admin/reqhistory2', ['requesthistory' => $req_data], compact('order_data', 'item_data', 'approve_order', 'approve_item', 'user_data', 'requestor_data'));
    }

    public function summary()
    {

        $data = DB::select('SELECT * FROM request WHERE deleted_at IS NULL');

        if ($data == NULL) {
            $requestor_data = [];
        } else {
            foreach ($data as  $finduser) {
                $username = $finduser->requested_by;
                $requestor_data[] = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        return view('admin/summaryreport', compact('data', 'requestor_data'));
    }
}
