<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\SupplyOfficeModel;
use App\Models\RequestModel;
use App\Models\Supply_Order_List_Model;
use App\Models\AuditTrailModel;

use App\Notifications\RequestNotification;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '..\mail\Exception.php';
require '..\mail\PHPMailer.php';
require '..\mail\SMTP.php';


class SupplyRequestController extends Controller
{
    public function supplydashboard()
    {
        $usersession = Session::get('user');
        if (!session()->has('user')) {

            return redirect('/')->with('alert', 'Login to access this page');
        }
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        $username = $user->Firstname;

        $item = DB::select('SELECT * FROM supply WHERE checkbox = 1');
        $countItem = count($item);
        $itemJson = json_encode($item);
        /* $collection = collect($item);
        $itemJson = $collection->toJson(); */

        $activeRequest = DB::select('SELECT * FROM request WHERE department = "Supply Office" AND request_status != 4 AND request_status != 5 AND requested_by = ?', [$usersession]);
        $countActive = count($activeRequest);

        $closeRequest = DB::select('SELECT * FROM request WHERE department = "Supply Office" AND requested_by = ? AND request_status = 4 OR request_status = 5 ', [$usersession]);
        $countClosed = count($closeRequest);

        return view('supply staff/supply', ['notifications' => $notifications], compact('username', 'itemJson', 'countItem', 'countActive', 'countClosed'));
    }

    public function supplyproplan()
    {

        $data = DB::select('SELECT * FROM supply WHERE checkbox = 1');

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        return view('supply staff/supplyproplan', ['proplandata' => $data], ['notifications' => $notifications]);
    }

    public function markRead()
    {

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);

        $notifications = $user->unreadNotifications->markAsRead();

