<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\BACModel;
use App\Models\CSAModel;
use App\Models\CEATModel;
use App\Models\CBETModel;
use App\Models\CASModel;
use App\Models\CEDModel;
use App\Models\IPEModel;
use App\Models\RequestModel;
use App\Models\CSA_Order_List_Model;
use App\Models\CEAT_Order_List_Model;
use App\Models\AuditTrailModel;

use App\Notifications\BACApproved;
use App\Notifications\BACDenied;

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

class BACInfraController extends Controller
{
    public function bacinfra()
    {
        $usersession = Session::get('user');

        if (!session()->has('user')) {

            return redirect('/')->with('alert', 'Login to access this page');
        }

        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        $department = 'CSA';
        $item = DB::select('SELECT * FROM csappmp WHERE checkbox = 1');
        $itemJson = json_encode($item);

        return view('bac infra/bac', ['notifications' => $notifications], compact('itemJson', 'department'));
    }
    public function bacinfraDashboard(Request $request)
    {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

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

        return view('bac infra/bac', ['notifications' => $notifications], compact('itemJson', 'department'));
    }
    public function csaproplan()
    {

        $data = DB::select('SELECT * FROM csappmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpcsa', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function casproplan()
    {

        $data = DB::select('SELECT * FROM casppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpcas', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function cbetproplan()
    {

        $data = DB::select('SELECT * FROM cbetppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpcbet', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ceatproplan()
    {

        $data = DB::select('SELECT * FROM ceatppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpceat', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function cedproplan()
    {

        $data = DB::select('SELECT * FROM cedppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpced', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ipeproplan()
    {

        $data = DB::select('SELECT * FROM ipeppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpipe', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function micproplan()
    {

        $data = DB::select('SELECT * FROM micppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpmic', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function drrmoproplan()
    {

        $data = DB::select('SELECT * FROM drrmoppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpdrrmo', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function gcscproplan()
    {

        $data = DB::select('SELECT * FROM gcscppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpgcsc', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function ovpproplan()
    {

        $data = DB::select('SELECT * FROM ovpppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpovp', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function sgoproplan()
    {

        $data = DB::select('SELECT * FROM sgoppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpsgo', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function sracproplan()
    {

        $data = DB::select('SELECT * FROM sracppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpsrac', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function hrdcproplan()
    {

        $data = DB::select('SELECT * FROM hrdcppmp WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmphrdc', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function supplyproplan()
    {

        $data = DB::select('SELECT * FROM supply WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpsupply', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function financeproplan()
    {

        $data = DB::select('SELECT * FROM finance WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpfinance', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function presidentproplan()
    {

        $data = DB::select('SELECT * FROM president WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmppresident', ['proplandata' => $data], ['notifications' => $notifications]);
    }
    public function bacproplan()
    {

        $data = DB::select('SELECT * FROM bac WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('bac infra/ppmpbac', ['proplandata' => $data], ['notifications' => $notifications]);
    }

    public function biddings()
    {

        $data = DB::select('SELECT * FROM request WHERE request_status = 3 AND deleted_at IS NULL AND category = "Infrastructure Bidding" ');

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

        return view('bac infra/bidding', compact('data', 'requestor_data'), ['notifications' => $notifications]);
    }

    public function biddingsedit(Request $request)
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
        }

        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            if ($department == 'CSA') {
                $item_data[] = DB::select('SELECT ItemDet FROM csappmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CEAT') {
                $item_data[] = DB::select('SELECT ItemDet FROM ceatppmp WHERE ppmpID = ?', [$itemname]);
            }
        }

        return view('bac infra/biddingedit', ['requestview' => $req_data], compact('order_data', 'item_data', 'notifications'));
    }

    public function biddingsview(Request $request)
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
        }

        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            if ($department == 'CSA') {
                $item_data[] = DB::select('SELECT ItemDet FROM csappmp WHERE ppmpID = ?', [$itemname]);
            } else if ($department == 'CEAT') {
                $item_data[] = DB::select('SELECT ItemDet FROM ceatppmp WHERE ppmpID = ?', [$itemname]);
            }
        }
        return view('bac infra/biddingview', ['requestview' => $req_data], compact('order_data', 'item_data', 'requestor_data', 'notifications'));
    }

    public function biddingsupdate(Request $request)
    {

        $req_id = $request->input('Id');
        $req_notes = $request->input('notes');
        $req_purpose = $request->input('purpose');
        $req_source = $request->input('source');
        $req_action = $request->input('action');
        $req_status = $request->input('status');
        $req_remarks = $request->input('remarks');
        $user_name = $request->input('user_name');

        switch ($req_status) {
            case '4':
                $delivered_to = "BAC Office";
                break;
            case '5':
                $delivered_to = " ";
                break;
            default:
                $req_status = 3;
                $delivered_to = "BAC Office";
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

        $insertlogs = new AuditTrailModel;
        $insertlogs->user = $user_name;
        $insertlogs->action_made =  "Edited a Request ";
        $insertlogs->save();

        if ($req_status == 4) {
            $currentMonth = date('m');

            $req_data = DB::select('SELECT * FROM request WHERE request_id = ?', [$req_id]);

            foreach ($req_data as  $req_data) {
                $department = $req_data->department;
            }

            if ($department == 'CSA') {
                $order_data = DB::select('SELECT * FROM csa_order_list WHERE csa_preriv_id = ?', [$req_id]);
            } else if ($department == 'CEAT') {
                $order_data = DB::select('SELECT * FROM ceat_order_list WHERE ceat_preriv_id = ?', [$req_id]);
            }

            switch ($currentMonth) {
                case '01':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Jan = $insert->Jan + $itemqty;
                            $insert->Q1 = $insert->Q1 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Jan =  $insert->Jan + $itemqty;
                            $insert->Q1 = $insert->Q1 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '02':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Feb = $insert->Feb + $itemqty;
                            $insert->Q1 = $insert->Q1 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Feb = $insert->Feb + $itemqty;
                            $insert->Q1 = $insert->Q1 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '03':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Mar = $insert->Mar + $itemqty;
                            $insert->Q1 = $insert->Q1 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Mar = $insert->Mar + $itemqty;
                            $insert->Q1 = $insert->Q1 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '04':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Apr = $insert->Apr + $itemqty;
                            $insert->Q2 = $insert->Q2 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Apr = $insert->Apr + $itemqty;
                            $insert->Q2 = $insert->Q2 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '05':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->May = $insert->May + $itemqty;
                            $insert->Q2 = $insert->Q2 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->May = $insert->May + $itemqty;
                            $insert->Q2 = $insert->Q2 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '06':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->June = $insert->June + $itemqty;
                            $insert->Q2 = $insert->Q2 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->June = $insert->June + $itemqty;
                            $insert->Q2 = $insert->Q2 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '07':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->July = $insert->July + $itemqty;
                            $insert->Q3 = $insert->Q3 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->July = $insert->July + $itemqty;
                            $insert->Q3 = $insert->Q3 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '08':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Aug = $insert->Aug + $itemqty;
                            $insert->Q3 = $insert->Q3 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Aug = $insert->Aug + $itemqty;
                            $insert->Q3 = $insert->Q3 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '09':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Sept = $insert->Sept + $itemqty;
                            $insert->Q3 = $insert->Q3 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Sept = $insert->Sept + $itemqty;
                            $insert->Q3 = $insert->Q3 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '10':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Oct = $insert->Oct + $itemqty;
                            $insert->Q4 = $insert->Q4 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Oct = $insert->Oct + $itemqty;
                            $insert->Q4 = $insert->Q4 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                case '11':
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Nov = $insert->Nov + $itemqty;
                            $insert->Q4 = $insert->Q4 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Nov = $insert->Nov + $itemqty;
                            $insert->Q4 = $insert->Q4 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
                default:
                    foreach ($order_data as  $itemfind) {
                        $itemname = $itemfind->item_id;
                        $itemqty = $itemfind->quantity;
                        if ($department == 'CSA') {
                            $insert = CSAModel::find($itemname);
                            $insert->Dec = $insert->Dec + $itemqty;
                            $insert->Q4 = $insert->Q4 - $itemqty;
                            $insert->save();
                        } else if ($department == 'CEAT') {
                            $insert = CEATModel::find($itemname);
                            $insert->Dec = $insert->Dec + $itemqty;
                            $insert->Q4 = $insert->Q4 - $itemqty;
                            $insert->save();
                        }
                    }
                    break;
            }
        }

        if ($req_status == 4) {
            $user = AdminModel::find($requested_by);
            $userEmail = $user->Email;
            $user->notify(new BACApproved());

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
                $mail->Body = 'Your Request was Approved by the BAC Office';

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
            $user->notify(new BACDenied());

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
                $mail->Body = 'Your Request was Denied by the BAC Office';

                // Send email
                $mail->send();

                // Email sent successfully
            } catch (Exception $e) {
                // Email failed to send
                return response()->json(['message' => 'Email failed to send'], 500);
            }
        }

        return redirect('biddings')->with('message', 'update');
    }
}
