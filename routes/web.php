<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CSAController;
use App\Http\Controllers\CEATController;
use App\Http\Controllers\CASController;
use App\Http\Controllers\CBETController;
use App\Http\Controllers\CEDController;
use App\Http\Controllers\IPEController;
use App\Http\Controllers\MICController;
use App\Http\Controllers\DRRMOController;
use App\Http\Controllers\GCSCController;
use App\Http\Controllers\OVPController;
use App\Http\Controllers\SGOController;
use App\Http\Controllers\SRACController;
use App\Http\Controllers\HRDCController;
use App\Http\Controllers\SupplyOfficeController;
use App\Http\Controllers\SupplyRequestController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinanceRequestController;
use App\Http\Controllers\OfficePresController;
use App\Http\Controllers\OfficePresRequestController;
use App\Http\Controllers\BACController;
use App\Http\Controllers\BACGoodsController;
use App\Http\Controllers\BACInfraController;
use App\Http\Controllers\LoginController;

use App\Models\AdminModel;

use App\Http\Controllers\PasswordResetController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Login */


Route::post('forgot_password', function () {
    return view('forgot_password');
});

Route::get('/success', function () {
    return view('success');
});


//Route::post('success', [PasswordResetController::class, 'resetPassword']);
Route::get('/change_password', function () {
    return view('change_password');
});

Route::post('change_password', [PasswordResetController::class, 'resetPassword']);


Route::post("change_password_process", function () {
    return view('change_password_process');
});

Route::post('/login', [LoginController::class, 'login']);

/* Logout */

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/reset_password', function () {
    return view('reset_password');
});

Route::get('/success', function () {
    return view('success');
});

Route::get('/login', [LoginController::class, 'logout'])->name('logout');




