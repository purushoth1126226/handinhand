<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\Master\DrugController;
use App\Http\Controllers\Admin\Doctor\DoctorController;
use App\Http\Controllers\Admin\Patient\VitalController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Admin\Settings\RoleController;
use App\Http\Controllers\Admin\Master\AllergyController;
use App\Http\Controllers\Admin\Master\IllnessController;
use App\Http\Controllers\Admin\Master\VillageController;
use App\Http\Controllers\Admin\Master\DiagnosisController;
use App\Http\Controllers\Admin\Druginward\InwardController;
use App\Http\Controllers\Admin\Pharmacy\PharmacyController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Patient\EnrollmentController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Druginward\SupplierController;
use App\Http\Controllers\Admin\Settings\AddemployeeController;
use App\Http\Controllers\Admin\Laboratory\LaboratoryController;
use App\Http\Controllers\Admin\Report\DrugalertreportController;
use App\Http\Controllers\Admin\Settings\ConfigurationController;
use App\Http\Controllers\Admin\Master\LabinvestigationController;
use App\Http\Controllers\Admin\Report\DrugexpiryreportController;
use App\Http\Controllers\Admin\Report\InwarditemreportController;
use App\Http\Controllers\Admin\Druginward\PharmacystockController;
use App\Http\Controllers\Admin\Patient\EnrollmentHistoryController;
use App\Http\Controllers\Admin\Report\PharmacystockreportController;
use App\Http\Controllers\Admin\Officeutility\EventcalendarController;
use App\Http\Controllers\Admin\Master\PhysicalandgeneralexaminationController;
use App\Http\Controllers\Admin\Configuration\Google2fa\PasswordSecurityController;

Auth::routes();

Route::post('/2faVerify', function () {
    return redirect(URL()->previous());
})->name('2faVerify')->middleware('2fa');

Route::get('admin/sidenavupdates', function () {
    session()->put('sidenavstatus', !session()->get('sidenavstatus'));
})->name('sidenavupdates');

