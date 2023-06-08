<?php

namespace App\Http\Controllers;

use App\Models\RequestModel;
use App\Models\CSAModel;
use App\Models\CASModel;
use App\Models\CBETModel;
use App\Models\CEATModel;
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
use App\Models\CSA_Order_List_Model;
use App\Models\CAS_Order_List_Model;
use App\Models\CBET_Order_List_Model;
use App\Models\CEAT_Order_List_Model;
use App\Models\CED_Order_List_Model;
use App\Models\IPE_Order_List_Model;
use App\Models\Supply_Order_List_Model;
use App\Models\Finance_Order_List_Model;
use App\Models\President_Order_List_Model;
use App\Models\BAC_Order_List_Model;
use App\Models\MIC_Order_List_Model;
use App\Models\DRRMO_Order_List_Model;
use App\Models\GCSC_Order_List_Model;
use App\Models\OVP_Order_List_Model;
use App\Models\SGO_Order_List_Model;
use App\Models\SRAC_Order_List_Model;
use App\Models\HRDC_Order_List_Model;

use App\Models\AuditTrailModel;
use App\Models\AdminModel;

use App\Notifications\ApprovedNotification;
use App\Notifications\DeniedNotification;
use App\Notifications\SODeliverNotification;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '..\mail\Exception.php';
require '..\mail\PHPMailer.php';
require '..\mail\SMTP.php';