Route::middleware(['auth'])->group(function () {

    /* ADMIN */
    Route::get('/admin', [AdminController::class, 'admin']);

    //Route::get('/admin', [AdminController::class, 'admin']);
    Route::get('/adminDashboard', [AdminController::class, 'adminDashboard']);
    Route::get('/ppmpcas', [AdminController::class, 'casproplan']);
    Route::get('/ppmpcbet', [AdminController::class, 'cbetproplan']);
    Route::get('/ppmpceat', [AdminController::class, 'ceatproplan']);
    Route::get('/ppmpced', [AdminController::class, 'cedproplan']);
    Route::get('/ppmpipe', [AdminController::class, 'ipeproplan']);
    Route::get('/ppmpcsa', [AdminController::class, 'csaproplan']);

    Route::get('/ppmpmic', [AdminController::class, 'micproplan']);
    Route::get('/ppmpdrrmo', [AdminController::class, 'drrmoproplan']);
    Route::get('/ppmpgcsc', [AdminController::class, 'gcscproplan']);
    Route::get('/ppmpovp', [AdminController::class, 'ovpproplan']);
    Route::get('/ppmpsgo', [AdminController::class, 'sgoproplan']);
    Route::get('/ppmpsrac', [AdminController::class, 'sracproplan']);
    Route::get('/ppmphrdc', [AdminController::class, 'hrdcproplan']);
    Route::get('/ppmpsupply', [AdminController::class, 'supplyproplan']);
    Route::get('/ppmpfinance', [AdminController::class, 'financeproplan']);
    Route::get('/ppmppresident', [AdminController::class, 'presidentproplan']);
    Route::get('/ppmpbac', [AdminController::class, 'bacproplan']);

    Route::post('/addcsaitem', [AdminController::class, 'addcsaitem']);
    Route::post('/editcsaitem', [AdminController::class, 'editcsaitem']);

    Route::post('/addceatitem', [AdminController::class, 'addceatitem']);
    Route::post('/editceatitem', [AdminController::class, 'editceatitem']);

    Route::post('/addcasitem', [AdminController::class, 'addcasitem']);
    Route::post('/editcasitem', [AdminController::class, 'editcasitem']);

    Route::post('/addcbetitem', [AdminController::class, 'addcbetitem']);
    Route::post('/editcbetitem', [AdminController::class, 'editcbetitem']);

    Route::post('/addceditem', [AdminController::class, 'addceditem']);
    Route::post('/editceditem', [AdminController::class, 'editceditem']);

    Route::post('/addipeitem', [AdminController::class, 'addipeitem']);
    Route::post('/editipeitem', [AdminController::class, 'editipeitem']);

    Route::get('/ceatadd', function () {
        return view('admin/ceatadd');
    });

    Route::get('/ceatedit', [AdminController::class, 'ceatedit']);
    Route::get('/ceatdelete', [AdminController::class, 'ceatdelete']);

    Route::get('/csaadd', function () {
        return view('admin/csaadd');
    });
    Route::get('/csaedit', [AdminController::class, 'csaedit']);
    Route::get('/csadelete', [AdminController::class, 'csadelete']);

    Route::get('/casadd', function () {
        return view('admin/casadd');
    });
    Route::get('/casedit', [AdminController::class, 'casedit']);
    Route::get('/casdelete', [AdminController::class, 'casdelete']);

    Route::get('/cbetadd', function () {
        return view('admin/cbetadd');
    });
    Route::get('/cbetedit', [AdminController::class, 'cbetedit']);
    Route::get('/cbetdelete', [AdminController::class, 'cbetdelete']);

    Route::get('/cedadd', function () {
        return view('admin/cedadd');
    });
    Route::get('/cededit', [AdminController::class, 'cededit']);
    Route::get('/ceddelete', [AdminController::class, 'ceddelete']);

    Route::get('/ipeadd', function () {
        return view('admin/ipeadd');
    });
    Route::get('/ipeedit', [AdminController::class, 'ipeedit']);
    Route::get('/ipedelete', [AdminController::class, 'ipedelete']);

    Route::get('/micadd', function () { return view('admin/micadd'); });
    Route::post('/addmicitem', [AdminController::class, 'addmicitem']);
    Route::get('/micedit', [AdminController::class, 'micedit']);
    Route::post('/editmicitem', [AdminController::class, 'editmicitem']);
    Route::get('/micdelete', [AdminController::class, 'micdelete']);

    Route::get('/drrmoadd', function () { return view('admin/drrmoadd'); });
    Route::post('/adddrrmoitem', [AdminController::class, 'adddrrmoitem']);
    Route::get('/drrmoedit', [AdminController::class, 'drrmoedit']);
    Route::post('/editdrrmoitem', [AdminController::class, 'editdrrmoitem']);
    Route::get('/drrmodelete', [AdminController::class, 'drrmodelete']);

    Route::get('/gcscadd', function () { return view('admin/gcscadd'); });
    Route::post('/addgcscitem', [AdminController::class, 'addgcscitem']);
    Route::get('/gcscedit', [AdminController::class, 'gcscedit']);
    Route::post('/editgcscitem', [AdminController::class, 'editgcscitem']);
    Route::get('/gcscdelete', [AdminController::class, 'gcscdelete']);

    Route::get('/ovpadd', function () { return view('admin/ovpadd'); });
    Route::post('/addovpitem', [AdminController::class, 'addovpitem']);
    Route::get('/ovpedit', [AdminController::class, 'ovpedit']);
    Route::post('/editovpitem', [AdminController::class, 'editovpitem']);
    Route::get('/ovpdelete', [AdminController::class, 'ovpdelete']);

    Route::get('/sgoadd', function () { return view('admin/sgoadd'); });
    Route::post('/addsgoitem', [AdminController::class, 'addsgoitem']);
    Route::get('/sgoedit', [AdminController::class, 'sgoedit']);
    Route::post('/editsgoitem', [AdminController::class, 'editsgoitem']);
    Route::get('/sgodelete', [AdminController::class, 'sgodelete']);

    Route::get('/sracadd', function () { return view('admin/sracadd'); });
    Route::post('/addsracitem', [AdminController::class, 'addsracitem']);
    Route::get('/sracedit', [AdminController::class, 'sracedit']);
    Route::post('/editsracitem', [AdminController::class, 'editsracitem']);
    Route::get('/sracdelete', [AdminController::class, 'sracdelete']);

    Route::get('/hrdcadd', function () { return view('admin/hrdcadd'); });
    Route::post('/addhrdcitem', [AdminController::class, 'addhrdcitem']);
    Route::get('/hrdcedit', [AdminController::class, 'hrdcedit']);
    Route::post('/edithrdcitem', [AdminController::class, 'edithrdcitem']);
    Route::get('/hrdcdelete', [AdminController::class, 'hrdcdelete']);

    Route::get('/supplyadd', function () { return view('admin/supplyadd'); });
    Route::post('/addsupplyitem', [AdminController::class, 'addsupplyitem']);
    Route::get('/supplyedit', [AdminController::class, 'supplyedit']);
    Route::post('/editsupplyitem', [AdminController::class, 'editsupplyitem']);
    Route::get('/supplydelete', [AdminController::class, 'supplydelete']);

    Route::get('/financeadd', function () { return view('admin/financeadd'); });
    Route::post('/addfinanceitem', [AdminController::class, 'addfinanceitem']);
    Route::get('/financeedit', [AdminController::class, 'financeedit']);
    Route::post('/editfinanceitem', [AdminController::class, 'editfinanceitem']);
    Route::get('/financedelete', [AdminController::class, 'financedelete']);

    Route::get('/presidentadd', function () { return view('admin/presidentadd'); });
    Route::post('/addpresidentitem', [AdminController::class, 'addpresidentitem']);
    Route::get('/presidentedit', [AdminController::class, 'presidentedit']);
    Route::post('/editpresidentitem', [AdminController::class, 'editpresidentitem']);
    Route::get('/presidentdelete', [AdminController::class, 'presidentdelete']);

    Route::get('/bacadd', function () { return view('admin/bacadd'); });
    Route::post('/addbacitem', [AdminController::class, 'addbacitem']);
    Route::get('/bacedit', [AdminController::class, 'bacedit']);
    Route::post('/editbacitem', [AdminController::class, 'editbacitem']);
    Route::get('/bacdelete', [AdminController::class, 'bacdelete']);

    Route::get('/approvedppmpcsa', [AdminController::class, 'approvedppmpcsa']);
    Route::get('/approvedppmpcas', [AdminController::class, 'approvedppmpcas']);
    Route::get('/approvedppmpcbet', [AdminController::class, 'approvedppmpcbet']);
    Route::get('/approvedppmpceat', [AdminController::class, 'approvedppmpceat']);
    Route::get('/approvedppmpced', [AdminController::class, 'approvedppmpced']);
    Route::get('/approvedppmpipe', [AdminController::class, 'approvedppmpipe']);
    Route::get('/approvedppmpmic', [AdminController::class, 'approvedppmpmic']);
    Route::get('/approvedppmpdrrmo', [AdminController::class, 'approvedppmpdrrmo']);
    Route::get('/approvedppmpgcsc', [AdminController::class, 'approvedppmpgcsc']);
    Route::get('/approvedppmpovp', [AdminController::class, 'approvedppmpovp']);
    Route::get('/approvedppmpsgo', [AdminController::class, 'approvedppmpsgo']);
    Route::get('/approvedppmpsrac', [AdminController::class, 'approvedppmpsrac']);
    Route::get('/approvedppmphrdc', [AdminController::class, 'approvedppmphrdc']);
    Route::get('/approvedppmpsupply', [AdminController::class, 'approvedppmpsupply']);
    Route::get('/approvedppmpfinance', [AdminController::class, 'approvedppmpfinance']);
    Route::get('/approvedppmppresident', [AdminController::class, 'approvedppmppresident']);
    Route::get('/approvedppmpbac', [AdminController::class, 'approvedppmpbac']);

    Route::get('/usermanagement', [AdminController::class, 'userlist']);

    Route::get('/useradd', function () {
        return view('admin/useradd');
    });
    Route::post('/adduser', [AdminController::class, 'adduser']);

    Route::get('/useredit', [AdminController::class, 'useredit']);

    Route::get('/userdelete', [AdminController::class, 'userdelete']);

    Route::post('/edituserdata', [AdminController::class, 'edituserdata']);

    Route::get('/adminreqlist', [AdminController::class, 'adminreqlist']);

    Route::get('/adminreqlist2', [AdminController::class, 'adminreqlist2']);

    Route::get('/requesthistory', [AdminController::class, 'requesthistory']);

    Route::get('/requesthistory2', [AdminController::class, 'requesthistory2']);

    Route::get('/audittrail', [AdminController::class, 'audittrail']);

    Route::get('/summary', [AdminController::class, 'summary']);
    // Add more restricted routes here



    /* CSA */
    Route::get('/csadashboard', [CSAController::class, 'csa']);

    Route::get('/csaproplan', [CSAController::class, 'csaproplan']);

    Route::get('/csarequest', [CSAController::class, 'requestlist']);

    Route::get('/csarequest2', [CSAController::class, 'requestlist2']);

    Route::get('/csadetails', [CSAController::class, 'csadetails']);

    Route::get('/csadetails2', [CSAController::class, 'csadetails2']);

    Route::get('/csarequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('csa/csarequestadd', ['notifications' => $notifications]);
    });

    Route::post('/csaaddrequest', [CSAController::class, 'csaaddrequest']);

    Route::get('/csarequestedit', [CSAController::class, 'csarequestedit']);

    Route::get('/csarequestview', [CSAController::class, 'csarequestview']);

    Route::get('/csaautocomplete', [CSAController::class, 'autocomplete'])->name('autocomplete');

    Route::post('/csaeditrequest', [CSAController::class, 'csaeditrequest']);

    Route::get('/csadeleterequest', [CSAController::class, 'deleterequest']);

    Route::get('/csatrash', [CSAController::class, 'csatrash']);
    Route::get('/csarestoreall', [CSAController::class, 'csarestoreall']);
    Route::get('/csaeraseall', [CSAController::class, 'csaeraseall']);
    Route::get('/csarestore', [CSAController::class, 'csarestore']);
    Route::get('/csaerase', [CSAController::class, 'csaerase']);

    Route::get('/markRead', [CSAController::class, 'markRead']);


    /* CEAT */
    Route::get('/ceatdashboard', [CEATController::class, 'ceat']);

    Route::get('/ceatproplan', [CEATController::class, 'ceatproplan']);

    Route::get('/ceatrequest', [CEATController::class, 'requestlist']);

    Route::get('/ceatrequest2', [CEATController::class, 'requestlist2']);

    Route::get('/ceatautocomplete', [CEATController::class, 'autocomplete'])->name('autocomplete');

    Route::get('/ceatdetails', [CEATController::class, 'ceatdetails']);

    Route::get('/ceatdetails2', [CEATController::class, 'ceatdetails2']);

    Route::get('/ceatrequestview', [CEATController::class, 'ceatrequestview']);

    Route::get('/ceatrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('ceat/ceatrequestadd', ['notifications' => $notifications]);
    });

    Route::post('/ceataddrequest', [CEATController::class, 'ceataddrequest']);

    Route::get('/ceatrequestedit', [CEATController::class, 'ceatrequestedit']);

    Route::post('/ceateditrequest', [CEATController::class, 'ceateditrequest']);

    Route::get('/ceatdeleterequest', [CEATController::class, 'ceatdeleterequest']);

    Route::get('/ceattrash', [CEATController::class, 'ceattrash']);
    Route::get('/ceatrestoreall', [CEATController::class, 'ceatrestoreall']);
    Route::get('/ceateraseall', [CEATController::class, 'ceateraseall']);
    Route::get('/ceatrestore', [CEATController::class, 'ceatrestore']);
    Route::get('/ceaterase', [CEATController::class, 'ceaterase']);

    /* CAS */
    Route::get('/casdashboard', [CASController::class, 'cas']);
    Route::get('/casproplan', [CASController::class, 'casproplan']);
    Route::get('/casrequest', [CASController::class, 'requestlist']);
    Route::get('/casrequest2', [CASController::class, 'requestlist2']);
    Route::get('/casdetails', [CASController::class, 'casdetails']);
    Route::get('/casdetails2', [CASController::class, 'casdetails2']);
    Route::get('/casrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('cas/casrequestadd', ['notifications' => $notifications]);
    });
    Route::post('/casaddrequest', [CASController::class, 'casaddrequest']);
    Route::get('/casrequestedit', [CASController::class, 'casrequestedit']);
    Route::get('/casrequestview', [CASController::class, 'casrequestview']);
    Route::get('/casautocomplete', [CASController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/caseditrequest', [CASController::class, 'caseditrequest']);
    Route::get('/casdeleterequest', [CASController::class, 'deleterequest']);

    Route::get('/castrash', [CASController::class, 'castrash']);
    Route::get('/casrestoreall', [CASController::class, 'casrestoreall']);
    Route::get('/caseraseall', [CASController::class, 'caseraseall']);
    Route::get('/casrestore', [CASController::class, 'casrestore']);
    Route::get('/caserase', [CASController::class, 'caserase']);

    /* CBET */
    Route::get('/cbetdashboard', [CBETController::class, 'cbet']);
    Route::get('/cbetproplan', [CBETController::class, 'cbetproplan']);
    Route::get('/cbetrequest', [CBETController::class, 'requestlist']);
    Route::get('/cbetrequest2', [CBETController::class, 'requestlist2']);
    Route::get('/cbetdetails', [CBETController::class, 'cbetdetails']);
    Route::get('/cbetdetails2', [CBETController::class, 'cbetdetails2']);
    Route::get('/cbetrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('cbet/cbetrequestadd', ['notifications' => $notifications]);
    });
    Route::post('/cbetaddrequest', [CBETController::class, 'cbetaddrequest']);
    Route::get('/cbetrequestedit', [CBETController::class, 'cbetrequestedit']);
    Route::get('/cbetrequestview', [CBETController::class, 'cbetrequestview']);
    Route::get('/cbetautocomplete', [CBETController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/cbeteditrequest', [CBETController::class, 'cbeteditrequest']);
    Route::get('/cbetdeleterequest', [CBETController::class, 'deleterequest']);

    Route::get('/cbettrash', [CBETController::class, 'cbettrash']);
    Route::get('/cbetrestoreall', [CBETController::class, 'cbetrestoreall']);
    Route::get('/cbeteraseall', [CBETController::class, 'cbeteraseall']);
    Route::get('/cbetrestore', [CBETController::class, 'cbetrestore']);
    Route::get('/cbeterase', [CBETController::class, 'cbeterase']);

    /* CED */
    Route::get('/ceddashboard', [CEDController::class, 'ced']);
    Route::get('/cedproplan', [CEDController::class, 'cedproplan']);
    Route::get('/cedrequest', [CEDController::class, 'requestlist']);
    Route::get('/cedrequest2', [CEDController::class, 'requestlist2']);
    Route::get('/ceddetails', [CEDController::class, 'ceddetails']);
    Route::get('/ceddetails2', [CEDController::class, 'ceddetails2']);
    Route::get('/cedrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('ced/cedrequestadd', ['notifications' => $notifications]);
    });
    Route::post('/cedaddrequest', [CEDController::class, 'cedaddrequest']);
    Route::get('/cedrequestedit', [CEDController::class, 'cedrequestedit']);
    Route::get('/cedrequestview', [CEDController::class, 'cedrequestview']);
    Route::get('/cedautocomplete', [CEDController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/cededitrequest', [CEDController::class, 'cededitrequest']);
    Route::get('/ceddeleterequest', [CEDController::class, 'deleterequest']);

    Route::get('/cedtrash', [CEDController::class, 'cedtrash']);
    Route::get('/cedrestoreall', [CEDController::class, 'cedrestoreall']);
    Route::get('/cederaseall', [CEDController::class, 'cederaseall']);
    Route::get('/cedrestore', [CEDController::class, 'cedrestore']);
    Route::get('/cederase', [CEDController::class, 'cederase']);

    /* IPE */
    Route::get('/ipedashboard', [IPEController::class, 'ipe']);
    Route::get('/ipeproplan', [IPEController::class, 'ipeproplan']);
    Route::get('/iperequest', [IPEController::class, 'requestlist']);
    Route::get('/iperequest2', [IPEController::class, 'requestlist2']);
    Route::get('/ipedetails', [IPEController::class, 'ipedetails']);
    Route::get('/ipedetails2', [IPEController::class, 'ipedetails2']);
    Route::get('/iperequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('ipe/iperequestadd', ['notifications' => $notifications]);
    });
    Route::post('/ipeaddrequest', [IPEController::class, 'ipeaddrequest']);
    Route::get('/iperequestedit', [IPEController::class, 'iperequestedit']);
    Route::get('/iperequestview', [IPEController::class, 'iperequestview']);
    Route::get('/ipeautocomplete', [IPEController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/ipeeditrequest', [IPEController::class, 'ipeeditrequest']);
    Route::get('/ipedeleterequest', [IPEController::class, 'deleterequest']);

    Route::get('/ipetrash', [IPEController::class, 'ipetrash']);
    Route::get('/iperestoreall', [IPEController::class, 'iperestoreall']);
    Route::get('/ipeeraseall', [IPEController::class, 'ipeeraseall']);
    Route::get('/iperestore', [IPEController::class, 'iperestore']);
    Route::get('/ipeerase', [IPEController::class, 'ipeerase']);

    /* SUPPLY OFFICE REQUESTOR */
    Route::get('/supplydashboard', [SupplyRequestController::class, 'supplydashboard']);

    Route::get('/supplyproplan', [SupplyRequestController::class, 'supplyproplan']);

    Route::get('/supplyrequest', [SupplyRequestController::class, 'requestlist']);

    Route::get('/supplyrequest2', [SupplyRequestController::class, 'requestlist2']);

    Route::get('/supplydetails', [SupplyRequestController::class, 'supplydetails']);

    Route::get('/supplydetails2', [SupplyRequestController::class, 'supplydetails2']);

    Route::get('/supplyrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('supply staff/supplyrequestadd', ['notifications' => $notifications]);
    });

    Route::post('/supplyaddrequest', [SupplyRequestController::class, 'supplyaddrequest']);

    Route::get('/supplyrequestedit', [SupplyRequestController::class, 'supplyrequestedit']);

    Route::get('/supplyrequestview', [SupplyRequestController::class, 'supplyrequestview']);

    Route::get('/supplyautocomplete', [SupplyRequestController::class, 'autocomplete'])->name('autocomplete');

    Route::post('/supplyeditrequest', [SupplyRequestController::class, 'supplyeditrequest']);

    Route::get('/supplydeleterequest', [SupplyRequestController::class, 'supplydeleterequest']);

    Route::get('/supplytrash', [SupplyRequestController::class, 'supplytrash']);
    Route::get('/supplyrestoreall', [SupplyRequestController::class, 'supplyrestoreall']);
    Route::get('/supplyeraseall', [SupplyRequestController::class, 'supplyeraseall']);
    Route::get('/supplyrestore', [SupplyRequestController::class, 'supplyrestore']);
    Route::get('/supplyerase', [SupplyRequestController::class, 'supplyerase']);

    /* SUPPLY OFFICE APPROVER*/
    Route::get('/sodashboard', [SupplyOfficeController::class, 'sodashboard']);
    Route::get('/supplyDashboard', [SupplyOfficeController::class, 'supplyDashboard']);

    Route::get('/soppmpcsa', [SupplyOfficeController::class, 'csaproplan']);
    Route::get('/soppmpcas', [SupplyOfficeController::class, 'casproplan']);
    Route::get('/soppmpcbet', [SupplyOfficeController::class, 'cbetproplan']);
    Route::get('/soppmpceat', [SupplyOfficeController::class, 'ceatproplan']);
    Route::get('/soppmpced', [SupplyOfficeController::class, 'cedproplan']);
    Route::get('/soppmpipe', [SupplyOfficeController::class, 'ipeproplan']);
    Route::get('/soppmpmic', [SupplyOfficeController::class, 'micproplan']);
    Route::get('/soppmpdrrmo', [SupplyOfficeController::class, 'drrmoproplan']);
    Route::get('/soppmpgcsc', [SupplyOfficeController::class, 'gcscproplan']);
    Route::get('/soppmpovp', [SupplyOfficeController::class, 'ovpproplan']);
    Route::get('/soppmpsgo', [SupplyOfficeController::class, 'sgoproplan']);
    Route::get('/soppmpsrac', [SupplyOfficeController::class, 'sracproplan']);
    Route::get('/soppmphrdc', [SupplyOfficeController::class, 'hrdcproplan']);
    Route::get('/soppmpsupply', [SupplyOfficeController::class, 'supplyproplan']);
    Route::get('/soppmpfinance', [SupplyOfficeController::class, 'financeproplan']);
    Route::get('/soppmppresident', [SupplyOfficeController::class, 'presidentproplan']);
    Route::get('/soppmpbac', [SupplyOfficeController::class, 'bacproplan']);

    Route::get('/checkcsaproplan', [SupplyOfficeController::class, 'checkcsaproplan']);
    Route::get('/checkcasproplan', [SupplyOfficeController::class, 'checkcasproplan']);
    Route::get('/checkcbetproplan', [SupplyOfficeController::class, 'checkcbetproplan']);
    Route::get('/checkceatproplan', [SupplyOfficeController::class, 'checkceatproplan']);
    Route::get('/checkcedproplan', [SupplyOfficeController::class, 'checkcedproplan']);
    Route::get('/checkipeproplan', [SupplyOfficeController::class, 'checkipeproplan']);
    Route::get('/checkmicproplan', [SupplyOfficeController::class, 'checkmicproplan']);
    Route::get('/checkdrrmoproplan', [SupplyOfficeController::class, 'checkdrrmoproplan']);
    Route::get('/checkgcscproplan', [SupplyOfficeController::class, 'checkgcscproplan']);
    Route::get('/checkovpproplan', [SupplyOfficeController::class, 'checkovpproplan']);
    Route::get('/checksgoproplan', [SupplyOfficeController::class, 'checksgoproplan']);
    Route::get('/checksracproplan', [SupplyOfficeController::class, 'checksracproplan']);
    Route::get('/checkhrdcproplan', [SupplyOfficeController::class, 'checkhrdcproplan']);
    Route::get('/checksupplyproplan', [SupplyOfficeController::class, 'checksupplyproplan']);
    Route::get('/checkfinanceproplan', [SupplyOfficeController::class, 'checkfinanceproplan']);
    Route::get('/checkpresidentproplan', [SupplyOfficeController::class, 'checkpresidentproplan']);
    Route::get('/checkbacproplan', [SupplyOfficeController::class, 'checkbacproplan']);

    Route::post('/csacheckupdate', [SupplyOfficeController::class, 'csacheckupdate']);
    Route::post('/cascheckupdate', [SupplyOfficeController::class, 'cascheckupdate']);
    Route::post('/cbetcheckupdate', [SupplyOfficeController::class, 'cbetcheckupdate']);
    Route::post('/ceatcheckupdate', [SupplyOfficeController::class, 'ceatcheckupdate']);
    Route::post('/cedcheckupdate', [SupplyOfficeController::class, 'cedcheckupdate']);
    Route::post('/ipecheckupdate', [SupplyOfficeController::class, 'ipecheckupdate']);
    Route::get('/miccheckupdate', [SupplyOfficeController::class, 'miccheckupdate']);
    Route::get('/drrmocheckupdate', [SupplyOfficeController::class, 'drrmocheckupdate']);
    Route::get('/gcsccheckupdate', [SupplyOfficeController::class, 'gcsccheckupdate']);
    Route::get('/ovpcheckupdate', [SupplyOfficeController::class, 'ovpcheckupdate']);
    Route::get('/sgocheckupdate', [SupplyOfficeController::class, 'sgocheckupdate']);
    Route::get('/sraccheckupdate', [SupplyOfficeController::class, 'sraccheckupdate']);
    Route::get('/hrdccheckupdate', [SupplyOfficeController::class, 'hrdccheckupdate']);
    Route::get('/supplycheckupdate', [SupplyOfficeController::class, 'supplycheckupdate']);
    Route::get('/financecheckupdate', [SupplyOfficeController::class, 'financecheckupdate']);
    Route::get('/presidentcheckupdate', [SupplyOfficeController::class, 'presidentcheckupdate']);
    Route::get('/baccheckupdate', [SupplyOfficeController::class, 'baccheckupdate']);

    Route::get('/approvedcsappmp', [SupplyOfficeController::class, 'approvedcsappmp']);
    Route::get('/approvedcasppmp', [SupplyOfficeController::class, 'approvedcasppmp']);
    Route::get('/approvedcbetppmp', [SupplyOfficeController::class, 'approvedcbetppmp']);
    Route::get('/approvedceatppmp', [SupplyOfficeController::class, 'approvedceatppmp']);
    Route::get('/approvedcedppmp', [SupplyOfficeController::class, 'approvedcedppmp']);
    Route::get('/approvedipeppmp', [SupplyOfficeController::class, 'approvedipeppmp']);
    Route::get('/approvedmicppmp', [SupplyOfficeController::class, 'approvedmicppmp']);
    Route::get('/approveddrrmoppmp', [SupplyOfficeController::class, 'approveddrrmoppmp']);
    Route::get('/approvedgcscppmp', [SupplyOfficeController::class, 'approvedgcscppmp']);
    Route::get('/approvedovpppmp', [SupplyOfficeController::class, 'approvedovpppmp']);
    Route::get('/approvedsgoppmp', [SupplyOfficeController::class, 'approvedsgoppmp']);
    Route::get('/approvedsracppmp', [SupplyOfficeController::class, 'approvedsracppmp']);
    Route::get('/approvedhrdcppmp', [SupplyOfficeController::class, 'approvedhrdcppmp']);
    Route::get('/approvedsupplyppmp', [SupplyOfficeController::class, 'approvedsupplyppmp']);
    Route::get('/approvedfinanceppmp', [SupplyOfficeController::class, 'approvedfinanceppmp']);
    Route::get('/approvedpresidentppmp', [SupplyOfficeController::class, 'approvedpresidentppmp']);
    Route::get('/approvedbacppmp', [SupplyOfficeController::class, 'approvedbacppmp']);

    Route::get('/sopreriv', [SupplyOfficeController::class, 'sopreriv']);

    Route::get('/prerivview', [SupplyOfficeController::class, 'prerivview']);

    Route::get('/prerivedit', [SupplyOfficeController::class, 'prerivedit']);

    Route::post('/editpreriv', [SupplyOfficeController::class, 'editpreriv']);

    /* FINANCE REQUESTOR */
    Route::get('/financedashboard', [FinanceRequestController::class, 'financedashboard']);

    Route::get('/financeproplan', [FinanceRequestController::class, 'financeproplan']);

    Route::get('/financerequest', [FinanceRequestController::class, 'requestlist']);

    Route::get('/financerequest2', [FinanceRequestController::class, 'requestlist2']);

    Route::get('/financedetails', [FinanceRequestController::class, 'financedetails']);

    Route::get('/financedetails2', [FinanceRequestController::class, 'financedetails2']);

    Route::get('/financerequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('finance staff/financerequestadd', ['notifications' => $notifications]);
    });

    Route::post('/financeaddrequest', [FinanceRequestController::class, 'financeaddrequest']);

    Route::get('/financerequestedit', [FinanceRequestController::class, 'financerequestedit']);

    Route::get('/financerequestview', [FinanceRequestController::class, 'financerequestview']);

    Route::get('/financeautocomplete', [FinanceRequestController::class, 'autocomplete'])->name('autocomplete');

    Route::post('/financeeditrequest', [FinanceRequestController::class, 'financeeditrequest']);

    Route::get('/financedeleterequest', [FinanceRequestController::class, 'financedeleterequest']);

    Route::get('/financetrash', [FinanceRequestController::class, 'financetrash']);
    Route::get('/financerestoreall', [FinanceRequestController::class, 'financerestoreall']);
    Route::get('/financeeraseall', [FinanceRequestController::class, 'financeeraseall']);
    Route::get('/financerestore', [FinanceRequestController::class, 'financerestore']);
    Route::get('/financeerase', [FinanceRequestController::class, 'financeerase']);

    /* FINANCE APPROVER */
    Route::get('/fodashboard', [FinanceController::class, 'fodashboard']);
    Route::get('/financeDashboard', [FinanceController::class, 'financeDashboard']);

    Route::get('foppmpcsa/', [FinanceController::class, 'csaproplan']);
    Route::get('/foppmpcas', [FinanceController::class, 'casproplan']);
    Route::get('/foppmpcbet', [FinanceController::class, 'cbetproplan']);
    Route::get('/foppmpceat', [FinanceController::class, 'ceatproplan']);
    Route::get('/foppmpced', [FinanceController::class, 'cedproplan']);
    Route::get('/foppmpipe', [FinanceController::class, 'ipeproplan']);
    Route::get('/foppmpmic', [FinanceController::class, 'micproplan']);
    Route::get('/foppmpdrrmo', [FinanceController::class, 'drrmoproplan']);
    Route::get('/foppmpgcsc', [FinanceController::class, 'gcscproplan']);
    Route::get('/foppmpovp', [FinanceController::class, 'ovpproplan']);
    Route::get('/foppmpsgo', [FinanceController::class, 'sgoproplan']);
    Route::get('/foppmpsrac', [FinanceController::class, 'sracproplan']);
    Route::get('/foppmphrdc', [FinanceController::class, 'hrdcproplan']);
    Route::get('/foppmpsupply', [FinanceController::class, 'supplyproplan']);
    Route::get('/foppmpfinance', [FinanceController::class, 'financeproplan']);
    Route::get('/foppmppresident', [FinanceController::class, 'presidentproplan']);
    Route::get('/foppmpbac', [FinanceController::class, 'bacproplan']);

    Route::get('/focaf', [FinanceController::class, 'focaf']);

    Route::get('/cafview', [FinanceController::class, 'cafview']);

    Route::get('/cafedit', [FinanceController::class, 'cafedit']);

    Route::post('/editcaf', [FinanceController::class, 'editcaf']);

    /* PRESIDENT REQUESTOR */
    Route::get('/presidentdashboard', [OfficePresRequestController::class, 'presidentdashboard']);

    Route::get('/presidentproplan', [OfficePresRequestController::class, 'presidentproplan']);

    Route::get('/presidentrequest', [OfficePresRequestController::class, 'requestlist']);

    Route::get('/presidentrequest2', [OfficePresRequestController::class, 'requestlist2']);

    Route::get('/presidentdetails', [OfficePresRequestController::class, 'presidentdetails']);

    Route::get('/presidentdetails2', [OfficePresRequestController::class, 'presidentdetails2']);

    Route::get('/presidentrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('president staff/presidentrequestadd', ['notifications' => $notifications]);
    });

    Route::post('/presidentaddrequest', [OfficePresRequestController::class, 'presidentaddrequest']);

    Route::get('/presidentrequestedit', [OfficePresRequestController::class, 'presidentrequestedit']);

    Route::get('/presidentrequestview', [OfficePresRequestController::class, 'presidentrequestview']);

    Route::get('/presidentautocomplete', [OfficePresRequestController::class, 'autocomplete'])->name('autocomplete');

    Route::post('/presidenteditrequest', [OfficePresRequestController::class, 'presidenteditrequest']);

    Route::get('/presidentdeleterequest', [OfficePresRequestController::class, 'presidentdeleterequest']);

    Route::get('/presidenttrash', [OfficePresRequestController::class, 'presidenttrash']);
    Route::get('/presidentrestoreall', [OfficePresRequestController::class, 'presidentrestoreall']);
    Route::get('/presidenteraseall', [OfficePresRequestController::class, 'presidenteraseall']);
    Route::get('/presidentrestore', [OfficePresRequestController::class, 'presidentrestore']);
    Route::get('/presidenterase', [OfficePresRequestController::class, 'presidenterase']);

    /* PRESIDENT APPROVER */
    Route::get('/opdashboard', [OfficePresController::class, 'opdashboard']);
    Route::get('/presidentDashboard', [OfficePresController::class, 'presidentDashboard']);

    Route::get('/opppmpcsa', [OfficePresController::class, 'csaproplan']);
    Route::get('/opppmpcas', [OfficePresController::class, 'casproplan']);
    Route::get('/opppmpcbet', [OfficePresController::class, 'cbetproplan']);
    Route::get('/opppmpceat', [OfficePresController::class, 'ceatproplan']);
    Route::get('/opppmpced', [OfficePresController::class, 'cedproplan']);
    Route::get('/opppmpipe', [OfficePresController::class, 'ipeproplan']);
    Route::get('/opppmpmic', [OfficePresController::class, 'micproplan']);
    Route::get('/opppmpdrrmo', [OfficePresController::class, 'drrmoproplan']);
    Route::get('/opppmpgcsc', [OfficePresController::class, 'gcscproplan']);
    Route::get('/opppmpovp', [OfficePresController::class, 'ovpproplan']);
    Route::get('/opppmpsgo', [OfficePresController::class, 'sgoproplan']);
    Route::get('/opppmpsrac', [OfficePresController::class, 'sracproplan']);
    Route::get('/opppmphrdc', [OfficePresController::class, 'hrdcproplan']);
    Route::get('/opppmpsupply', [OfficePresController::class, 'supplyproplan']);
    Route::get('/opppmpfinance', [OfficePresController::class, 'financeproplan']);
    Route::get('/opppmppresident', [OfficePresController::class, 'presidentproplan']);
    Route::get('/opppmpbac', [OfficePresController::class, 'bacproplan']);

    Route::get('/opindorsement', [OfficePresController::class, 'opindorsement']);

    Route::get('/opindorseview', [OfficePresController::class, 'opindorseview']);

    Route::get('/opindorseedit', [OfficePresController::class, 'opindorseedit']);

    Route::post('/opeditindorse', [OfficePresController::class, 'opeditindorse']);

    /* BAC */
    Route::get('/bacpage', function () {
        return view('bac/bacoffice');
    });

    /* BAC Goods & Services*/
    Route::get('/bacgoods', [BACGoodsController::class, 'bacgoods']);
    Route::get('/bacgoodsDashboard', [BACGoodsController::class, 'bacgoodsDashboard']);

    Route::get('/bacgsppmpcsa', [BACGoodsController::class, 'csaproplan']);
    Route::get('/bacgsppmpcas', [BACGoodsController::class, 'casproplan']);
    Route::get('/bacgsppmpcbet', [BACGoodsController::class, 'cbetproplan']);
    Route::get('/bacgsppmpceat', [BACGoodsController::class, 'ceatproplan']);
    Route::get('/bacgsppmpced', [BACGoodsController::class, 'cedproplan']);
    Route::get('/bacgsppmpipe', [BACGoodsController::class, 'ipeproplan']);
    Route::get('/bacppmpmic', [BACGoodsController::class, 'micproplan']);
    Route::get('/bacppmpdrrmo', [BACGoodsController::class, 'drrmoproplan']);
    Route::get('/bacppmpgcsc', [BACGoodsController::class, 'gcscproplan']);
    Route::get('/bacppmpovp', [BACGoodsController::class, 'ovpproplan']);
    Route::get('/bacppmpsgo', [BACGoodsController::class, 'sgoproplan']);
    Route::get('/bacppmpsrac', [BACGoodsController::class, 'sracproplan']);
    Route::get('/bacppmphrdc', [BACGoodsController::class, 'hrdcproplan']);
    Route::get('/bacppmpsupply', [BACGoodsController::class, 'supplyproplan']);
    Route::get('/bacppmpfinance', [BACGoodsController::class, 'financeproplan']);
    Route::get('/bacppmppresident', [BACGoodsController::class, 'presidentproplan']);
    Route::get('/bacppmpbac', [BACGoodsController::class, 'bacproplan']);

    Route::get('/svp', [BACGoodsController::class, 'svp']);
    Route::get('/svpedit', [BACGoodsController::class, 'svpedit']);
    Route::get('/svpview', [BACGoodsController::class, 'svpview']);
    Route::post('/svpupdate', [BACGoodsController::class, 'svpupdate']);

    Route::get('/shopping', [BACGoodsController::class, 'shopping']);
    Route::get('/shoppingedit', [BACGoodsController::class, 'shoppingedit']);
    Route::get('/shoppingview', [BACGoodsController::class, 'shoppingview']);
    Route::post('/shoppingupdate', [BACGoodsController::class, 'shoppingupdate']);

    Route::get('/canvas', [BACGoodsController::class, 'canvas']);
    Route::get('/canvasedit', [BACGoodsController::class, 'canvasedit']);
    Route::get('/canvasview', [BACGoodsController::class, 'canvasview']);
    Route::post('/canvasupdate', [BACGoodsController::class, 'canvasupdate']);

    Route::get('/bidding', [BACGoodsController::class, 'bidding']);
    Route::get('/biddingedit', [BACGoodsController::class, 'biddingedit']);
    Route::get('/biddingview', [BACGoodsController::class, 'biddingview']);
    Route::post('/biddingupdate', [BACGoodsController::class, 'biddingupdate']);

    /* BAC Infrastructure*/
    Route::get('/bacinfra', [BACInfraController::class, 'bacinfra']);
    Route::get('/bacinfraDashboard', [BACInfraController::class, 'bacinfraDashboard']);

    Route::get('/bacinfppmpcsa', [BACInfraController::class, 'csaproplan']);
    Route::get('/bacinfppmpcas', [BACInfraController::class, 'casproplan']);
    Route::get('/bacinfppmpcbet', [BACInfraController::class, 'cbetproplan']);
    Route::get('/bacinfppmpceat', [BACInfraController::class, 'ceatproplan']);
    Route::get('/bacinfppmpced', [BACInfraController::class, 'cedproplan']);
    Route::get('/bacinfppmpipe', [BACInfraController::class, 'ipeproplan']);
    Route::get('/bacinfppmpmic', [BACInfraController::class, 'micproplan']);
    Route::get('/bacinfppmpdrrmo', [BACInfraController::class, 'drrmoproplan']);
    Route::get('/bacinfppmpgcsc', [BACInfraController::class, 'gcscproplan']);
    Route::get('/bacinfppmpovp', [BACInfraController::class, 'ovpproplan']);
    Route::get('/bacinfppmpsgo', [BACInfraController::class, 'sgoproplan']);
    Route::get('/bacinfppmpsrac', [BACInfraController::class, 'sracproplan']);
    Route::get('/bacinfppmphrdc', [BACInfraController::class, 'hrdcproplan']);
    Route::get('/bacinfppmpsupply', [BACInfraController::class, 'supplyproplan']);
    Route::get('/bacinfppmpfinance', [BACInfraController::class, 'financeproplan']);
    Route::get('/bacinfppmppresident', [BACInfraController::class, 'presidentproplan']);
    Route::get('/bacinfppmpbac', [BACInfraController::class, 'bacproplan']);

    Route::get('/biddings', [BACInfraController::class, 'biddings']);
    Route::get('/biddingsedit', [BACInfraController::class, 'biddingsedit']);
    Route::get('/biddingsview', [BACInfraController::class, 'biddingsview']);
    Route::post('/biddingsupdate', [BACInfraController::class, 'biddingsupdate']);

    /* BAC REQUESTOR */
    Route::get('/bacdashboard', [BACController::class, 'bacdashboard']);

    Route::get('/bacproplan', [BACController::class, 'bacproplan']);

    Route::get('/bacrequest', [BACController::class, 'requestlist']);

    Route::get('/bacrequest2', [BACController::class, 'requestlist2']);

    Route::get('/bacdetails', [BACController::class, 'bacdetails']);

    Route::get('/bacdetails2', [BACController::class, 'bacdetails2']);

    Route::get('/bacrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('bac/bacrequestadd', ['notifications' => $notifications]);
    });

    Route::post('/bacaddrequest', [BACController::class, 'bacaddrequest']);

    Route::get('/bacrequestedit', [BACController::class, 'bacrequestedit']);

    Route::get('/bacrequestview', [BACController::class, 'bacrequestview']);

    Route::get('/bacautocomplete', [BACController::class, 'autocomplete'])->name('autocomplete');

    Route::post('/baceditrequest', [BACController::class, 'baceditrequest']);

    Route::get('/bacdeleterequest', [BACController::class, 'bacdeleterequest']);

    Route::get('/bactrash', [BACController::class, 'bactrash']);
    Route::get('/bacrestoreall', [BACController::class, 'bacrestoreall']);
    Route::get('/baceraseall', [BACController::class, 'baceraseall']);
    Route::get('/bacrestore', [BACController::class, 'bacrestore']);
    Route::get('/bacerase', [BACController::class, 'bacerase']);

    /* MIC */
    Route::get('/micdashboard', [MICController::class, 'mic']);
    Route::get('/micproplan', [MICController::class, 'micproplan']);
    Route::get('/micrequest', [MICController::class, 'requestlist']);
    Route::get('/micrequest2', [MICController::class, 'requestlist2']);
    Route::get('/micdetails', [MICController::class, 'micdetails']);
    Route::get('/micdetails2', [MICController::class, 'micdetails2']);
    Route::get('/micrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('mic/micrequestadd', ['notifications' => $notifications]);
    });
    Route::post('/micaddrequest', [MICController::class, 'micaddrequest']);
    Route::get('/micrequestedit', [MICController::class, 'micrequestedit']);
    Route::get('/micrequestview', [MICController::class, 'micrequestview']);
    Route::get('/micautocomplete', [MICController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/miceditrequest', [MICController::class, 'miceditrequest']);
    Route::get('/micdeleterequest', [MICController::class, 'deleterequest']);

    Route::get('/mictrash', [MICController::class, 'mictrash']);
    Route::get('/micrestoreall', [MICController::class, 'micrestoreall']);
    Route::get('/miceraseall', [MICController::class, 'miceraseall']);
    Route::get('/micrestore', [MICController::class, 'micrestore']);
    Route::get('/micerase', [MICController::class, 'micerase']);

    /* DRRMO */
    Route::get('/drrmodashboard', [DRRMOController::class, 'drrmo']);
    Route::get('/drrmoproplan', [DRRMOController::class, 'drrmoproplan']);
    Route::get('/drrmorequest', [DRRMOController::class, 'requestlist']);
    Route::get('/drrmorequest2', [DRRMOController::class, 'requestlist2']);
    Route::get('/drrmodetails', [DRRMOController::class, 'drrmodetails']);
    Route::get('/drrmodetails2', [DRRMOController::class, 'drrmodetails2']);
    Route::get('/drrmorequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('drrmo/drrmorequestadd', ['notifications' => $notifications]);
    });
    Route::post('/drrmoaddrequest', [DRRMOController::class, 'drrmoaddrequest']);
    Route::get('/drrmorequestedit', [DRRMOController::class, 'drrmorequestedit']);
    Route::get('/drrmorequestview', [DRRMOController::class, 'drrmorequestview']);
    Route::get('/drrmoautocomplete', [DRRMOController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/drrmoeditrequest', [DRRMOController::class, 'drrmoeditrequest']);
    Route::get('/drrmodeleterequest', [DRRMOController::class, 'deleterequest']);

    Route::get('/drrmotrash', [DRRMOController::class, 'drrmotrash']);
    Route::get('/drrmorestoreall', [DRRMOController::class, 'drrmorestoreall']);
    Route::get('/drrmoeraseall', [DRRMOController::class, 'drrmoeraseall']);
    Route::get('/drrmorestore', [DRRMOController::class, 'drrmorestore']);
    Route::get('/drrmoerase', [DRRMOController::class, 'drrmoerase']);

    /* GCSC */
    Route::get('/gcscdashboard', [GCSCController::class, 'gcsc']);
    Route::get('/gcscproplan', [GCSCController::class, 'gcscproplan']);
    Route::get('/gcscrequest', [GCSCController::class, 'requestlist']);
    Route::get('/gcscrequest2', [GCSCController::class, 'requestlist2']);
    Route::get('/gcscdetails', [GCSCController::class, 'gcscdetails']);
    Route::get('/gcscdetails2', [GCSCController::class, 'gcscdetails2']);
    Route::get('/gcscrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('gcsc/gcscrequestadd', ['notifications' => $notifications]);
    });
    Route::post('/gcscaddrequest', [GCSCController::class, 'gcscaddrequest']);
    Route::get('/gcscrequestedit', [GCSCController::class, 'gcscrequestedit']);
    Route::get('/gcscrequestview', [GCSCController::class, 'gcscrequestview']);
    Route::get('/gcscautocomplete', [GCSCController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/gcsceditrequest', [GCSCController::class, 'gcsceditrequest']);
    Route::get('/gcscdeleterequest', [GCSCController::class, 'deleterequest']);

    Route::get('/gcsctrash', [GCSCController::class, 'gcsctrash']);
    Route::get('/gcscrestoreall', [GCSCController::class, 'gcscrestoreall']);
    Route::get('/gcsceraseall', [GCSCController::class, 'gcsceraseall']);
    Route::get('/gcscrestore', [GCSCController::class, 'gcscrestore']);
    Route::get('/gcscerase', [GCSCController::class, 'gcscerase']);

    /* OVP */
    Route::get('/ovpdashboard', [OVPController::class, 'ovp']);
    Route::get('/ovpproplan', [OVPController::class, 'ovpproplan']);
    Route::get('/ovprequest', [OVPController::class, 'requestlist']);
    Route::get('/ovprequest2', [OVPController::class, 'requestlist2']);
    Route::get('/ovpdetails', [OVPController::class, 'ovpdetails']);
    Route::get('/ovpdetails2', [OVPController::class, 'ovpdetails2']);
    Route::get('/ovprequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('ovp/ovprequestadd', ['notifications' => $notifications]);
    });
    Route::post('/ovpaddrequest', [OVPController::class, 'ovpaddrequest']);
    Route::get('/ovprequestedit', [OVPController::class, 'ovprequestedit']);
    Route::get('/ovprequestview', [OVPController::class, 'ovprequestview']);
    Route::get('/ovpautocomplete', [OVPController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/ovpeditrequest', [OVPController::class, 'ovpeditrequest']);
    Route::get('/ovpdeleterequest', [OVPController::class, 'deleterequest']);

    Route::get('/ovptrash', [OVPController::class, 'ovptrash']);
    Route::get('/ovprestoreall', [OVPController::class, 'ovprestoreall']);
    Route::get('/ovperaseall', [OVPController::class, 'ovperaseall']);
    Route::get('/ovprestore', [OVPController::class, 'ovprestore']);
    Route::get('/ovperase', [OVPController::class, 'ovperase']);

    /* SGO */
    Route::get('/sgodashboard', [SGOController::class, 'sgo']);
    Route::get('/sgoproplan', [SGOController::class, 'sgoproplan']);
    Route::get('/sgorequest', [SGOController::class, 'requestlist']);
    Route::get('/sgorequest2', [SGOController::class, 'requestlist2']);
    Route::get('/sgodetails', [SGOController::class, 'sgodetails']);
    Route::get('/sgodetails2', [SGOController::class, 'sgodetails2']);
    Route::get('/sgorequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('sgo/sgorequestadd', ['notifications' => $notifications]);
    });
    Route::post('/sgoaddrequest', [SGOController::class, 'sgoaddrequest']);
    Route::get('/sgorequestedit', [SGOController::class, 'sgorequestedit']);
    Route::get('/sgorequestview', [SGOController::class, 'sgorequestview']);
    Route::get('/sgoautocomplete', [SGOController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/sgoeditrequest', [SGOController::class, 'sgoeditrequest']);
    Route::get('/sgodeleterequest', [SGOController::class, 'deleterequest']);

    Route::get('/sgotrash', [SGOController::class, 'sgotrash']);
    Route::get('/sgorestoreall', [SGOController::class, 'sgorestoreall']);
    Route::get('/sgoeraseall', [SGOController::class, 'sgoeraseall']);
    Route::get('/sgorestore', [SGOController::class, 'sgorestore']);
    Route::get('/sgoerase', [SGOController::class, 'sgoerase']);

    /* SRAC */
    Route::get('/sracdashboard', [SRACController::class, 'srac']);
    Route::get('/sracproplan', [SRACController::class, 'sracproplan']);
    Route::get('/sracrequest', [SRACController::class, 'requestlist']);
    Route::get('/sracrequest2', [SRACController::class, 'requestlist2']);
    Route::get('/sracdetails', [SRACController::class, 'sracdetails']);
    Route::get('/sracdetails2', [SRACController::class, 'sracdetails2']);
    Route::get('/sracrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('srac/sracrequestadd', ['notifications' => $notifications]);
    });
    Route::post('/sracaddrequest', [SRACController::class, 'sracaddrequest']);
    Route::get('/sracrequestedit', [SRACController::class, 'sracrequestedit']);
    Route::get('/sracrequestview', [SRACController::class, 'sracrequestview']);
    Route::get('/sracautocomplete', [SRACController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/sraceditrequest', [SRACController::class, 'sraceditrequest']);
    Route::get('/sracdeleterequest', [SRACController::class, 'deleterequest']);

    Route::get('/sractrash', [SRACController::class, 'sractrash']);
    Route::get('/sracrestoreall', [SRACController::class, 'sracrestoreall']);
    Route::get('/sraceraseall', [SRACController::class, 'sraceraseall']);
    Route::get('/sracrestore', [SRACController::class, 'sracrestore']);
    Route::get('/sracerase', [SRACController::class, 'sracerase']);

    /* HRDC */
    Route::get('/hrdcdashboard', [HRDCController::class, 'hrdc']);
    Route::get('/hrdcproplan', [HRDCController::class, 'hrdcproplan']);
    Route::get('/hrdcrequest', [HRDCController::class, 'requestlist']);
    Route::get('/hrdcrequest2', [HRDCController::class, 'requestlist2']);
    Route::get('/hrdcdetails', [HRDCController::class, 'hrdcdetails']);
    Route::get('/hrdcdetails2', [HRDCController::class, 'hrdcdetails2']);
    Route::get('/hrdcrequestadd', function () {
        $usersession = Session::get('user');
        $user = AdminModel::find($usersession);
        $notifications = $user->unreadNotifications;
        return view('hrdc/hrdcrequestadd', ['notifications' => $notifications]);
    });
    Route::post('/hrdcaddrequest', [HRDCController::class, 'hrdcaddrequest']);
    Route::get('/hrdcrequestedit', [HRDCController::class, 'hrdcrequestedit']);
    Route::get('/hrdcrequestview', [HRDCController::class, 'hrdcrequestview']);
    Route::get('/hrdcautocomplete', [HRDCController::class, 'autocomplete'])->name('autocomplete');
    Route::post('/hrdceditrequest', [HRDCController::class, 'hrdceditrequest']);
    Route::get('/hrdcdeleterequest', [HRDCController::class, 'deleterequest']);

    Route::get('/hrdctrash', [HRDCController::class, 'hrdctrash']);
    Route::get('/hrdcrestoreall', [HRDCController::class, 'hrdcrestoreall']);
    Route::get('/hrdceraseall', [HRDCController::class, 'hrdceraseall']);
    Route::get('/hrdcrestore', [HRDCController::class, 'hrdcrestore']);
    Route::get('/hrdcerase', [HRDCController::class, 'hrdcerase']);

});