Route::get('decompose', '\Lubusin\Decomposer\Controllers\DecomposerController@index')->name('decompose')->middleware('auth', 'preventbackbutton');
// '2fa',
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'preventbackbutton', 'language'], 'prefix' => 'admin'], function () {
    // Dashboard
    Route::get('/admindashboard', [DashboardController::class, 'dashboard'])->name('admindashboard');
    Route::get('/loginlogs', [DashboardController::class, 'loginlogs'])->name('loginlogs');
    Route::get('/trackinglogs', [DashboardController::class, 'trackinglogs'])->name('trackinglogs');


    Route::resources([
        'configuration' => ConfigurationController::class,
        'addemployee' => AddemployeeController::class,
        'eventcalendar' => EventcalendarController::class,
        // Master
        'allergy' => AllergyController::class,
        'diagnosis' => DiagnosisController::class,
        'labinvestigation' => LabinvestigationController::class,
        'drug' => DrugController::class,
        'physicalandgeneralexamination' => PhysicalandgeneralexaminationController::class,
        'village' => VillageController::class,
        'illness' => IllnessController::class,

        // Patients
        'enrollment' => EnrollmentController::class,
        'vital' => VitalController::class,

        //role
        'role' => RoleController::class,

        //Druginward

        'supplier' => SupplierController::class,
        'inward' => InwardController::class,

    ]);

    Route::post('switchlanguage', [AddemployeeController::class, 'switchlanguage'])->name('switchlanguage');

    Route::get('ajaxvitalsmultiselectvital', [VitalController::class, 'ajaxvitalsmultiselectvital'])->name('ajaxvitalsmultiselectvital');
    Route::get('ajaxvitalsmultiselectdoctor', [VitalController::class, 'ajaxvitalsmultiselectdoctor'])->name('ajaxvitalsmultiselectdoctor');

    //pharmacy stock

    Route::get('pharmacystock', [PharmacystockController::class, 'pharmacystock'])->name('pharmacystock');

    //drugs

    Route::get('ajaxdrugsmultiselect', [DrugController::class, 'ajaxdrugsmultiselect'])->name('ajaxdrugsmultiselect');

    //enrollment token
    Route::get('token/{id}', [EnrollmentController::class, 'token'])->name('token');
    //search
    Route::post('patientsearch', [EnrollmentController::class, 'patientsearch'])->name('patientsearch.fetch');
    Route::post('inwardsearch', [InwardController::class, 'inwardsearch'])->name('inwardsearch.fetch');
    //enrollment history
    Route::get('enrollmenthistory', [EnrollmentHistoryController::class, 'enrollmenthistory'])->name('enrollmenthistory.index');
    Route::get('enrollmenthistory/{id}', [EnrollmentHistoryController::class, 'show'])->name('enrollmenthistory.show');
    //doctor
    Route::get('ajaxdrug', [DoctorController::class, 'ajaxdrug'])->name('ajaxdrug');
    Route::get('doctor/patientlist', [DoctorController::class, 'patientlist'])->name('patientlist.index');
    Route::get('doctor/patientlistshow/{vital}', [DoctorController::class, 'patientlistshow'])->name('doctor.patientlistshow');
    Route::post('doctor/patientstore', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('doctor/patientprescriptionform/{vital}', [DoctorController::class, 'patientprescriptionform'])->name('patientprescriptionform');

    Route::get('doctor/patienthistory', [DoctorController::class, 'patienthistory'])->name('patienthistory.index');
    Route::get('doctor/patienthistoryshow/{vital}', [DoctorController::class, 'patienthistoryshow'])->name('patienthistoryshow');
    Route::get('doctor/patienthistory/{id}', [DoctorController::class, 'patienthistoryshow'])->name('doctor.patienthistoryshow');
    Route::post('doctor/patientprescriptionform/searchdruglist', [DoctorController::class, 'searchdruglist'])->name('doctor.searchdruglist');

    //laboratory
    Route::get('laboratory/patientlist', [LaboratoryController::class, 'patientlist'])->name('labpatientlist.index');
    Route::get('laboratory/labarotaryshow/{vital}', [LaboratoryController::class, 'labarotaryshow'])->name('labarotaryshow');
    Route::get('laboratory/labarotaryentry/{vital}', [LaboratoryController::class, 'labarotaryentry'])->name('labarotaryentry');
    Route::post('laboratory/patientstore', [LaboratoryController::class, 'store'])->name('laboratory.store');

    Route::get('laboratory/patienthistory', [LaboratoryController::class, 'patienthistory'])->name('labpatienthistory.index');
    Route::get('laboratory/patienthistoryshow/{vital}', [LaboratoryController::class, 'patienthistoryshow'])->name('laboratory.patienthistoryshow');

    //pharmacy
    Route::get('pharmacy/patientlist', [PharmacyController::class, 'patientlist'])->name('pharmacypatientlist.index');
    Route::get('pharmacy/pharmacyshow/{vital}', [PharmacyController::class, 'pharmacyshow'])->name('pharmacy.pharmacyshow');
    Route::get('pharmacy/pharmacyentry/{vital}', [PharmacyController::class, 'pharmacyentry'])->name('pharmacy.pharmacyentry');
    Route::post('pharmacy/patientstore', [PharmacyController::class, 'store'])->name('pharmacy.store');
    Route::get('pharmacy/patienthistory', [PharmacyController::class, 'patienthistory'])->name('pharmacypatienthistory.index');
    Route::get('pharmacy/pharmacyhistoryshow/{vital}', [PharmacyController::class, 'pharmacyhistoryshow'])->name('pharmacy.pharmacyhistoryshow');

    //report

    //enrollment
    Route::get('enrollmentreport', [ReportController::class, 'enrollmentreport'])->name('enrollmentreport.index');
    Route::get('enrollmentreportshow/{vital}', [ReportController::class, 'enrollmentreportshow'])->name('report.enrollmentreportshow');
    Route::post('ajaxenrollmentreport', [ReportController::class, 'ajaxenrollmentreport'])->name('report.ajaxenrollmentreport');

    //vital
    Route::get('vitalreport', [ReportController::class, 'vitalreport'])->name('vitalreport.index');
    Route::get('vitalreportshow/{vital}', [ReportController::class, 'vitalreportshow'])->name('report.vitalreportshow');
    Route::post('ajaxvitalreport', [ReportController::class, 'ajaxvitalreport'])->name('report.ajaxvitalreport');

    //diagnosis
    Route::get('diagnosisreport', [ReportController::class, 'diagnosisreport'])->name('diagnosisreport.index');
    Route::get('diagnosisreportshow/{vital}', [ReportController::class, 'diagnosisreportshow'])->name('report.diagnosisreportshow');
    Route::post('ajaxdiagnosisreport', [ReportController::class, 'ajaxdiagnosisreport'])->name('report.ajaxdiagnosisreport');


    Route::get('labreport', [ReportController::class, 'labreport'])->name('labreport.index');
    Route::get('labreportshow/{vital}', [ReportController::class, 'labreportshow'])->name('report.labreportshow');
    Route::post('ajaxlabreport', [ReportController::class, 'ajaxlabreport'])->name('report.ajaxlabreport');

    //Drug expiry report

    Route::get('drugexpiryreport', [DrugexpiryreportController::class, 'drugexpiryreport'])->name('drugexpiryreport.index');
    Route::post('ajaxdrugexpiryreport', [DrugexpiryreportController::class, 'ajaxdrugexpiryreport'])->name('report.ajaxdrugexpiryreport');

    

     //Drug alert report

     Route::get('drugalertreport', [DrugalertreportController::class, 'drugalertreport'])->name('drugalertreport.index');
     Route::post('ajaxdrugalertreport', [DrugalertreportController::class, 'ajaxdrugalertreport'])->name('report.ajaxdrugalertreport');

      //Pharmacy stock report

      Route::get('pharmacystockreport', [PharmacystockreportController::class, 'pharmacystockreport'])->name('pharmacystockreport.index');
     
      Route::post('ajaxpharmacystockreport', [PharmacystockreportController::class, 'ajaxpharmacystockreport'])->name('report.ajaxpharmacystockreport');


      //inwarditem stock report

      Route::get('inwarditemreport', [InwarditemreportController::class, 'inwarditemreport'])->name('inwarditemreport.index');
     
      Route::post('ajaxinwarditemreport', [InwarditemreportController::class, 'ajaxinwarditemreport'])->name('report.ajaxinwarditemreport');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    // System Info
    Route::get('/systeminfo', [SettingsController::class, 'systeminfo'])->name('systeminfo');
    Route::get('/cacheclear', [SettingsController::class, 'cacheclear'])->name('cacheclear');

    // Add Employee //
    Route::get('/ajaxaddemployee', [AddemployeeController::class, 'ajaxaddemployee'])->name('ajaxaddemployee');
    Route::get('/profile', [AddemployeeController::class, 'profile'])->name('profile');
    Route::get('/changepasswordform', [AddemployeeController::class, 'changepasswordform'])->name('changepasswordform');
    Route::post('/changepassword', [AddemployeeController::class, 'changepassword'])->name('changepassword');

    Route::get('/2fa', [PasswordSecurityController::class, 'show2faForm'])->name('2fa');
    Route::post('/generate2faSecret', [PasswordSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
    Route::post('/2fa', [PasswordSecurityController::class, 'enable2fa'])->name('enable2fa');
    Route::post('/disable2fa', [PasswordSecurityController::class, 'disable2fa'])->name('disable2fa');
});
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('enrollmentreportcsv/{start?}/{end?}', [ReportController::class, 'enrollmentreportcsv'])->name('report.enrollmentreportcsv');
    Route::get('vitalreportcsv/{start?}/{end?}', [ReportController::class, 'vitalreportcsv'])->name('report.vitalreportcsv');
    Route::get('diagnosisreportcsv/{start?}/{end?}/{diagnosis_id?}', [ReportController::class, 'diagnosisreportcsv'])->name('report.diagnosisreportcsv');
    Route::get('labreportcsv/{start?}/{end?}/{labinvestigation_id?}', [ReportController::class, 'labreportcsv'])->name('report.labreportcsv');
    Route::get('drugexpiryreportcsv/{start?}/{end?}', [DrugexpiryreportController::class, 'drugexpiryreportcsv'])->name('report.drugexpiryreportcsv');
    Route::get('drugalertreportcsv/{start?}/{end?}', [DrugalertreportController::class, 'drugalertreportcsv'])->name('report.drugalertreportcsv');
    Route::get('pharmacystockreportcsv/{start?}/{end?}', [PharmacystockreportController::class, 'pharmacystockreportcsv'])->name('report.pharmacystockreportcsv');
    Route::get('inwarditemreportcsv/{start?}/{end?}', [InwarditemreportController::class, 'inwarditemreportcsv'])->name('report.inwarditemreportcsv');
});