class SupplyOfficeController extends Controller
{
    public function sodashboard()
    {
        $usersession = Session::get('user');
        if (!session()->has('user')) {

            return redirect('/')->with('alert', 'Login to access this page');
        }
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        $username = $user->Firstname;

        $department = 'CSA';
        $item = DB::select('SELECT * FROM csappmp WHERE checkbox = 1');
        $itemJson = json_encode($item);

        return view('supply office/supplyoffice', ['notifications' => $notifications], compact('username', 'itemJson', 'department'));
    }
    public function supplyDashboard(Request $request)
    {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        $username = $user->Firstname;

        $department = $request->input('department');

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

        return view('supply office/supplyoffice', ['notifications' => $notifications], compact('username', 'itemJson', 'department'));
    }
    public function csaproplan()
    {

        $data = DB::select('SELECT * FROM csappmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpcsa', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function casproplan()
    {

        $data = DB::select('SELECT * FROM casppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpcas', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function cbetproplan()
    {

        $data = DB::select('SELECT * FROM cbetppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpcbet', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ceatproplan()
    {

        $data = DB::select('SELECT * FROM ceatppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpceat', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function cedproplan()
    {

        $data = DB::select('SELECT * FROM cedppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpced', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ipeproplan()
    {

        $data = DB::select('SELECT * FROM ipeppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpipe', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function micproplan()
    {

        $data = DB::select('SELECT * FROM micppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpmic', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function drrmoproplan()
    {

        $data = DB::select('SELECT * FROM drrmoppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpdrrmo', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function gcscproplan()
    {

        $data = DB::select('SELECT * FROM gcscppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpgcsc', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ovpproplan()
    {

        $data = DB::select('SELECT * FROM ovpppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpovp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function sgoproplan()
    {

        $data = DB::select('SELECT * FROM sgoppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpsgo', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function sracproplan()
    {

        $data = DB::select('SELECT * FROM sracppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpsrac', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function hrdcproplan()
    {

        $data = DB::select('SELECT * FROM hrdcppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmphrdc', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function supplyproplan()
    {

        $data = DB::select('SELECT * FROM supply WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpsupply', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function financeproplan()
    {

        $data = DB::select('SELECT * FROM finance WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpfinance', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function presidentproplan()
    {

        $data = DB::select('SELECT * FROM president WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmppresident', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function bacproplan()
    {

        $data = DB::select('SELECT * FROM bac WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/ppmpbac', ['proplandata' => $data], ['notifications' => $notifications]);
    }

    public function checkcsaproplan()
    {

        $data = DB::select('SELECT * FROM csappmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplancsa', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkcasproplan()
    {

        $data = DB::select('SELECT * FROM casppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplancas', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkcbetproplan()
    {

        $data = DB::select('SELECT * FROM cbetppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplancbet', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkceatproplan()
    {

        $data = DB::select('SELECT * FROM ceatppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanceat', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkcedproplan()
    {

        $data = DB::select('SELECT * FROM cedppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanced', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkipeproplan()
    {

        $data = DB::select('SELECT * FROM ipeppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanipe', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkmicproplan()
    {

        $data = DB::select('SELECT * FROM micppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanmic', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkdrrmoproplan()
    {

        $data = DB::select('SELECT * FROM drrmoppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplandrrmo', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkgcscproplan()
    {

        $data = DB::select('SELECT * FROM gcscppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplangcsc', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkovpproplan()
    {

        $data = DB::select('SELECT * FROM ovpppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanovp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checksgoproplan()
    {

        $data = DB::select('SELECT * FROM sgoppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplansgo', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checksracproplan()
    {

        $data = DB::select('SELECT * FROM sracppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplansrac', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkhrdcproplan()
    {

        $data = DB::select('SELECT * FROM hrdcppmp WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanhrdc', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checksupplyproplan()
    {

        $data = DB::select('SELECT * FROM supply WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplasupply', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkfinanceproplan()
    {

        $data = DB::select('SELECT * FROM finance WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanfinance', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkpresidentproplan()
    {

        $data = DB::select('SELECT * FROM president WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanpresident', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function checkbacproplan()
    {

        $data = DB::select('SELECT * FROM bac WHERE checkbox = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/proplanbac', ['proplandata' => $data], ['notifications' => $notifications]);
    }

    public function csacheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = CSAModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpcsa');
    }
    public function cascheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = CASModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpcas');
    }
    public function cbetcheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = CBETModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpcbet');
    }
    public function ceatcheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = CEATModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpceat');
    }
    public function cedcheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = CEDModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpced');
    }
    public function ipecheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = IPEModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpipe');
    }
    public function miccheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = MICModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpmic');
    }
    public function drrmocheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = DRRMOModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpdrrmo');
    }
    public function gcsccheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = GCSCModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpgcsc');
    }
    public function ovpcheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = OVPModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpovp');
    }
    public function sgocheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = SGOModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpsgo');
    }
    public function sraccheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = SRACModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpsrac');
    }
    public function hrdccheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = HRDCModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmphrdc');
    }
    public function supplycheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = SupplyOfficeModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpsupply');
    }
    public function financecheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = FinanceModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpfinance');
    }
    public function presidentcheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = OfficePresModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmppresident');
    }
    public function baccheckupdate(Request $request)
    {

        $itemid = $request->input('Id');
        $check = $request->input('checkbox');
        $itemname = $request->input('item_name');
        $itemcode = $request->input('item_code');
        $unit = $request->input('unit');
        $q1 = $request->input('q1');
        $q2 = $request->input('q2');
        $q3 = $request->input('q3');
        $q4 = $request->input('q4');
        $price = $request->input('price');

        foreach ($itemid as $index => $data) {

            $insert = BACModel::find($data);

            $insert->checkbox = $check[$index];
            $insert->ItemDet = $itemname[$index];
            $insert->ItemCode = $itemcode[$index];
            $insert->UnitMeas = $unit[$index];
            $insert->Q1 = $q1[$index];
            $insert->Q2 = $q2[$index];
            $insert->Q3 = $q3[$index];
            $insert->Q4 = $q4[$index];
            $insert->Price = $price[$index];

            $insert->save();
        }

        return redirect('soppmpbac');
    }

    public function approvedcsappmp()
    {

        $data = DB::select('SELECT * FROM csappmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedcsappmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedcasppmp()
    {

        $data = DB::select('SELECT * FROM casppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedcasppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedcbetppmp()
    {

        $data = DB::select('SELECT * FROM cbetppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedcbetppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedceatppmp()
    {

        $data = DB::select('SELECT * FROM ceatppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedceatppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedcedppmp()
    {

        $data = DB::select('SELECT * FROM cedppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedcedppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedipeppmp()
    {

        $data = DB::select('SELECT * FROM ipeppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedipeppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedmicppmp()
    {

        $data = DB::select('SELECT * FROM micppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedmicppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approveddrrmoppmp()
    {

        $data = DB::select('SELECT * FROM drrmoppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approveddrrmoppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedgcscppmp()
    {

        $data = DB::select('SELECT * FROM gcscppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedgcscppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedovpppmp()
    {

        $data = DB::select('SELECT * FROM ovpppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedovpppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedsgoppmp()
    {

        $data = DB::select('SELECT * FROM sgoppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedsgoppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedsracppmp()
    {

        $data = DB::select('SELECT * FROM sracppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedsracppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedhrdcppmp()
    {

        $data = DB::select('SELECT * FROM hrdcppmp WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedhrdcppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedsupplyppmp()
    {

        $data = DB::select('SELECT * FROM supply WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedsupplyppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedfinanceppmp()
    {

        $data = DB::select('SELECT * FROM finance WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedfinanceppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedpresidentppmp()
    {

        $data = DB::select('SELECT * FROM president WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedpresidentppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function approvedbacppmp()
    {

        $data = DB::select('SELECT * FROM bac WHERE checkbox = 1 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply office/approvedbacppmp', ['proplandata' => $data], ['notifications' => $notifications]);
    }

    public function sopreriv()
    {

        $data = DB::select('SELECT * FROM request WHERE deleted_at IS NULL AND request_status = 0 ');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        if ($data == NULL) {
            $requestor_data = [];
        } else {
            foreach ($data as  $finduser) {
                $username = $finduser->requested_by;
                $requestor_data[] = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        return view('supply office/preriv', compact('data', 'requestor_data'), ['notifications' => $notifications]);
    }

    public function prerivview(Request $request)
    {

        $req_id = $request->input('viewrequest');

        $req_data = DB::select('SELECT * FROM request WHERE request_id = ?', [$req_id]);

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        foreach ($req_data as  $finduser) {
            $username = $finduser->requested_by;
            $requestor_data = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
        }

        foreach ($req_data as  $req_data) {
            $department = $req_data->department;
        }

        if ($department == 'CSA') {
            $order_data = DB::select('SELECT * FROM csa_order_list WHERE csa_preriv_id = ?', [$req_id]);
        } else if ($department == 'CEAT') {
            $order_data = DB::select('SELECT * FROM ceat_order_list WHERE ceat_preriv_id = ?', [$req_id]);
        } else if ($department == 'CAS') {
            $order_data = DB::select('SELECT * FROM cas_order_list WHERE cas_preriv_id = ?', [$req_id]);
        } else if ($department == 'CBET') {
            $order_data = DB::select('SELECT * FROM cbet_order_list WHERE cbet_preriv_id = ?', [$req_id]);
        } else if ($department == 'CED') {
            $order_data = DB::select('SELECT * FROM ced_order_list WHERE ced_preriv_id = ?', [$req_id]);
        } else if ($department == 'IPE') {
            $order_data = DB::select('SELECT * FROM ipe_order_list WHERE ipe_preriv_id = ?', [$req_id]);
        } else if ($department == 'Supply Office') {
            $order_data = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ?', [$req_id]);
        } else if ($department == 'Finance') {
            $order_data = DB::select('SELECT * FROM finance_order_list WHERE finance_preriv_id = ?', [$req_id]);
        } else if ($department == 'President') {
            $order_data = DB::select('SELECT * FROM president_order_list WHERE president_preriv_id = ?', [$req_id]);
        } else if ($department == 'BAC') {
            $order_data = DB::select('SELECT * FROM bac_order_list WHERE bac_preriv_id = ?', [$req_id]);
        } else if ($department == 'MIC') {
            $order_data = DB::select('SELECT * FROM mic_order_list WHERE mic_preriv_id = ?', [$req_id]);
        } else if ($department == 'DRRMO') {
            $order_data = DB::select('SELECT * FROM drrmo_order_list WHERE drrmo_preriv_id = ?', [$req_id]);
        } else if ($department == 'GCSC') {
            $order_data = DB::select('SELECT * FROM gcsc_order_list WHERE gcsc_preriv_id = ?', [$req_id]);
        } else if ($department == 'OVP') {
            $order_data = DB::select('SELECT * FROM ovp_order_list WHERE ovp_preriv_id = ?', [$req_id]);
        } else if ($department == 'SGO') {
            $order_data = DB::select('SELECT * FROM sgo_order_list WHERE sgo_preriv_id = ?', [$req_id]);
        } else if ($department == 'SRAC') {
            $order_data = DB::select('SELECT * FROM srac_order_list WHERE srac_preriv_id = ?', [$req_id]);
        } else if ($department == 'HRDC') {
            $order_data = DB::select('SELECT * FROM hrdc_order_list WHERE hrdc_preriv_id = ?', [$req_id]);
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
        return view('supply office/prerivview', ['requestview' => $req_data], compact('order_data', 'item_data', 'requestor_data', 'notifications'));
    }

    public function prerivedit(Request $request)
    {

        $req_id = $request->input('editrequest');

        $req_data = DB::select('SELECT * FROM request WHERE request_id = ?', [$req_id]);

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        foreach ($req_data as  $req_data) {
            $department = $req_data->department;
        }

        if ($department == 'CSA') {
            $order_data = DB::select('SELECT * FROM csa_order_list WHERE csa_preriv_id = ?', [$req_id]);
        } else if ($department == 'CEAT') {
            $order_data = DB::select('SELECT * FROM ceat_order_list WHERE ceat_preriv_id = ?', [$req_id]);
        } else if ($department == 'CAS') {
            $order_data = DB::select('SELECT * FROM cas_order_list WHERE cas_preriv_id = ?', [$req_id]);
        } else if ($department == 'CBET') {
            $order_data = DB::select('SELECT * FROM cbet_order_list WHERE cbet_preriv_id = ?', [$req_id]);
        } else if ($department == 'CED') {
            $order_data = DB::select('SELECT * FROM ced_order_list WHERE ced_preriv_id = ?', [$req_id]);
        } else if ($department == 'IPE') {
            $order_data = DB::select('SELECT * FROM ipe_order_list WHERE ipe_preriv_id = ?', [$req_id]);
        } else if ($department == 'Supply Office') {
            $order_data = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ?', [$req_id]);
        } else if ($department == 'Finance') {
            $order_data = DB::select('SELECT * FROM finance_order_list WHERE finance_preriv_id = ?', [$req_id]);
        } else if ($department == 'President') {
            $order_data = DB::select('SELECT * FROM president_order_list WHERE president_preriv_id = ?', [$req_id]);
        } else if ($department == 'BAC') {
            $order_data = DB::select('SELECT * FROM bac_order_list WHERE bac_preriv_id  = ?', [$req_id]);
        } else if ($department == 'MIC') {
            $order_data = DB::select('SELECT * FROM mic_order_list WHERE mic_preriv_id = ?', [$req_id]);
        } else if ($department == 'DRRMO') {
            $order_data = DB::select('SELECT * FROM drrmo_order_list WHERE drrmo_preriv_id = ?', [$req_id]);
        } else if ($department == 'GCSC') {
            $order_data = DB::select('SELECT * FROM gcsc_order_list WHERE gcsc_preriv_id = ?', [$req_id]);
        } else if ($department == 'OVP') {
            $order_data = DB::select('SELECT * FROM ovp_order_list WHERE ovp_preriv_id = ?', [$req_id]);
        } else if ($department == 'SGO') {
            $order_data = DB::select('SELECT * FROM sgo_order_list WHERE sgo_preriv_id = ?', [$req_id]);
        } else if ($department == 'SRAC') {
            $order_data = DB::select('SELECT * FROM srac_order_list WHERE srac_preriv_id = ?', [$req_id]);
        } else if ($department == 'HRDC') {
            $order_data = DB::select('SELECT * FROM hrdc_order_list WHERE hrdc_preriv_id = ?', [$req_id]);
        }

        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            if ($department == 'CSA') {
                $item_data[] = DB::select('SELECT * FROM csappmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CEAT') {
                $item_data[] = DB::select('SELECT * FROM ceatppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CAS') {
                $item_data[] = DB::select('SELECT * FROM casppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CBET') {
                $item_data[] = DB::select('SELECT * FROM cbetppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CED') {
                $item_data[] = DB::select('SELECT * FROM cedppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'IPE') {
                $item_data[] = DB::select('SELECT * FROM ipeppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'Supply Office') {
                $item_data[] = DB::select('SELECT * FROM supply WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'Finance') {
                $item_data[] = DB::select('SELECT * FROM finance WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'President') {
                $item_data[] = DB::select('SELECT * FROM president WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'BAC') {
                $item_data[] = DB::select('SELECT * FROM bac WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'MIC') {
                $item_data[] = DB::select('SELECT * FROM micppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'DRRMO') {
                $item_data[] = DB::select('SELECT * FROM drrmoppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'GCSC') {
                $item_data[] = DB::select('SELECT * FROM gcscppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'OVP') {
                $item_data[] = DB::select('SELECT * FROM ovpppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'SGO') {
                $item_data[] = DB::select('SELECT * FROM sgoppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'SRAC') {
                $item_data[] = DB::select('SELECT * FROM sracppmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'HRDC') {
                $item_data[] = DB::select('SELECT * FROM hrdcppmp WHERE ppmpID = ?', [$itemname]);
            }
        }

        return view('supply office/prerivedit', ['requestview' => $req_data], compact('order_data', 'item_data', 'notifications'));
    }

    public function editpreriv(Request $request)
    {

        $req_id = $request->input('Id');
        $req_dept = $request->input('department');
        $req_notes = $request->input('notes');
        $req_purpose = $request->input('purpose');
        $req_source = $request->input('source');
        $req_action = $request->input('action');
        $req_status = $request->input('status');
        $req_remarks = $request->input('remarks');
        $user_name = $request->input('user_name');
        $requested_by = $request->input('requested_by');

        if ($req_dept == 'CSA') {
            DB::delete('DELETE FROM csa_order_list where csa_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'CEAT') {
            DB::delete('DELETE FROM ceat_order_list where ceat_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'CAS') {
            DB::delete('DELETE FROM cas_order_list where cas_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'CBET') {
            DB::delete('DELETE FROM cbet_order_list where cbet_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'CED') {
            DB::delete('DELETE FROM ced_order_list where ced_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'IPE') {
            DB::delete('DELETE FROM ipe_order_list where ipe_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'Supply Office') {
            DB::delete('DELETE FROM supply_order_list where supply_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'Finance') {
            DB::delete('DELETE FROM finance_order_list where finance_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'President') {
            DB::delete('DELETE FROM president_order_list where president_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'BAC') {
            DB::delete('DELETE FROM bac_order_list where bac_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'MIC') {
            DB::delete('DELETE FROM mic_order_list where mic_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'DRRMO') {
            DB::delete('DELETE FROM drrmo_order_list where drrmo_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'GCSC') {
            DB::delete('DELETE FROM gcsc_order_list where gcsc_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'OVP') {
            DB::delete('DELETE FROM ovp_order_list where ovp_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'SGO') {
            DB::delete('DELETE FROM sgo_order_list where sgo_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'SRAC') {
            DB::delete('DELETE FROM srac_order_list where srac_preriv_id = ?', [$req_id]);
        } else if ($req_dept  == 'HRDC') {
            DB::delete('DELETE FROM hrdc_order_list where hrdc_preriv_id = ?', [$req_id]);
        }

        switch ($req_status) {
            case '1':
                $delivered_to = "Finance Office";
                break;
            case '5':
                $delivered_to = " ";
                break;
            default:
                $req_status = 0;
                $delivered_to = "Supply Office";
                break;
        }

        $insert = RequestModel::find($req_id);

        $insert->notes =  $req_notes;
        $insert->purpose = $req_purpose;
        $insert->budget_source = $req_source;
        $insert->updated_by_id = $user_name;
        $insert->action_taken = $req_action;
        $insert->delivered_to = $delivered_to;
        $insert->request_status = $req_status;
        $insert->remarks = $req_remarks;

        $insert->save();

        if ($insert) {

            $quantity = $request->input('qty');
            $prev_quantity = $request->input('prev_qty');
            $checkbox = $request->input('checkbox');
            $unit = $request->input('unit');
            $item_id = $request->input('item_id');
            $unit_price = $request->input('unit_price');

            foreach ($quantity as $index => $data) {

                if ($req_dept == 'CSA') {
                    $insert = new CSA_Order_List_Model;
                    $insert->csa_preriv_id = $req_id;
                } else if ($req_dept  == 'CEAT') {
                    $insert = new CEAT_Order_List_Model;
                    $insert->ceat_preriv_id = $req_id;
                } else if ($req_dept  == 'CAS') {
                    $insert = new CAS_Order_List_Model;
                    $insert->cas_preriv_id = $req_id;
                } else if ($req_dept  == 'CBET') {
                    $insert = new CBET_Order_List_Model;
                    $insert->cbet_preriv_id = $req_id;
                } else if ($req_dept  == 'CED') {
                    $insert = new CED_Order_List_Model;
                    $insert->ced_preriv_id = $req_id;
                } else if ($req_dept  == 'IPE') {
                    $insert = new IPE_Order_List_Model;
                    $insert->ipe_preriv_id = $req_id;
                } else if ($req_dept  == 'Supply Office') {
                    $insert = new Supply_Order_List_Model;
                    $insert->supply_preriv_id = $req_id;
                } else if ($req_dept  == 'Finance') {
                    $insert = new Finance_Order_List_Model;
                    $insert->finance_preriv_id = $req_id;
                } else if ($req_dept  == 'President') {
                    $insert = new President_Order_List_Model;
                    $insert->president_preriv_id = $req_id;
                } else if ($req_dept  == 'BAC') {
                    $insert = new BAC_Order_List_Model;
                    $insert->BAC_preriv_id = $req_id;
                } else if ($req_dept  == 'MIC') {
                    $insert = new MIC_Order_List_Model;
                    $insert->mic_preriv_id = $req_id;
                } else if ($req_dept  == 'DRRMO') {
                    $insert = new DRRMO_Order_List_Model;
                    $insert->drrmo_preriv_id = $req_id;
                } else if ($req_dept  == 'GCSC') {
                    $insert = new GCSC_Order_List_Model;
                    $insert->gcsc_preriv_id = $req_id;
                } else if ($req_dept  == 'OVP') {
                    $insert = new OVP_Order_List_Model;
                    $insert->ovp_preriv_id = $req_id;
                } else if ($req_dept  == 'SGO') {
                    $insert = new SGO_Order_List_Model;
                    $insert->sgo_preriv_id = $req_id;
                } else if ($req_dept  == 'SRAC') {
                    $insert = new SRAC_Order_List_Model;
                    $insert->srac_preriv_id = $req_id;
                } else if ($req_dept  == 'HRDC') {
                    $insert = new HRDC_Order_List_Model;
                    $insert->hrdc_preriv_id = $req_id;
                }

                $insert->updated_quantity = $data;
                $insert->quantity = $prev_quantity[$index];
                $insert->checkbox = $checkbox[$index];
                $insert->item_id = $item_id[$index];
                $insert->unit = $unit[$index];
                $insert->unit_price = $unit_price[$index];

                $insert->save();
            }

            if ($req_dept == 'CSA') {
                $count_data = CSA_Order_List_Model::where('csa_preriv_id', $req_id)->count();
                $total_data = CSA_Order_List_Model::where('csa_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = CSA_Order_List_Model::where('csa_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = CSA_Order_List_Model::where('csa_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'CEAT') {
                $count_data = CEAT_Order_List_Model::where('ceat_preriv_id', $req_id)->count();
                $total_data = CEAT_Order_List_Model::where('ceat_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = CEAT_Order_List_Model::where('ceat_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = CEAT_Order_List_Model::where('ceat_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'CAS') {
                $count_data = CAS_Order_List_Model::where('cas_preriv_id', $req_id)->count();
                $total_data = CAS_Order_List_Model::where('cas_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = CAS_Order_List_Model::where('cas_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = CAS_Order_List_Model::where('cas_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'CBET') {
                $count_data = CBET_Order_List_Model::where('cbet_preriv_id', $req_id)->count();
                $total_data = CBET_Order_List_Model::where('cbet_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = CBET_Order_List_Model::where('cbet_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = CBET_Order_List_Model::where('cbet_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'CED') {
                $count_data = CED_Order_List_Model::where('ced_preriv_id', $req_id)->count();
                $total_data = CED_Order_List_Model::where('ced_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = CED_Order_List_Model::where('ced_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = CED_Order_List_Model::where('ced_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'IPE') {
                $count_data = IPE_Order_List_Model::where('ipe_preriv_id', $req_id)->count();
                $total_data = IPE_Order_List_Model::where('ipe_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = IPE_Order_List_Model::where('ipe_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = IPE_Order_List_Model::where('ipe_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'Supply Office') {
                $count_data = Supply_Order_List_Model::where('supply_preriv_id', $req_id)->count();
                $total_data = Supply_Order_List_Model::where('supply_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = Supply_Order_List_Model::where('supply_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = Supply_Order_List_Model::where('supply_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'Finance') {
                $count_data = Finance_Order_List_Model::where('supply_preriv_id', $req_id)->count();
                $total_data = Finance_Order_List_Model::where('supply_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = Finance_Order_List_Model::where('supply_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = Finance_Order_List_Model::where('supply_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'President') {
                $count_data = President_Order_List_Model::where('president_preriv_id', $req_id)->count();
                $total_data = President_Order_List_Model::where('president_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = President_Order_List_Model::where('president_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = President_Order_List_Model::where('president_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'BAC') {
                $count_data = BAC_Order_List_Model::where('bac_preriv_id', $req_id)->count();
                $total_data = BAC_Order_List_Model::where('bac_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = BAC_Order_List_Model::where('bac_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = BAC_Order_List_Model::where('bac_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'MIC') {
                $count_data = MIC_Order_List_Model::where('mic_preriv_id', $req_id)->count();
                $total_data = MIC_Order_List_Model::where('mic_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = MIC_Order_List_Model::where('mic_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = MIC_Order_List_Model::where('mic_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'DRRMO') {
                $count_data = DRRMO_Order_List_Model::where('drrmo_preriv_id', $req_id)->count();
                $total_data = DRRMO_Order_List_Model::where('drrmo_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = DRRMO_Order_List_Model::where('drrmo_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = DRRMO_Order_List_Model::where('drrmo_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'GCSC') {
                $count_data = GCSC_Order_List_Model::where('gcsc_preriv_id', $req_id)->count();
                $total_data = GCSC_Order_List_Model::where('gcsc_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = GCSC_Order_List_Model::where('gcsc_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = GCSC_Order_List_Model::where('gcsc_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'OVP') {
                $count_data = OVP_Order_List_Model::where('ovp_preriv_id', $req_id)->count();
                $total_data = OVP_Order_List_Model::where('ovp_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = OVP_Order_List_Model::where('ovp_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = OVP_Order_List_Model::where('ovp_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'SGO') {
                $count_data = SGO_Order_List_Model::where('sgo_preriv_id', $req_id)->count();
                $total_data = SGO_Order_List_Model::where('sgo_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = SGO_Order_List_Model::where('sgo_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = SGO_Order_List_Model::where('sgo_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'SRAC') {
                $count_data = SRAC_Order_List_Model::where('srac_preriv_id', $req_id)->count();
                $total_data = SRAC_Order_List_Model::where('srac_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = SRAC_Order_List_Model::where('srac_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = SRAC_Order_List_Model::where('srac_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            } else if ($req_dept  == 'HRDC') {
                $count_data = HRDC_Order_List_Model::where('hrdc_preriv_id', $req_id)->count();
                $total_data = HRDC_Order_List_Model::where('hrdc_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));
                $approved_count = HRDC_Order_List_Model::where('hrdc_preriv_id', $req_id)->where('checkbox', "1")->count();
                $approved_total = HRDC_Order_List_Model::where('hrdc_preriv_id', $req_id)->where('checkbox', "1")->value(DB::raw("SUM(quantity * unit_price)"));
            }

            $update = RequestModel::find($req_id);

            $update->item_count =  $count_data;
            $update->total_price =  $total_data;
            $update->approved_item_count =  $approved_count;
            $update->approved_total_price =  $approved_total;

            $insertlogs = new AuditTrailModel;
            $insertlogs->user = $user_name;
            $insertlogs->action_made =  "Edited a Request ";
            $insertlogs->save();

            $update->save();

            if ($req_status == 1) {
                $user = AdminModel::find($requested_by);
                $userEmail = $user->Email;
                $user->notify(new ApprovedNotification());

                try {
                    // Initialize PHPMailer
                    $mail = new PHPMailer(true);

                    // Configure SMTP settings
                    $mail->isSMTP();
                    $mail->Host       = "smtp.gmail.com";
                    $mail->SMTPAuth   = true;
                    $mail->Username   = "rlvigo@rtu.edu.ph";
                    $mail->Password   = 'reymart11';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       =  465;

                    //Recipients
                    $mail->setFrom('rlvigo@rtu.edu.ph', 'Admin');
                    $mail->addAddress($userEmail);

                    // Set email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Request Approval';
                    $mail->Body = 'Your Request was Approved by the Supply Office';

                    // Send email
                    $mail->send();

                    // Email sent successfully
                } catch (Exception $e) {
                    // Email failed to send
                    return response()->json(['message' => 'Email failed to send'], 500);
                }

                $approver = AdminModel::where('Department', 'Finance Office')->first();
                $approverEmail = $approver->Email;
                $approver->notify(new SODeliverNotification());

                try {
                    // Initialize PHPMailer
                    $mail = new PHPMailer(true);

                    // Configure SMTP settings
                    $mail->isSMTP();
                    $mail->Host       = "smtp.gmail.com";
                    $mail->SMTPAuth   = true;
                    $mail->Username   = "rlvigo@rtu.edu.ph";
                    $mail->Password   = 'reymart11';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       =  465;

                    //Recipients
                    $mail->setFrom('rlvigo@rtu.edu.ph', 'Admin');
                    $mail->addAddress($approverEmail);

                    // Set email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Request Approval';
                    $mail->Body = 'A Request was Delivered by the Supply Office';

                    // Send email
                    $mail->send();

                    // Email sent successfully
                } catch (Exception $e) {
                    // Email failed to send
                    return response()->json(['message' => 'Email failed to send'], 500);
                }
            } else if ($req_status == 5) {
                $user = AdminModel::find($requested_by);
                $userEmail = $user->Email;
                $user->notify(new DeniedNotification());

                try {
                    // Initialize PHPMailer
                    $mail = new PHPMailer(true);

                    // Configure SMTP settings
                    $mail->isSMTP();
                    $mail->Host       = "smtp.gmail.com";
                    $mail->SMTPAuth   = true;
                    $mail->Username   = "rlvigo@rtu.edu.ph";
                    $mail->Password   = 'reymart11';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       =  465;

                    //Recipients
                    $mail->setFrom('rlvigo@rtu.edu.ph', 'Admin');
                    $mail->addAddress($userEmail);

                    // Set email content
                    $mail->isHTML(true);
                    $mail->Subject = 'Request Approval';
                    $mail->Body = 'Your Request was Denied by the Supply Office';

                    // Send email
                    $mail->send();

                    // Email sent successfully
                } catch (Exception $e) {
                    // Email failed to send
                    return response()->json(['message' => 'Email failed to send'], 500);
                }
            }

            return redirect('sopreriv')->with('message', 'update');
        }
    }
}
