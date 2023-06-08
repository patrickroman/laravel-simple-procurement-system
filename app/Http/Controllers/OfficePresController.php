<?php

namespace App\Http\Controllers;

use App\Models\OfficePresModel;
use App\Models\RequestModel;
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

use App\Notifications\PresidentApproved;
use App\Notifications\PresidentFinanceDenied;
use App\Notifications\OPDeliverNotification;

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

class OfficePresController extends Controller
{
    public function opdashboard()
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

        return view('president/president', ['notifications' => $notifications], compact('username', 'itemJson', 'department'));
    }
    public function presidentDashboard(Request $request)
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

        return view('president/president', ['notifications' => $notifications], compact('username', 'itemJson', 'department'));
    }
    public function csaproplan()
    {

        $data = DB::select('SELECT * FROM csappmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpcsa', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function casproplan()
    {

        $data = DB::select('SELECT * FROM casppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpcas', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function cbetproplan()
    {

        $data = DB::select('SELECT * FROM cbetppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpcbet', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ceatproplan()
    {

        $data = DB::select('SELECT * FROM ceatppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpceat', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function cedproplan()
    {

        $data = DB::select('SELECT * FROM cedppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpced', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ipeproplan()
    {

        $data = DB::select('SELECT * FROM ipeppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpipe', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function micproplan()
    {

        $data = DB::select('SELECT * FROM micppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpmic', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function drrmoproplan()
    {

        $data = DB::select('SELECT * FROM drrmoppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpdrrmo', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function gcscproplan()
    {

        $data = DB::select('SELECT * FROM gcscppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpgcsc', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ovpproplan()
    {

        $data = DB::select('SELECT * FROM ovpppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpovp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function sgoproplan()
    {

        $data = DB::select('SELECT * FROM sgoppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpsgo', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function sracproplan()
    {

        $data = DB::select('SELECT * FROM sracppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpsrac', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function hrdcproplan()
    {

        $data = DB::select('SELECT * FROM hrdcppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmphrdc', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function supplyproplan()
    {

        $data = DB::select('SELECT * FROM supply WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpsupply', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function financeproplan()
    {

        $data = DB::select('SELECT * FROM finance WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpfinance', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function presidentproplan()
    {

        $data = DB::select('SELECT * FROM president WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmppresident', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function bacproplan()
    {

        $data = DB::select('SELECT * FROM bac WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('president/ppmpbac', ['proplandata' => $data], ['notifications' => $notifications]);
    }

    public function opindorsement()
    {

        $data = DB::select('SELECT * FROM request WHERE deleted_at IS NULL AND request_status = 2 ');

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

        return view('president/opindorsement', compact('data', 'requestor_data'), ['notifications' => $notifications]);
    }

    public function opindorseview(Request $request)
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
            $order_data = DB::select('SELECT * FROM csa_order_list WHERE checkbox = "1" AND csa_preriv_id = ?', [$req_id]);
        } else if ($department == 'CEAT') {
            $order_data = DB::select('SELECT * FROM ceat_order_list WHERE checkbox = "1" AND ceat_preriv_id = ?', [$req_id]);
        } else if ($department == 'CAS') {
            $order_data = DB::select('SELECT * FROM cas_order_list WHERE checkbox = "1" AND cas_preriv_id = ?', [$req_id]);
        } else if ($department == 'CBET') {
            $order_data = DB::select('SELECT * FROM cbet_order_list WHERE checkbox = "1" AND cbet_preriv_id = ?', [$req_id]);
        } else if ($department == 'CED') {
            $order_data = DB::select('SELECT * FROM ced_order_list WHERE checkbox = "1" AND ced_preriv_id = ?', [$req_id]);
        } else if ($department == 'IPE') {
            $order_data = DB::select('SELECT * FROM ipe_order_list WHERE checkbox = "1" AND ipe_preriv_id = ?', [$req_id]);
        } else if ($department == 'Supply Office') {
            $order_data = DB::select('SELECT * FROM supply_order_list WHERE checkbox = "1" AND supply_preriv_id = ?', [$req_id]);
        } else if ($department == 'Finance') {
            $order_data = DB::select('SELECT * FROM finance_order_list WHERE checkbox = "1" AND finance_preriv_id = ?', [$req_id]);
        } else if ($department == 'President') {
            $order_data = DB::select('SELECT * FROM president_order_list WHERE checkbox = "1" AND president_preriv_id = ?', [$req_id]);
        } else if ($department == 'BAC') {
            $order_data = DB::select('SELECT * FROM bac_order_list WHERE checkbox = "1" AND bac_preriv_id = ?', [$req_id]);
        } else if ($department == 'MIC') {
            $order_data = DB::select('SELECT * FROM mic_order_list WHERE checkbox = "1" AND mic_preriv_id = ?', [$req_id]);
        } else if ($department == 'DRRMO') {
            $order_data = DB::select('SELECT * FROM drrmo_order_list WHERE checkbox = "1" AND drrmo_preriv_id = ?', [$req_id]);
        } else if ($department == 'GCSC') {
            $order_data = DB::select('SELECT * FROM gcsc_order_list WHERE checkbox = "1" AND gcsc_preriv_id = ?', [$req_id]);
        } else if ($department == 'OVP') {
            $order_data = DB::select('SELECT * FROM ovp_order_list WHERE checkbox = "1" AND ovp_preriv_id = ?', [$req_id]);
        } else if ($department == 'SGO') {
            $order_data = DB::select('SELECT * FROM sgo_order_list WHERE checkbox = "1" AND sgo_preriv_id = ?', [$req_id]);
        } else if ($department == 'SRAC') {
            $order_data = DB::select('SELECT * FROM srac_order_list WHERE checkbox = "1" AND srac_preriv_id = ?', [$req_id]);
        } else if ($department == 'HRDC') {
            $order_data = DB::select('SELECT * FROM hrdc_order_list WHERE checkbox = "1" AND hrdc_preriv_id = ?', [$req_id]);
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
        return view('president/opindorseview', ['requestview' => $req_data], compact('order_data', 'item_data', 'requestor_data', 'notifications'));
    }

    public function opindorseedit(Request $request)
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
            $order_data = DB::select('SELECT * FROM csa_order_list WHERE checkbox = "1" AND csa_preriv_id = ?', [$req_id]);
        } else if ($department == 'CEAT') {
            $order_data = DB::select('SELECT * FROM ceat_order_list WHERE checkbox = "1" AND ceat_preriv_id = ?', [$req_id]);
        } else if ($department == 'CAS') {
            $order_data = DB::select('SELECT * FROM cas_order_list WHERE checkbox = "1" AND cas_preriv_id = ?', [$req_id]);
        } else if ($department == 'CBET') {
            $order_data = DB::select('SELECT * FROM cbet_order_list WHERE checkbox = "1" AND cbet_preriv_id = ?', [$req_id]);
        } else if ($department == 'CED') {
            $order_data = DB::select('SELECT * FROM ced_order_list WHERE checkbox = "1" AND ced_preriv_id = ?', [$req_id]);
        } else if ($department == 'IPE') {
            $order_data = DB::select('SELECT * FROM ipe_order_list WHERE checkbox = "1" AND ipe_preriv_id = ?', [$req_id]);
        } else if ($department == 'Supply Office') {
            $order_data = DB::select('SELECT * FROM supply_order_list WHERE checkbox = "1" AND supply_preriv_id = ?', [$req_id]);
        } else if ($department == 'Finance') {
            $order_data = DB::select('SELECT * FROM finance_order_list WHERE checkbox = "1" AND finance_preriv_id = ?', [$req_id]);
        } else if ($department == 'President') {
            $order_data = DB::select('SELECT * FROM president_order_list WHERE checkbox = "1" AND president_preriv_id = ?', [$req_id]);
        } else if ($department == 'BAC') {
            $order_data = DB::select('SELECT * FROM bac_order_list WHERE checkbox = "1" AND bac_preriv_id = ?', [$req_id]);
        } else if ($department == 'MIC') {
            $order_data = DB::select('SELECT * FROM mic_order_list WHERE checkbox = "1" AND mic_preriv_id = ?', [$req_id]);
        } else if ($department == 'DRRMO') {
            $order_data = DB::select('SELECT * FROM drrmo_order_list WHERE checkbox = "1" AND drrmo_preriv_id = ?', [$req_id]);
        } else if ($department == 'GCSC') {
            $order_data = DB::select('SELECT * FROM gcsc_order_list WHERE checkbox = "1" AND gcsc_preriv_id = ?', [$req_id]);
        } else if ($department == 'OVP') {
            $order_data = DB::select('SELECT * FROM ovp_order_list WHERE checkbox = "1" AND ovp_preriv_id = ?', [$req_id]);
        } else if ($department == 'SGO') {
            $order_data = DB::select('SELECT * FROM sgo_order_list WHERE checkbox = "1" AND sgo_preriv_id = ?', [$req_id]);
        } else if ($department == 'SRAC') {
            $order_data = DB::select('SELECT * FROM srac_order_list WHERE checkbox = "1" AND srac_preriv_id = ?', [$req_id]);
        } else if ($department == 'HRDC') {
            $order_data = DB::select('SELECT * FROM hrdc_order_list WHERE checkbox = "1" AND hrdc_preriv_id = ?', [$req_id]);
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

        return view('president/opindorseedit', ['requestview' => $req_data], compact('order_data', 'item_data', 'notifications'));
    }

    public function opeditindorse(Request $request)
    {

        $req_id = $request->input('Id');
        $req_notes = $request->input('notes');
        $req_purpose = $request->input('purpose');
        $req_source = $request->input('source');
        $req_action = $request->input('action');
        $req_status = $request->input('status');
        $req_remarks = $request->input('remarks');
        $user_name = $request->input('user_name');
        $req_category = $request->input('category');
        $requested_by = $request->input('requested_by');

        switch ($req_status) {
            case '3':
                $delivered_to = "BAC Office";
                break;
            case '5':
                $delivered_to = " ";
                break;
            default:
                $req_status = 2;
                $delivered_to = "Office of the President";
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
        $insert->category = $req_category;

        $insert->save();

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited a Request ";
        $insertlogs->save();

        if ($req_status == 3) {
            $user = AdminModel::find($requested_by);
            $userEmail = $user->Email;
            $user->notify(new PresidentApproved());

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
                $mail->Body = 'Your Request was Approved by the Office of the President';

                // Send email
                $mail->send();

                // Email sent successfully
            } catch (Exception $e) {
                // Email failed to send
                return response()->json(['message' => 'Email failed to send'], 500);
            }

            $approver = AdminModel::where('Department', 'BAC Office')->first();
            $approverEmail = $approver->Email;
            $approver->notify(new OPDeliverNotification());

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
                $mail->Body = 'A Request was Delivered by the Office of the President';

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
            $user->notify(new PresidentDenied());

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
                $mail->Body = 'Your Request was Denied by the Office of the President';

                // Send email
                $mail->send();

                // Email sent successfully
            } catch (Exception $e) {
                // Email failed to send
                return response()->json(['message' => 'Email failed to send'], 500);
            }
        }

        return redirect('opindorsement')->with('message', 'update');
    }
}