        return redirect()->back();
    }

    public function requestlist()
    {

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        $data = DB::select('SELECT * FROM request WHERE department = "Supply Office" AND request_status != 4 AND request_status != 5 AND deleted_at IS NULL AND requested_by = ?', [$usersession]);

        if ($data == NULL) {
            $requestor_data = [];
        } else {
            foreach ($data as  $finduser) {
                $username = $finduser->requested_by;
                $requestor_data[] = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        return view('supply staff/supplyrequest', compact('data', 'requestor_data'), ['notifications' => $notifications]);
    }
    public function requestlist2()
    {

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        $data = DB::select('SELECT * FROM request WHERE department = "Supply Office" AND deleted_at IS NULL AND requested_by = ? AND request_status = 4 OR request_status = 5 ', [$usersession]);

        if ($data == NULL) {
            $requestor_data = [];
        } else {
            foreach ($data as  $finduser) {
                $username = $finduser->requested_by;
                $requestor_data[] = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        return view('supply staff/supplyrequest2', compact('data', 'requestor_data'), ['notifications' => $notifications]);
    }

    public function autocomplete(Request $request)
    {

        $data = DB::select('SELECT * FROM supply WHERE checkbox = 1');

        foreach ($data as $search) {
            $result[] = array("id" => $search->ppmpID, "label" => $search->ItemDet, "unit" => $search->UnitMeas, "price" => $search->Price, "q1" => $search->Q1, "q2" => $search->Q2, "q3" => $search->Q3, "q4" => $search->Q4);
        }

        return json_encode($result);
    }

    public function supplyaddrequest(Request $request)
    {

        $control_no = $request->input('controlno');
        $notes = $request->input('notes');
        $purpose = $request->input('purpose');
        $source = $request->input('source');
        $requestby = $request->input('requestby');
        $action = $request->input('action');
        $user_name = $request->input('user_name');

        $insert = new RequestModel;

        $insert->control_no =  $control_no;
        $insert->department =  "Supply Office";
        $insert->delivered_to =  "Supply Office";
        $insert->request_status =  0;
        $insert->notes =  $notes;
        $insert->purpose =  $purpose;
        $insert->budget_source =  $source;
        $insert->requested_by =  $requestby;
        $insert->action_taken =  $action;

        $insert->save();
        $request_id =  $insert->request_id;

        if ($insert) {

            $quantity = $request->input('qty');
            $unit = $request->input('unit');
            $item_id = $request->input('item_id');
            $unit_price = $request->input('unit_price');

            foreach ($quantity as $index => $data) {
                $insert = new Supply_Order_List_Model;

                $insert->supply_preriv_id = $request_id;

                $insert->quantity = $data;
                $insert->item_id = $item_id[$index];
                $insert->unit = $unit[$index];
                $insert->unit_price = $unit_price[$index];

                $insert->save();
            }

            $count_data = Supply_Order_List_Model::where('supply_preriv_id', $request_id)->count();

            $total_data = Supply_Order_List_Model::where('supply_preriv_id', $request_id)->value(DB::raw("SUM(quantity * unit_price)"));

            $update = RequestModel::find($request_id);

            $update->item_count =  $count_data;
            $update->total_price =  $total_data;
            $update->save();

            $insertlogs = new AuditTrailModel;
            $insertlogs->user = $user_name;
            $insertlogs->action_made =  "Added new Request";
            $insertlogs->save();

            $approver = AdminModel::where('Department', 'Supply Office')->first();
            $approverEmail = $approver->Email;
            $requestor = AdminModel::find($user_name);
            $requestorName = $requestor->Firstname;
            $approver->notify(new RequestNotification($requestorName));

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
                $mail->Body = 'A Request was Delivered by ' . $requestorName;

                // Send email
                $mail->send();

                // Email sent successfully
            } catch (Exception $e) {
                // Email failed to send
                return response()->json(['message' => 'Email failed to send'], 500);
            }

            return redirect('supplyrequest')->with('message', 'success');
        }
    }

    public function supplydetails(Request $request)
    {

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        $req_id = $request->input('details');

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

        $order_data = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ?', [$req_id]);
        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            $item_data[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$itemname]);
        }

        $approve_order = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        if ($approve_order == NULL) {
            $approve_item = NULL;
        } else {
            foreach ($approve_order as  $itemcheck) {
                $item = $itemcheck->item_id;
                $approve_item[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$item]);
            }
        }

        return view('supply staff/supplyhistory', ['requesthistory' => $req_data], compact('order_data', 'item_data', 'approve_order', 'approve_item', 'user_data', 'requestor_data', 'notifications'));
    }

    public function supplydetails2(Request $request)
    {

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        $req_id = $request->input('details');

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

        $order_data = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ?', [$req_id]);
        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            $item_data[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$itemname]);
        }

        $approve_order = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ? AND checkbox = ?', [$req_id, 1]);
        if ($approve_order == NULL) {
            $approve_item = NULL;
        } else {
            foreach ($approve_order as  $itemcheck) {
                $item = $itemcheck->item_id;
                $approve_item[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$item]);
            }
        }

        return view('supply staff/supplyhistory', ['requesthistory' => $req_data], compact('order_data', 'item_data', 'approve_order', 'approve_item', 'user_data', 'requestor_data', 'notifications'));
    }

    public function supplyrequestview(Request $request)
    {

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        $req_id = $request->input('viewrequest');

        $req_data = DB::select('SELECT * FROM request WHERE request_id = ?', [$req_id]);
        $order_data = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ?', [$req_id]);

        foreach ($req_data as  $finduser) {
            $username = $finduser->requested_by;
            $requestor_data = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
        }

        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            $item_data[] = DB::select('SELECT ItemDet FROM supply WHERE ppmpID = ?', [$itemname]);
        }

        return view('supply staff/supplyrequestview', ['requestview' => $req_data], compact('order_data', 'item_data', 'requestor_data', 'notifications'));
    }

    public function supplyrequestedit(Request $request)
    {

        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        $req_id = $request->input('editrequest');

        $req_data = DB::select('SELECT * FROM request WHERE request_id = ?', [$req_id]);
        $order_data = DB::select('SELECT * FROM supply_order_list WHERE supply_preriv_id = ?', [$req_id]);

        foreach ($order_data as  $itemfind) {
            $itemname = $itemfind->item_id;
            $item_data[] = DB::select('SELECT * FROM supply WHERE ppmpID = ?', [$itemname]);
        }

        return view('supply staff/supplyrequestedit', ['requestview' => $req_data], compact('order_data', 'item_data', 'notifications'));
    }

    public function supplyeditrequest(Request $request)
    {

        $req_id = $request->input('Id');
        $req_notes = $request->input('notes');
        $req_purpose = $request->input('purpose');
        $req_source = $request->input('source');
        $req_action = $request->input('action');
        $user_name = $request->input('user_name');

        DB::delete('DELETE FROM supply_order_list where supply_preriv_id = ?', [$req_id]);

        $insert = RequestModel::find($req_id);

        $insert->notes =  $req_notes;
        $insert->purpose = $req_purpose;
        $insert->budget_source = $req_source;
        $insert->action_taken = $req_action;
        $insert->updated_by_id = $user_name;

        $insert->save();

        if ($insert) {

            $quantity = $request->input('qty');
            $unit = $request->input('unit');
            $item_id = $request->input('item_id');
            $unit_price = $request->input('unit_price');

            foreach ($quantity as $index => $data) {
                $insert = new Supply_Order_List_Model;

                $insert->supply_preriv_id = $req_id;

                $insert->quantity = $data;
                $insert->item_id = $item_id[$index];
                $insert->unit = $unit[$index];
                $insert->unit_price = $unit_price[$index];

                $insert->save();
            }

            $count_data = Supply_Order_List_Model::where('supply_preriv_id', $req_id)->count();

            $total_data = Supply_Order_List_Model::where('supply_preriv_id', $req_id)->value(DB::raw("SUM(quantity * unit_price)"));

            $update = RequestModel::find($req_id);
            $update->item_count =  $count_data;
            $update->total_price =  $total_data;
            $update->save();

            $insertlogs = new AuditTrailModel;
            $insertlogs->user = $user_name;
            $insertlogs->action_made =  "Edited a Request ";
            $insertlogs->save();

            return redirect('supplyrequest')->with('message', 'update');
        }
    }

    public function supplydeleterequest(Request $request)
    {

        $req_id = $request->input('deleterequest');

        $delete = RequestModel::find($req_id);
        $delete->delete();

        return redirect('supplyrequest');
    }

    public function supplytrash()
    {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;

        $data = DB::select('SELECT * FROM request WHERE department = "Supply Office" AND deleted_at IS NOT NULL AND requested_by = ?', [$usersession]);

        if ($data == NULL) {
            $requestor_data = [];
        } else {
            foreach ($data as  $finduser) {
                $username = $finduser->requested_by;
                $requestor_data[] = DB::select('SELECT * FROM users WHERE userID = ?', [$username]);
            }
        }

        return view('supply/supplytrash', compact('data', 'requestor_data'), ['notifications' => $notifications]);
    }
    public function supplyrestoreall()
    {
        $restore = RequestModel::onlyTrashed()->restore();

        return redirect('supplytrash')->with('message', 'restored');;
    }
    public function supplyeraseall()
    {
        $restore = RequestModel::onlyTrashed()->forceDelete();

        return redirect('supplytrash')->with('message', 'erased');;
    }
    public function supplyrestore(Request $request)
    {

        $req_id = $request->input('restore');

        $restore = RequestModel::onlyTrashed()->where('request_id', $req_id)->first();
        $restore->restore();

        return redirect('supplytrash')->with('message', 'restored');;
    }
    public function supplyerase(Request $request)
    {

        $req_id = $request->input('erase');

        $erase = RequestModel::onlyTrashed()->where('request_id', $req_id)->first();
        $erase->forceDelete();

        return redirect('supplytrash')->with('message', 'erased');;
    }
}
