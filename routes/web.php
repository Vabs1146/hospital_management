<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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
//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/optimize-cache', function() {
    $exitCode = Artisan::call('optimize --force');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-clr', function() {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Clear Route cache:
Route::get('/optimize-clear', function() {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>Route cache cleared</h1>';
});
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>View cache cleared</h1>';
});

Route::get('/Migrate', function() {
    $exitCode = Artisan::call('migrate',
 array(
   '--path' => 'database/migrations',
   '--database' => 'elixireyeclinic_db',
   '--force' => true));
    return '<h1>Migration done</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

//Clear  cache:
Route::get('/cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});

Route::get('/phpinfo', function () {
    return view('phpInfoFile');
});

Route::get('/sample', function () {
    return view('sample');
});
Route::get('wizard', function () {
    return view('dynamic_field');
});
Route::get('final', function () {
    return view('finaladd');
});
Route::get('finalp', function () {
    return view('finalpage');
});



Route::get('/seo/add','seoMasterController@create');
Route::get('/seo/list','seoMasterController@seolist');
Route::get('/seo','seoMasterController@seolist');
Route::get('/seo/edit/{seo_id}', 'seoMasterController@edit');
Route::post('/seo/grid', 'seoMasterController@grid');
Route::post('/seo/SaveSeo','seoMasterController@SaveSeo');
Route::post('/seo/EditSeo','seoMasterController@EditSeo');
Route::get('/appointment/grid/{MorningEvening}/{id}','AppointmentController@grid');
Route::get('/followpappointment/grid/{MorningEvening}/{id}','AppointmentController@grid1');

//Route::get('/appointments/{id}','AppointmentController@index');
//Route::Post('/store', 'AppointmentController@store')->name('apt.store');

Route::resource('/appointment','AppointmentController');
Route::resource('/appointment1','AppointmentController');

Route::get('/followupshow/{AppointmentId}','AppointmentController@show2');
Route::get('/CreateApp/{appDate}','AppointmentController@OlCreateApp');
Route::get('/appointmentlist/{id}','AppointmentController@listAppointment');

Route::get('/appointment/{appointmentid}','AppointmentController@show');
Route::get('/edit-appointment/{appointmentid}','AppointmentController@edit');
Route::post('/update-appointment','AppointmentController@update');

Route::get('/followupacceptdenyappointment/{appointmentid}','AppointmentController@followupshow');

Route::post('/appointment/{appointmentid}/AcceptDeny','AppointmentController@acceptdeny_post');

Route::post('/followupappointment/{appointmentid}/AcceptDeny','AppointmentController@followupacceptdeny_post');

Route::get('events', 'EventController@index');

Route::get('/AddUpdateTimeSlot','AppointmentController@AddUpdateTimeSlotIndex');
Route::post('/AddUpdateTimeSlot/grid','AppointmentController@AddUpdateTimeSlotgrid');
Route::get('/AddUpdateTimeSlot/Edit/{id}','AppointmentController@EditTimeSlot');
Route::Post('/AddUpdateTimeSlot/AddUpdate/{id}','AppointmentController@AddUpdateTimeSlot');

Route::get('/AddRating','RatingController@AddRating');
Route::post('/AddRating/Submit','RatingController@SubmitRating');
Route::post('/rating/grid','RatingController@grid');
Route::get('/rating/list','RatingController@ratingList');
Route::get('/ApproveRejectRating/{RatingId}','RatingController@ApproveReject');
Route::post('/ApproveRejectRating','RatingController@SubmitApproveReject');
Route::post('/dischargedeleteField', 'dischargeController@dischargedeleteField');
Route::post('/adddischargeAppointment', 'dischargeController@adddischargeAppointment');
Route::post('/deleteAppointment', 'dischargeController@deleteAppointment');
//Discharge

Route::get('GetCaseIdByPatientNameMobile', 'patientDetailsController@GetCaseIdByPatientNameMobile');

Route::get('/aptpatientDetails1/{appointmentid}', 'patientDetailsController@AptPatient_Kyc');

Route::get('/AddPatient_Details/{appointmentid}', 'patientDetailsController@AddPatient_Details');
Route::get('/add-ipd-patient/{appointmentid}', 'patientDetailsController@add_ipd_patient_details');

Route::get('/aptpatientDetails/{appointmentid}', 'patientDetailsController@Patient_Kyc');

Route::get('/followuppatientDetails/{appointmentid}', 'patientDetailsController@Patient_Kyc1');

Route::get('/editPatientDetials/{case_id}', 'patientDetailsController@Show_Kyc');
Route::Post('/patientDetails/SaveKYC', 'patientDetailsController@SaveKYC');
Route::Post('/patientDetails/SaveKYCWhatsapp', 'patientDetailsController@SaveKYCWhatsapp');
Route::Post('/patientDetails/SendEmailSave', 'EyeFormController@SendEmailSave')->name('eyeDetails.sendemail');
Route::Post('/patientDetails/EditKYC', 'patientDetailsController@EditKYC');
Route::Post('/patientDetails/SaveCaseHistory', 'patientDetailsController@SaveCaseHistory');
Route::get('/PatientMedicalDetails/{case_id}', 'patientDetailsController@PatientMedicalDetails');
Route::get('/ViewMedicalDetails/{case_id}', 'patientDetailsController@viewPatientMedicalDetails');
Route::get('/PrintMedicalDetails/{case_id}', 'patientDetailsController@printPatientMedicalDetails');


Route::Post('/patientDetails/SaveAnxiousCaseHistory', 'patientDetailsController@SaveAnxiousCaseHistory');

Route::get('/downloadpdf/{case_id}', 'patientDetailsController@downloadpdf');



Route::get('/caseHistoryAutocomplete', 'patientDetailsController@autocompleteList');
Route::get('/genericAutocomplete', 'patientDetailsController@genericAutocompleteList');

//Eye Form
Route::Post('/patientDetails/SaveEyeExamination', 'EyeFormController@SaveCaseHistory')->name('eyeDetails.save');
Route::Post('/patientDetails/SaveEyeExamination1', 'EyeFormController@SaveCaseHistory1')->name('eyeDetails.save1');
Route::Post('/patientDetails/SaveEyeExamination2', 'EyeFormController@SaveCaseHistory2')->name('eyeDetails.save2');
Route::get('/patientDetails/scanPrint/{case_id}', 'EyeFormController@scanPrint');

Route::Post('/patientDetails/saveFundusImages', 'EyeFormController@saveFundusImages')->name('eyeDetails.saveFundusImages');
Route::Post('/patientDetails/saveFundusImagesView', 'EyeFormController@saveFundusImagesView')->name('eyeDetails.saveFundusImagesView');
Route::get('/get_fundus_images', 'EyeFormController@get_fundus_images')->name('eyeDetails.get_fundus_images');
Route::Post('/upload_fundus_image', 'EyeFormController@upload_fundus_image')->name('eyeDetails.upload_fundus_image');
Route::Post('/remove_fundus_image', 'EyeFormController@remove_fundus_image')->name('eyeDetails.remove_fundus_image');

Route::get('/fundusImage/{case_id}', 'EyeFormController@getfundusImage')->name('eyeDetails.getFundusImage');
Route::get('/AddEditEyeDetails/setNormal/{case_id}', 'EyeFormController@SetNormalValues')->name('eyeDetails.setNormalValues');
Route::Post('/fundusImage', 'EyeFormController@SavefundusImage')->name('eyeDetails.SavefundusImage');
Route::Post('/eyeform/deleteImage', 'EyeFormController@deleteImage')->name('image.delete');
Route::get('/AddEditEyeDetails/{case_id}/{step?}', 'EyeFormController@AddEditEyeDetails')->name('eyeDetails.addEdit');
Route::get('/AddEditEyeDetailsold/{case_id}', 'EyeFormController@AddEditEyeDetailsold')->name('eyeDetails.addEditold');
Route::get('/ViewEyeDetails/{case_id}', 'EyeFormController@ViewEyeDetails')->name('eyeDetails.view');
Route::get('/PrintEyeDetails/{case_id}', 'EyeFormController@PrintEyeDetails')->name('eyeDetails.print');
Route::get('/PrintEyeOtherDetails/{case_id}', 'EyeFormController@PrintEyeOtherDetails')->name('eyeOtherDetails.print');
Route::get('/PrintFixSurgery/{case_id}', 'EyeFormController@PrintFixSurgery')->name('fixsurgery.print');
Route::get('/ViewEyeReportFiles/{case_id}', 'EyeFormController@ViewEyeReportFiles')->name('eyeDetails.viewReportFiles');
Route::get('/printEyeReportFiles/{file_id}', 'EyeFormController@printEyeReportFiles')->name('eyeDetails.printReportFiles');
Route::delete('/eyeform/deleteMultiEntry/{Id}','EyeFormController@deleteMultiEntry')->name('eyeForm.deleteMultiEntryField');
//Eye Form

//Skin Form
Route::get('/Skin/{case_id}', 'SkinController@edit')->name('skin.addUpdate');
Route::post('/Skin/{case_id}', 'SkinController@update')->name('skin.Createupdate');
Route::put('/Skin/{case_id}', 'SkinController@update')->name('skin.Createupdate');
Route::patch('/Skin/{case_id}', 'SkinController@update')->name('skin.Createupdate');
Route::delete('/skinmultiselect/{id}', 'SkinController@deletemultiselect')->name('skinmultiselect.delete');
Route::Post('/skinBeforeAfterimage/delete', 'SkinController@deleteImage')->name('skinBeforeAfterimage.delete');
Route::get('/ViewSkinReportFiles/{case_id}', 'SkinController@ViewSkinReportFiles')->name('Skin.viewReportFiles');
Route::get('/skin/print/{case_id}', 'SkinController@print')->name('skin.print');
Route::get('/skin/view/{case_id}', 'SkinController@view')->name('skin.view');
//Skin Form

//writing casepaper
Route::get('writingCasePaper', 'writingCasepaperController@index')->name('writingCasePaper');

Route::get('/writingCasePaper/{case_id}/edit', 'writingCasepaperController@AddEditDetails')->name('writingCasePaper.addEdit');
Route::get('/writingCasePaper/print/{case_id}', 'writingCasepaperController@print')->name('writingCasePaper.print');
Route::get('/writingCasePaper/view/{case_id}', 'writingCasepaperController@view')->name('writingCasePaper.view');
Route::get('/writingCasePaper', 'writingCasepaperController@index')->name('writingCasePaper.index');
Route::post('/writingCasePaper/{writingCase_id}', 'writingCasepaperController@SaveDetails')->name('writingCasePaper.save');
Route::put('/writingCasePaper/{writingCase_id}', 'writingCasepaperController@SaveDetails')->name('writingCasePaper.save');
Route::patch('/writingCasePaper/{writingCase_id}', 'writingCasepaperController@SaveDetails')->name('writingCasePaper.save');
//writing casepaper

//Glass Priscription
Route::resource('/glassPrescription', 'glassPrescriptionController',array(
    'only' => array('index','edit','update')
));
Route::get('/glassPrescription/print/{case_id}', 'glassPrescriptionController@printbill')->name('glassPrescription.print');
Route::Post('/glassPrescription/deleteImage', 'glassPrescriptionController@deleteImage')->name('image.delete');
Route::get('glassPrescription','glassPrescriptionController@index')->name('glassPrescription.save');
//Glass Priscription

//dynamic controller
Route::get('/dynamicForm/print/{form_id}/{registration_id}', 'dynamicFormController@print')->name('dynamicForm.print');
Route::get('/dynamicForm/view/{form_id}/{registration_id}', 'dynamicFormController@view')->name('dynamicForm.view');
Route::get('/dynamicForm/{form_id}', 'dynamicFormController@index')->name('dynamicForm.index');
Route::get('/dynamicForm/{form_id}/{registration_id}/edit/{OpdIpd?}', 'dynamicFormController@edit')->name('dynamicForm.edit');
Route::match(array('PUT', 'PATCH', 'POST'), "/dynamicForm/{form_id}/{registration_id}/{OpdIpd?}", array(
    'uses' => 'dynamicFormController@update',
    'as' => 'dynamicForm.update'
));
Route::Post('/dynamicForm/deleteImage/{imageId}', 'dynamicFormController@deleteImage')->name('image.deleteImage');
//dynamic controller

//daily Treatment Controller
Route::match(array('PUT', 'PATCH', 'POST'), "/AddEdit/dailyNotes/{patient_id}", array(
    'uses' => 'IPD\dailyTreatmentDetailsController@Add',
    'as' => 'dailyTreatment.Add'
));
Route::Post('/delete/dailyNotes/{note_id}', 'IPD\dailyTreatmentDetailsController@deleteNote')->name('DailyNotes.Delete');
//daily Treatment Controller

//formFieldMaster
Route::get('/formFieldMaster', 'formFieldMasterController@index')->name('formFieldMaster.index');
Route::get('/formFieldMaster/{field_id}/edit', 'formFieldMasterController@edit')->name('formFieldMaster.edit');
Route::post('/formFieldMaster/grid', 'formFieldMasterController@grid');
Route::get('/formFieldMaster/addField/{field_id}', 'formFieldMasterController@addfield');
Route::match(array('PUT', 'PATCH', 'POST'), "/formFieldMaster/StoreField/{field_id}", array(
    'uses' => 'formFieldMasterController@Storefield',
    'as' => 'formFieldMaster.StoreField'
));
Route::get('/formFieldMaster/EditMapping/{field_id}', 'formFieldMasterController@editMapping');
Route::match(array('PUT', 'PATCH', 'POST'), "/formFieldMaster/UpdateMapping/{field_id}", array(
    'uses' => 'formFieldMasterController@updateMapping',
    'as' => 'formFieldMaster.updateMapping'
));

//formFieldMaster

//Insurance bill
Route::resource('/insuranceBill', 'insurancebillController',array(
    'only' => array('index','edit','update')
));
Route::get('/insuranceBill/{case_id}/{typeId}/{printval}', 'insurancebillController@printbill')->name('insurancebill.print');
Route::get('/insuranceBill/{typeId}/{case_id}', 'insurancebillController@printbill')->name('insurancebill.print');

Route::post('insurancedeletesurgery', 'DynamicFieldController@insurancedeletesurgery')->name('insurancedeletesurgery');

//Insurance bill

//Discharge
Route::resource('/discharge', 'dischargeController',array(
    'only' => array('index','edit','update')
));
Route::get('/discharge/print/{case_id}', 'dischargeController@printbill')->name('discharge.print');
//Discharge 1
Route::get('/discharge/{case_id}/1/edit','dischargeController@editOne');
Route::post('/discharge/1/{case_id}','dischargeController@updateOne');
Route::get('/discharge/print/1/{case_id}', 'dischargeController@printbillOne')->name('discharge.printOne');
//Discharge

//Cataract

Route::get('cataract-operative-notes', 'CataractController@listing')->name('cataract-operative-notes');
Route::get('/cataract/{case_id}/1/edit','CataractController@editOne');
Route::post('/cataract/1/{case_id}','CataractController@update_cataract');
Route::get('/cataract/print/1/{case_id}', 'CataractController@printCataract')->name('cataract.printOne');

Route::resource('/cataract', 'CataractController',array(
    'only' => array('index','edit','update')
));

//Consent form

Route::get('cataract-consent-form', 'CataractController@cataract_consent_listing')->name('cataract-consent-listing');
Route::get('cataract-surgey', 'CataractController@cataract_surgery_listing')->name('cataract-surgey-listing');
Route::get('covid-consent-form', 'CataractController@covid_consent_listing')->name('covid-consent-form-listing');

Route::get('/cataract-consent-form/{case_id}/1/edit','CataractController@edit_cataract_consent');
Route::get('/cataract-surgey/{case_id}/1/edit','CataractController@edit_cataract_surgery');
Route::get('/covid-consent-form/{case_id}/1/edit','CataractController@edit_covid_consent');

Route::post('/cataract-consent-form/1/{case_id}','CataractController@update_cataract_consent');
Route::post('/cataract-surgey/1/{case_id}','CataractController@update_cataract_surgery');
Route::post('/covid-consent-form/1/{case_id}','CataractController@update_covid_consent');

Route::get('/cataract-consent-form/print/1/{case_id}', 'CataractController@print_cataract_consent');
Route::get('/cataract-surgey/print/1/{case_id}', 'CataractController@print_cataract_surgery');
Route::get('/covid-consent-form/print/1/{case_id}', 'CataractController@print_covid_consent');

//eye Operation record
Route::resource('/eyeOperationRecord', 'EyeOperationRecordController',array(
    'only' => array('index','edit','update')
));
Route::get('/eyeOperationRecord/print/{case_id}', 'EyeOperationRecordController@printbill')->name('eyeOperationRecord.print');
Route::get('/eyeOperationRecord/view/{case_id}', 'EyeOperationRecordController@viewbill')->name('eyeOperationRecord.view');
//eye Operation record

//eyeOperation
Route::resource('/eyeoperation', 'eyeoperationController',array(
    'only' => array('index','edit','update')
));
Route::get('/eyeoperation/print/{case_id}', 'eyeoperationController@printbill')->name('eyeoperation.print');
Route::delete('/eyeoperation/deleteSurgeryDetials/{surgeryId}','eyeoperationController@deleteSurgeryDetials')->name('eyeoperation.deleteSurgeryDetials');
//eyeOperation

//oldregistry
Route::resource('/oldregister', 'old_registerController',array(
    'only' => array('index','edit','update', 'create')
));
Route::get('/oldregister/print/{id}', 'old_registerController@printbill')->name('oldregistry.print');
Route::delete('/oldregister/delete/{id}','old_registerController@deleteregistry')->name('oldregistry.deleteregistry');
Route::post('/oldregister/grid', 'old_registerController@grid');
//oldregistry

//dentist
Route::resource('/dentist', 'dentistController',array(
    'only' => array('index','edit','update','show')
));
Route::get('/dentist/print/{case_id}', 'dentistController@printbill')->name('dentist.print');
Route::delete('/dentist/deleteSurgeryDetials/{surgeryId}','dentistController@deleteSurgeryDetials')->name('dentist.deleteSurgeryDetials');
//dentist

//dentist bill
Route::resource('/dentistBill', 'dentistBillController',array(
    'only' => array('index','edit','update')
));

Route::post('updatepaymentadd', 'dentistBillController@updatepaymentadd');
Route::get('printpaymenmt/{id}/{id1}','dentistBillController@printpaymenmt');

Route::get('/dentistBill/print/{case_id}', 'dentistBillController@printbill')->name('dentistBill.print');
//dentist bill
Route::patch('dentist-field/insert', 'DynamicFieldController@dentistinsert')->name('dentistinsert-field.insert');
Route::delete('/dentistmultiselect/{id}', 'dentistController@deletemultiselect')->name('dentistmultiselect.delete');
//form Drop Down
Route::resource('/formDropDown', 'formDropDownController',array(
    'only' => array('index','store')
));
Route::get('get_form_field/{id}','formDropDownController@get_form_field');
//form Drop Down

Route::get('/admin', 'BackEndController@admin');
Route::resource('/admin/doctor','doctorCRUDController');

Auth::routes();
Route::get('/changePassword','changePasswordController@showChangePasswordForm');
Route::post('/changePassword','changePasswordController@changePassword')->name('changePassword');

Route::get('/', 'HomeController@index');
Route::get('/main', 'HomeController@main');

Route::get('/new_index', 'HomeNewController@index');



Route::get('/Gallery', 'HomeController@Imagaegallery');
Route::get('/pages/{pageId}', 'HomeController@dynamic_page');

Route::get('/timeslots/grid', 'TimeslotsController@grid');
Route::resource('/timeslots', 'TimeslotsController');

Route::get('/medical_stores/grid', 'Medical_storesController@grid');
Route::resource('/medical_stores', 'Medical_storesController');

Route::get('/Medicine', 'Medical_storesController@medicie_list');
Route::get('/Medicine/create', 'Medical_storesController@medicine_create');
Route::post('/Medicine', 'Medical_storesController@medicine_store');
Route::get('/Medicine/{id}', 'Medical_storesController@medicine_edit');
Route::put('/Medicine/{id}', 'Medical_storesController@medicine_update');
Route::patch('/Medicine/{id}', 'Medical_storesController@medicine_update');

//Other medicine routes

Route::get('/other_medical_stores/grid', 'Medical_storesotherController@grid');
Route::resource('/other_medical_stores', 'Medical_storesotherController');

Route::get('/Other_Medicine', 'Medical_storesotherController@medicie_list');
Route::get('/Other_Medicine/create', 'Medical_storesotherController@medicine_create');
Route::post('/Other_Medicine', 'Medical_storesotherController@medicine_store');
Route::get('/Other_Medicine/{id}', 'Medical_storesotherController@medicine_edit');
Route::put('/Other_Medicine/{id}', 'Medical_storesotherController@medicine_update');
Route::patch('/Other_Medicine/{id}', 'Medical_storesotherController@medicine_update');

Route::post('/case_masters/grid', 'Case_mastersController@grid');

///////////prescription-other//////////////

Route::get('/case_masters/prescriptionlst','Case_mastersController@prescriptionlst');
Route::get('/case_masters/ent-prescriptionlst','Case_mastersController@ent_prescriptionlst');

Route::get('/case_masters/prescriptionlstother','Case_mastersController@prescriptionlstother');
Route::get('/AddEdit/prescriptionother/{case_number}', 'Case_mastersController@edit_prescriptionother');
Route::post('/AddEdit/prescriptionother/{case_number}', 'Case_mastersController@update_prescriptionother');

Route::get('/print/prescriptionother/{case_number}', 'Case_mastersController@printprescriptionother');
/////////////////////////
Route::post('/AddEdit/prescription/{case_number}', 'Case_mastersController@update_prescription');
Route::post('/patientDetails/prescription/{case_number}', 'patientDetailsController@update_prescription');
Route::resource('/case_masters', 'Case_mastersController');
Route::post('/case_masters/delete/{case_numer}', 'Case_mastersController@deletePrescription');
Route::get('/getMemoryDetials/{id}', 'Case_mastersController@getMemoryDetials');
Route::get('/case_masters/print/{id}', 'Case_mastersController@printPatientDetails');
Route::get('/patient/report', 'Case_mastersController@ViewReport');
Route::get('/patientDetails/patient/report', 'Case_mastersController@patientdetailViewReport');
Route::get('/patient/fitnessCertificate', 'Case_mastersController@fitnessCertificate');
Route::post('/patient/report/grid', 'Case_mastersController@ViewReportgrid');

Route::post('/useraccess/grid', 'userAccessController@ViewReportgrid');

Route::get('/storage/uploads/{fileName}', function($fileName){
    $fileName = storage_path('app/uploads/'.$fileName);
    return response()->download($fileName);
});

Route::get('/storage/uploads/dentist/{fileName}', function($fileName){
    $fileName = storage_path('app/uploads/dentist/'.$fileName);
    return response()->download($fileName);
});

Route::get('/storage/uploads/{folderName}/{fileName}', function($folderName, $fileName){
    $fileName = storage_path('app/uploads/'.$folderName.'/'.$fileName);
    return response()->download($fileName);
});


Route::get('/report_files/grid', 'Report_filesController@grid');
Route::resource('/report_files', 'Report_filesController');
Route::get('/stop_appointments/{id}/show', 'Stop_appointmentsController@show');
Route::get('/stop_appointments/grid', 'Stop_appointmentsController@grid');
Route::resource('/stop_appointments', 'Stop_appointmentsController');
Route::get('/bill_details/grid', 'Bill_detailsController@grid');
Route::get('/bill_details/{case_id}/print', 'Bill_detailsController@print_bill');
Route::resource('/bill_details', 'Bill_detailsController');
Route::get('/patientbill/report', 'Bill_detailsController@ViewReport');

Route::get('/patientbill/gettotal', 'Bill_detailsController@gettotal');

Route::get('/patientbill/report/grid', 'Bill_detailsController@reportGrid');//{docid}

Route::post('/patientbill/printReport', 'Bill_detailsController@printReport');

Route::get('/doctorbill', 'DoctorBillController@index');
Route::get('/doctorbill/grid', 'DoctorBillController@grid');
Route::get('/doctorbill/{case_id}/print', 'DoctorBillController@print_bill');
Route::get('/doctorbill/{doctorId}/AddBill', 'DoctorBillController@AddBill');
Route::post('/doctorbill/{doctorId}/AddBill', 'DoctorBillController@SaveBill');
Route::get('/doctorbill/{doctorId}/ViewBillDetails', 'DoctorBillController@ViewBillDetails');
Route::get('/doctorbill/report/{reportName}', 'DoctorBillReportController@ViewReport');
Route::get('/doctorbill/report/{reportName}/grid', 'DoctorBillReportController@reportGrid');
Route::post('/doctorbill/{reportName}/printReport', 'DoctorBillReportController@printReport');

Route::post('/imageList/grid', 'Image_galleriesController@grid');
Route::resource('/image_galleries', 'Image_galleriesController');
Route::get('/LogoAddEdit/{id}', 'Image_galleriesController@editlogo');

Route::get('/dynamic_text/{textType}/{relationshipKey}', 'dynamic_textController@edit');
Route::post('/dynamic_text/imgUpload', 'dynamic_textController@TinyMCEUpload');
Route::post('/dynamic_text/store', 'dynamic_textController@update');
Route::patch('/dynamic_text/store', 'dynamic_textController@update');
Route::get('/menu_lists/grid', 'Menu_listsController@grid');
Route::resource('/menu_lists', 'Menu_listsController');
Route::get('/bulk_sms/grid', 'Bulk_smsController@grid');
Route::get('/bulk_sms/{id}/send_sms', 'Bulk_smsController@sendSms_get');
Route::post('/bulk_sms/{id}/send_sms', 'Bulk_smsController@sendSms_post');
Route::post('/bulk_sms/sendOldRegisterSms', 'Bulk_smsController@sendOldRegisterSms_post');
Route::post('/bulk_sms/sendPatientReportSms', 'Bulk_smsController@sendPatientReportSms_post');
Route::resource('/bulk_sms', 'Bulk_smsController');

Route::get('/staff_users/grid', 'Staff_usersController@grid');
Route::resource('/staff_users', 'Staff_usersController');
Route::get('member_sms','Staff_usersController@get_member_sms');

Route::get('get_user_by_type/{id}','Staff_usersController@get_user_by_type');
Route::post('member_sms','Staff_usersController@post_member_sms');

//IPD Patient Register
Route::resource('/IPD/patientRegsiter', 'IPD\patientRegsiterController',array(
    'only' => array('index','edit','update')
));
Route::get('/IPD/patientRegsiter/print/{id}', 'IPD\patientRegsiterController@printbill')->name('IPD.patientRegsiterController.print');
Route::delete('/IPD/patientRegsiter/delete/{id}','IPD\patientRegsiterController@delete')->name('IPD.patientRegsiterController.delete');
Route::post('/IPD/patientRegsiter/grid', 'IPD\patientRegsiterController@grid');
//Route::get('/discharge/print/{case_id}', 'dischargeController@printbill')->name('discharge.print');

//IPD Patient bill
Route::resource('/IPD/patientBill', 'IPD\patientBillController',array(
    'only' => array('index','edit','update')
));
Route::get('/IPD/patientBill/print/{id}', 'IPD\patientBillController@printbill')->name('IPD.patientBillController.print');
Route::get('/IPD/patientBill/printReceipt/{id}', 'IPD\patientBillController@printReceipt')->name('IPD.patientBillController.printReceipt');
Route::post('/IPD/patientBill/grid', 'IPD\patientBillController@grid');
//Route::get('/discharge/print/{case_id}', 'dischargeController@printbill')->name('discharge.print');


//IPD Patient Medicine
Route::resource('/IPD/patientMedicine', 'IPD\patientMedicineController',array(
    'only' => array('index','edit','update')
));
Route::get('/IPD/patientMedicine/print/{id}', 'IPD\patientMedicineController@printMedicine')->name('IPD.patientMedicineController.print');
Route::get('/IPD/patientMedicine/printReceipt/{id}', 'IPD\patientMedicineController@printReceipt')->name('IPD.patientMedicineController.printReceipt');
Route::post('/IPD/patientMedicine/grid', 'IPD\patientMedicineController@grid');

//IPD Patient Discharge
Route::resource('/IPD/Discharge', 'IPD\IpdDischargeController',array(
    'only' => array('index','edit','update')
));
Route::get('/IPD/Discharge/print/{id}', 'IPD\IpdDischargeController@printbill')->name('IPD.IpdDischargeController.print');
Route::delete('/IPD/Discharge/delete/{id}','IPD\IpdDischargeController@delete')->name('IPD.IpdDischargeController.delete');
Route::post('/IPD/Discharge/grid', 'IPD\IpdDischargeController@grid');
Route::get('/IPD/AddEdit/prescription/{patient_id}', 'IPD\IpdDischargeController@edit_prescription');
Route::post('/IPD/AddEdit/prescription/{patient_id}', 'IPD\IpdDischargeController@update_prescription');

Route::get('appointmentslot','AppoinmentslotController@index')->name('appointmentslot');
Route::post('saveappintmentslot','AppoinmentslotController@saveappintmentslot')->name('saveappintmentslot');

Route::get('gettimeslotrecord/{doctor_id}/{time}/{day}',["as"=>"gettimeslotrecord" ,"uses" =>"AppoinmentslotController@gettimeslotrecord"]);

Route::get('followupappoinment/{id}','AppointmentController@followappoinment')->name('followupappoinment');

Route::get('doctorlistbillreport','AppointmentController@doctorlistbillreport')->name('doctorlistbillreport');

Route::get('avaibaletimeslots/{doctor_id}/{appointment_dt}','AppointmentController@avaibaleTimeSlot')->name('avaibaletimeslots');

Route::get('avaibaletimeslotscasemaster/{doctor_id}/{appointment_dt}','Case_mastersController@avaibaletimeslotscasemaster')->name('avaibaletimeslotscasemaster');

Route::get('avaibaletime/{doctor_id}/{appointment_dt}','EyeFormController@avaibaletime');




Route::get('doctordata/{doctor_id}','AppointmentController@doctordata')->name('doctordata');


Route::get('downloaddatabase','DatabasebackController@index')->name('downloaddatabase');
Route::get('exeldatabaseback','DatabasebackController@our_backup_database')->name('exeldatabaseback');


Route::DELETE('deleterecord/{id}',["as"=>"deleterecord" ,"uses" =>"AppoinmentslotController@deleterecord"]);


Route::get('useraccess/{user_id}',"userAccessController@useraccess")->name('useraccess');
Route::get('getallsection',["as"=>"getallsection" ,"uses" =>"userAccessController@getallsection"]);

Route::post('savesectionrecord/{user_id}/{sectionid}/{accesslevel}',["as"=>"savesectionrecord" ,"uses" =>"userAccessController@savesectionrecord"]);

// Route::post('getallcheckbox','userAccessController@getallcheckbox')->name('getallcheckbox');

Route::post('getallcheckbox',["as"=>"getallcheckbox" ,"uses" =>"userAccessController@getallcheckbox"]);


Route::post('saverec/{accesslevel}/{id}',["as"=>"saverec" ,"uses" =>"userAccessController@saverec"]);




Route::post('saveuser',["as"=>"saveuser" ,"uses" =>"userAccessController@saveuser"]);





Route::post('savesection/{accesslevel}/{id}',["as"=>"savesection" ,"uses" =>"userAccessController@savesection"]);

Route::delete('/deleteuser/delete/{id}','Staff_usersController@deleteuser')->name('deleteuser');


Route::post('checkphone','UserController@checkphone')->name('checkphone');


Route::get('/showerror','UserController@showerror')->name('showerror');
// Route::get('showpwdresetpage','UserController@showpwdresetpage')->name('showpwdresetpage');


//Route::get('staff/grid','StaffController@grid')->name('staff/grid');

Route::resource('/staff_member', 'StaffController');


Route::get('/staff/grid', 'StaffController@grid');
Route::resource('/staff_users', 'Staff_usersController');


Route::get('member_sms','StaffController@get_member_sms');

Route::get('get_user_by_type/{id}','StaffController@get_user_by_type');
Route::post('member_sms','StaffController@post_member_sms');



Route::get('/dynamic_pdf', 'DynamicPDFController@index');

Route::get('/dynamic_pdf/{pdf}', 'DynamicPDFController@pdf');


Route::get('generate-pdf/{case_id}','MainController@generatePDF');

Route::get('/dentist/pdf/{case_id}', 'dentistController@pdfbill')->name('dentist.pdf');


Route::get('/PrintMedicalDetails/{case_id}', 'patientDetailsController@printPatientMedicalDetails');

Route::get('generate-html-to-pdf/{case_id}', 'dentistController@downloadpdf')->name('generate-html-to-pdf');

// eye ipd section
Route::post('/eyeipd_operation_rec/grid', 'EyeIpdController@grid');
Route::resource('/eyeipd_operation_rec', 'EyeIpdController');



Route::get('operation_rec',['as'=>'operation.show','uses'=>'EyeIpdController@operation']);

Route::get('discharge_index',['as'=>'discharge.show','uses'=>'EyeIpdController@discharge']);

//Route::get('cataract-operative-notes',['as'=>'cataract-operative-notes','uses'=>'CataractController@index']);



Route::get('ipdbill_index',['as'=>'ipdbill.show','uses'=>'EyeIpdController@ipdbill']);

Route::post('dynamic-field/insert', 'DynamicFieldController@insert')->name('dynamic-field.insert');
Route::patch('dynamic-field/insert', 'DynamicFieldController@insert')->name('dynamic-field.insert');

Route::post('dynamic-field/refraction-options', 'DynamicFieldController@refraction_options')->name('refraction-options.insert');
Route::post('dynamic-field/update-refraction-options', 'DynamicFieldController@update_refraction_options')->name('refraction-options.update');

Route::post('dynamic-field/systemicinsert', 'DynamicFieldController@systemicinsert')->name('systemicinsert.insert');

Route::post('medicine-field/insert', 'DynamicFieldController@medicineinsert')->name('medicine-field.insert');

Route::post('generic-medicine-field/insert', 'DynamicFieldController@generic_medicine_insert')->name('generic-medicine-field.insert');

Route::post('entmedicine-field/insert', 'DynamicFieldController@entmedicineinsert')->name('entmedicine-field.insert');


Route::post('eye-field/insert', 'DynamicFieldController@eyeinsert')->name('eye-field.insert');

Route::post('bloodinvestigation/{uv_chkval}/{pre_chkval}/{caseid}', 'DynamicFieldController@bloodinvestigation')->name('bloodinvestigation.insert');

Route::post('segmentinsert-field/insert', 'DynamicFieldController@segmentinsert')->name('segmentinsert-field.insert');
Route::post('AddBloodTitle', 'DynamicFieldController@AddBloodTitle')->name('AddBloodTitle');
Route::post('AddBloodSubTitle', 'DynamicFieldController@AddBloodSubTitle')->name('AddBloodSubTitle');


// Ent Form routes

Route::post('checksts/{sts}/{caseid}',["as"=>"checksts" ,"uses" =>"DynamicFieldController@checksts"]);

Route::get('/Ent/{case_id}', 'EntController@index')->name('ent.index');
Route::post('entinsert-field/insert', 'DynamicFieldController@entinsert')->name('entinsert-field.insert');
Route::Post('/ent/SaveEntExamination', 'EntController@SaveEnt')->name('entDetails.save');
Route::Post('/ent/SaveViewEntExamination', 'EntController@SaveEntView')->name('entDetails.saveview');
Route::delete('/entform/deleteMultiEntry/{Id}','EntController@deleteMultiEntry')->name('entForm.deleteMultiEntryField');
Route::get('/printEntReportFiles/{file_id}', 'EntController@printEntReportFiles')->name('entDetails.printReportFiles');

Route::get('/ViewEntDetails/{case_id}', 'EntController@ViewEntDetails')->name('entDetails.view');
Route::get('/PrintEntDetails/{case_id}', 'EntController@PrintEntDetails')->name('entDetails.print');
Route::get('/print/entprescription/{case_number}', 'EntController@printprescription');
Route::post('bloodinvestigation/{uv_chkval}/{pre_chkval}/{caseid}', 'DynamicFieldController@bloodinvestigation')->name('bloodinvestigation.insert');
Route::post('bloodinvestigation1/{uv_chkval}/{pre_chkval}/{caseid}', 'DynamicFieldController@bloodinvestigation1')->name('bloodinvestigation1.insert');

Route::Post('/entform/deleteImage', 'EntController@deleteImage')->name('image.delete');
// Route::post('bloodinvestigation1/{chkval}/{caseid}', 'DynamicFieldController@bloodinvestigation1')->name('bloodinvestigation1.insert');

// Route::post('bloodinvestigation2/{chkval}/{caseid}', 'DynamicFieldController@bloodinvestigation2')->name('bloodinvestigation2.insert');
Route::post('blnce-field/insert', 'DynamicFieldController@blnceinsert')->name('blnce-field.insert');

Route::post('uveiitis_chk/{checked}/{caseid}', 'DynamicFieldController@uveiitis_chk')->name('uveiitis_chk.insert');
Route::post('preoperative_chk/{checked}/{caseid}', 'DynamicFieldController@preoperative_chk')->name('preoperative_chk.insert');
Route::post('preoperative_chk1/{checked}/{caseid}', 'DynamicFieldController@preoperative_chk1')->name('preoperative_chk1.insert');

Route::post('ear1/{checked}/{caseid}', 'DynamicFieldController@ear1')->name('ear1.insert');
Route::post('ear2/{checked}/{caseid}', 'DynamicFieldController@ear2')->name('ear2.insert');
Route::post('nose/{checked}/{caseid}', 'DynamicFieldController@nose')->name('nose.insert');
Route::post('neck/{checked}/{caseid}', 'DynamicFieldController@neck')->name('neck.insert');
Route::post('throat/{checked}/{caseid}', 'DynamicFieldController@throat')->name('throat.insert');

Route::get('/ViewEntReportFiles/{case_id}', 'EntController@ViewEntReportFiles')->name('entDetails.viewReportFiles');

Route::get('/AddEdit/entprescription/{case_number}', 'EntController@edit_prescription');

Route::post('/AddEdit/entprescription/{case_number}', 'EntController@updateent_prescription');

Route::post('/patientDetails/prescription/{case_number}', 'EntController@updateent_prescription');

Route::post('/case_masters/delete/{case_numer}', 'EntController@deletePrescription');


Route::post('ent-field/insert', 'DynamicFieldController@entinsert')->name('ent-field.insert');

Route::get('GetPatientName/{id}', 'IPD\patientRegsiterController@GetPatientName');
Route::post('gyninsert-field/insert', 'DynamicFieldController@gyninsert')->name('gyninsert-field.insert');

Route::Post('/store', 'AppointmentController@store')->name('appointment.store');

////////////////////////////MD///
Route::post('mdinsert-field/insert', 'DynamicFieldController@mdinsert')->name('mdinsert-field.insert');

/////Skin Insert/////
Route::patch('skin-field/insert', 'DynamicFieldController@skininsert')->name('skin-field.insert');


/////////////////email//////////////
Route::Post('/patientDetails/entSaveCaseHistoryotherpris', 'EntController@entSaveCaseHistoryotherpris')->name('eyeDetails.save');
Route::Post('/patientDetails/entSaveCaseHistoryotherpris1', 'EntController@entSaveCaseHistoryotherpris1')->name('eyeDetails.save1');


Route::Post('/patientDetails/SaveCaseHistoryprescription', 'Case_mastersController@SaveCaseHistoryotherpris')->name('eyeDetails.save1');
Route::Post('/patientDetails/SaveCaseHistoryprescription1', 'Case_mastersController@SaveCaseHistoryotherpris1')->name('eyeDetails.save1');

Route::patch('/glass_prescriptionEmail','glassPrescriptionController@glass_prescriptionEmail')->name('glassPrescription.save');
Route::patch('/glass_prescriptionEmail1','glassPrescriptionController@glass_prescriptionEmail1')->name('glassPrescription.save1');

/////////////////ent-email-////////////////////////////////
Route::post('Send_emailent','EntController@Send_emailent')->name('Send_emailent.save');

//////General-Practictioner-pdfemail-//////////////////
Route::post('Send_email','Case_mastersController@Send_email')->name('Send_email.save');


Route::get('/user_right/{user_id}', 'userAccessController@user');

Route::get('useraccess/{user_id}',"userAccessController@useraccess")->name('useraccess');

Route::get('/user_right/grid/{user_id}','userAccessController@grid');


// Datatable with checkbox

Route::get('/emp','EmployeesController@index');
Route::get('/employees/getEmployees/','EmployeesController@getEmployees')->name('employees.getEmployees');

//////Medicine-Stock-//////////////////

Route::resource('/MedicineStock', 'MedicineStockController',array(
    'only' => array('index','edit','update')
));
Route::post('/MedicineStock/grid', 'MedicineStockController@grid');
Route::get('GetMedicineName/{id}', 'MedicineStockController@GetMedicineName');
Route::delete('/MedicineStock/delete/{id}','MedicineStockController@delete')->name('MedicineStockController.delete');
Route::get('/MedicineStock/print/{id}', 'MedicineStockController@print')->name('MedicineStockController.print');
Route::get('/ViewMedicineStock/{id}', 'MedicineStockController@ViewMedicineStock')->name('medicinestock.view');

// Back Records
Route::get('backrecord/{case_id}', 'BackRecordController@backrecord')->name('backrecord');
Route::post('savebackrecord', 'BackRecordController@savebackrecord');
Route::get('backrecordview/{case_id}', 'BackRecordController@backrecordview')->name('backrecord.view');
Route::get('backrecordviewbyid/{id}', 'BackRecordController@backrecordviewbyid')->name('backrecord.view');
Route::get('getRecordbyID/{id}', 'BackRecordController@getRecordbyID');


//Gallery
Route::get('gallery','GalleryController@index')->name('gallery');
Route::post('stored_images','GalleryController@stored_images')->name('stored_images');
Route::get('gallery_list','GalleryController@gallery_list')->name('gallery_list');
Route::get('deleteGallery/{id}','GalleryController@deleteGallery')->name('deleteGallery');
Route::get('deletesubGallery/{id}','GalleryController@deletesubGallery')->name('deletesubGallery');
Route::get('showsubimage/{id}','GalleryController@showsubimage')->name('showsubimage');


//discharge2

Route::resource('/discharge2', 'discharge2Controller',array(
    'only' => array('index','edit','update')
));
Route::get('/discharge2/print/{case_id}', 'discharge2Controller@printbill')->name('discharge2.print');
//Discharge 2
Route::get('/discharge2/{case_id}/1/edit','discharge2Controller@editOne');
Route::post('/discharge2/1/{case_id}','discharge2Controller@updateOne');
Route::get('/discharge2/print/1/{case_id}', 'discharge2Controller@printbillOne')->name('discharge2.printOne');
Route::post('/discharge2/grid', 'discharge2Controller@grid');

Route::resource('/admin/procedures','ProceduresController', ['names' => [
    'create' => 'procedure.create',
    'edit' => 'procedure.edit',
    'index' => 'procedures.index'
]]);

Route::resource('/admin/payment-modes','PaymentModesController', ['names' => [
    'create' => 'payment-modes.create',
    'edit' => 'payment-modes.edit',
    'index' => 'payment-modes.index'
]]);

Route::get('user-permissions/{user_id?}',"userPermissionController@index")->name('user-permissions');
Route::post('update-permission',"userPermissionController@update")->name('update-permission');



Route::get('/bill_details/get_fees_details/{doctor_id}', 'Bill_detailsController@get_fees_details');
Route::get('/bill_details/get_fees/{fees_id}', 'Bill_detailsController@get_fees');

Route::resource('settings', 'SettingController');

Route::get('set-dropdown-options', 'DynamicFieldController@set_dropdown_options');

Route::get('get_dropdown_options', 'patientDetailsController@get_dropdown_options');

Route::post('update-dropdown-options', 'DynamicFieldController@update_dropdown_options')->name('update-dropdown-options');
//Route::post('update-ent-dropdown-options', 'DynamicFieldController@update_ent_dropdown_options')->name('update-ent-dropdown-options');

Route::post('update-ent-dropdown-options', 'DynamicFieldController@update_ent_dropdown_options');

Route::post('update_dropdown_options_blood_ivn', 'DynamicFieldController@update_dropdown_options_blood_ivn')->name('update_dropdown_options_blood_ivn');

Route::post('update_dropdown_options_blood_ivn_subtitle', 'DynamicFieldController@update_dropdown_options_blood_ivn_subtitle')->name('update_dropdown_options_blood_ivn_subtitle');

Route::post('get-update-dropdown-options', 'DynamicFieldController@get_update_dropdown_options')->name('get-update-dropdown-options');
Route::post('get-update-ent-dropdown-options', 'DynamicFieldController@get_update_ent_dropdown_options')->name('get-update-ent-dropdown-options');

Route::post('get_update_dropdown_options_blood_investigation', 'DynamicFieldController@get_update_dropdown_options_blood_investigation')->name('get_update_dropdown_options_blood_investigation');


Route::post('delete_bloodinvestigatinTitles', 'DynamicFieldController@delete_bloodinvestigatinTitles')->name('delete_bloodinvestigatinTitles');
//New Routes

//add or edit blod investigation
Route::post('manage-bloodinvestigation', 'DynamicFieldController@manageBloodinvestigation')->name('bloodinvestigation.manage');

//Dilation Routes
Route::get('dilation', 'DilationController@dilation');
Route::post('add-dilation', 'DilationController@addNewDilation');
Route::post('update-dilation-status', 'DilationController@updateDilationStatus');
Route::get('get-balance', 'patientDetailsController@getBalanceAmount');

Route::get('/patientbill/payment-report', 'Bill_detailsController@ViewPaymentReport');
Route::get('/patientbill/payment-report/grid', 'Bill_detailsController@reportPaymentGrid');//{docid}

Route::get('/ipdbill/report', 'insurancebillController@ViewReport');
Route::get('/ipdbill/report/grid', 'insurancebillController@reportGrid');//{docid}

Route::get('/ipdbill/payment-report', 'insurancebillController@ViewPaymentReport');
Route::get('/ipdbill/payment-report/grid', 'insurancebillController@reportPaymentGrid');//{docid}

Route::get('get-dilations', 'DilationController@getDilations');

//prescription drop down otions
Route::post('get-prescription-dropdown-options', 'DynamicFieldController@get_prescription_dropdown_options')->name('get-prescription-dropdown-options');
Route::post('update-prescription-dropdown-options', 'DynamicFieldController@update_prescription_dropdown_options')->name('update-prescription-dropdown-options');


Route::post('get-ent-prescription-dropdown-options', 'DynamicFieldController@get_ent_prescription_dropdown_options')->name('get-ent-prescription-dropdown-options');
Route::post('update-ent-prescription-dropdown-options', 'DynamicFieldController@update_ent_prescription_dropdown_options')->name('update-ent-prescription-dropdown-options');

//manage print options
Route::post('manage-print-display', 'DynamicFieldController@managePrintDisplay')->name('printdisplay.manage');

//Finding Template routes
Route::get('/add-finding-templates/{case_id?}', 'EyeFormController@addFindingTemplate')->name('add-finding-templates');
Route::post('/update-finding-template/{case_id?}', 'EyeFormController@updateFindingTemplate')->name('update-finding-template');
Route::post('/get-finding-template-html/{case_id?}', 'EyeFormController@getFindingTemplateHtml')->name('get-finding-template-html');

//Procedure Template routes
Route::get('/add-custom-templates/{case_id?}/{template_type?}', 'EyeFormController@addCustomTemplate')->name('add-custom-templates');
Route::post('/update-custom-template/{case_id?}', 'EyeFormController@updateCustomTemplate')->name('update-custom-template');
Route::post('/get-custom-template-html/{case_id?}', 'EyeFormController@getCustomTemplateHtml')->name('get-custom-template-html');

//IPD bill item Template routes
Route::get('/add-ipdbill-items-template/{case_id?}', 'EyeFormController@addIpdbillItemTemplate')->name('add-ipdbill-items-template');
Route::post('/update-ipdbill-items-template/{case_id?}', 'EyeFormController@updateIpdbillItemTemplate')->name('update-ipdbill-items-template');
Route::post('/get-ipdbill-items-template-html/{case_id?}', 'EyeFormController@getIpdbillItemTemplateHtml')->name('get-ipdbill-items-template-html');


Route::get('/patient-activity', 'Case_mastersController@patient_activity');
Route::post('patient-activty-grid', 'Case_mastersController@patient_activity_grid');
Route::post('/update-patient-activity', 'Case_mastersController@update_patient_activity');



Route::get('opdbill-report', 'Bill_detailsController@ViewOpdReport');
Route::get('opdbill-report-grid', 'Bill_detailsController@opdReportGrid');//{docid}

Route::get('today-opdbill-report', 'Bill_detailsController@todayViewOpdReport');
Route::get('today-opdbill-report-grid', 'Bill_detailsController@todayOpdReportGrid');//{docid}

Route::get('/ipdbill-report', 'insurancebillController@ipdViewReport');
Route::get('/ipdbill-report-grid', 'insurancebillController@ipdViewReportGrid');//{docid}

Route::get('/ipd-surgery-report', 'insurancebillController@surgeryViewReport');
Route::get('/ipd-surgery-report-grid', 'insurancebillController@surgeryReportGrid');//{docid}


Route::get('certificate', 'Case_mastersController@certificate')->name('certificate');
Route::get('certificate/{case_id}/1/edit','Case_mastersController@edit_certificate');
Route::post('certificate/1/{case_id}','Case_mastersController@update_certificate');


Route::get('certificate/print/1/{case_id}', 'Case_mastersController@print_certificate');

Route::post('get-update-refration-dropdown-options', 'DynamicFieldController@get_update_refraction_dropdown_options')->name('get-update-refraction-dropdown-options');

Route::get('/print/prescription/{case_number}', 'Case_mastersController@printprescription');



Route::get('/AddEdit/prescription/{case_number}', 'Case_mastersController@edit_prescription');

Route::get('add-ent-prescription-templates/{case_number?}', 'EntController@add_ent_prescription_templates');
Route::get('add-prescription-templates/{case_number?}', 'Case_mastersController@add_prescription_templates');
Route::get('prescription-templates/{case_id?}', 'Case_mastersController@add_prescription_templates');


Route::post('update-ent-prescription-template/{case_number?}', 'Case_mastersController@update_ent_prescription_templates');
Route::post('update-prescription-template/{case_number?}', 'Case_mastersController@update_prescription_templates');

Route::post('get-prescription-template/{case_number?}', 'Case_mastersController@get_prescription_template');
Route::post('get-ent-prescription-template/{case_number?}', 'EntController@get_ent_prescription_template');

//============================================================================================================

Route::get('ent-prescription-templates-listing/{case_number?}', 'PrescriptionController@ent_template_list');
Route::post('ent-prescription-templates-grid', 'PrescriptionController@ent_prescription_templates_grid');

Route::get('prescription-templates-listing/{case_number?}', 'PrescriptionController@index');
Route::post('prescription-templates-grid', 'PrescriptionController@prescription_templates_grid');

Route::get('edit-ent-prescription-templates/{template_id?}/{case_number?}', 'PrescriptionController@edit_ent_prescription_templates');
Route::get('edit-prescription-templates/{template_id?}/{case_number?}', 'PrescriptionController@edit_prescription_templates');

Route::get('delete-ent-prescription-templates/{template_id?}/{case_number?}', 'PrescriptionController@delete_ent_prescription_templates');
Route::get('delete-prescription-templates/{template_id?}/{case_number?}', 'PrescriptionController@delete_prescription_templates');
//============================================================================================================

//============================================================================================================
Route::get('list-finding-templates/{case_number?}', 'PrescriptionController@list_finding_templates');
Route::post('findings-templates-grid', 'PrescriptionController@findings_templates_grid');

Route::get('edit-finding-templates/{template_id?}/{case_number?}', 'PrescriptionController@edit_finding_templates');

Route::post('update-findings-template/{template_id?}', 'Case_mastersController@update_finding_templates');

//Route::post('/update-findings-template/{template_id?}', 'PrescriptionController@update_finding_templates')->name('update-findings-template');
 /*
Route::post('update-findings-template/{template_id?}', function() {
    echo "=========>>>>>>>>>> <pre>"; print_r($_POST); exit;
});
*/
Route::get('delete-finding-templates/{template_id?}/{case_number?}', 'PrescriptionController@delete_finding_templates');

Route::get('/edit-finding-template/{case_id?}', 'EyeFormController@editFindingTemplate')->name('edit-finding-template');
//============================================================================================================

Route::get('opd-bill-report', 'ReportsController@ViewOnlyOpdReport');
Route::get('opd-bill-report-grid', 'ReportsController@onlyOpdReportGrid');//{docid}

Route::get('opd-bill-payment-report', 'ReportsController@opdBillPaymentReport');
Route::get('opd-bill-payment-report-grid', 'ReportsController@opdBillPaymentReportGrid');//{docid}

Route::get('opd-bill-balance-report', 'ReportsController@opdBillBalanceReport');
Route::get('opd-bill-balance-report-grid', 'ReportsController@opdBillBalanceReportReportGrid');//{docid}
//--------------------------------------------------------------------------------------------------------
Route::get('/ipd-bill-report', 'ReportsController@ipdViewReport');
Route::get('/ipd-bill-report-grid', 'ReportsController@ipdViewReportGrid');//{docid}

Route::get('ipd-bill-payment-report', 'ReportsController@ipdBillPaymentReport');
Route::get('ipd-bill-payment-report-grid', 'ReportsController@ipdBillPaymentReportGrid');//{docid}

Route::get('ipd-bill-balance-report', 'ReportsController@ipdBillBalanceReport');
Route::get('ipd-bill-balance-report-grid', 'ReportsController@ipdBillBalanceReportGrid');//{docid}

//============================================================================================================
Route::get('/add-prescription-dropdowns/{case_number}', 'Case_mastersController@add_prescription_dropdowns');
Route::get('/add-ent-prescription-dropdowns/{case_number?}', 'Case_mastersController@add_ent_prescription_dropdowns');

Route::post('/case_masters/certificate_grid', 'Case_mastersController@certificate_grid');
Route::post('/case_masters/prescription_grid', 'Case_mastersController@prescription_grid');
Route::post('/case_masters/bill_details_grid', 'Case_mastersController@bill_details_grid');

//==============================================


Route::get('/patients-listing', 'PatientsController@patients_listing');
Route::post('/patients/grid', 'PatientsController@grid');
Route::get('/edit-patient/{registration_id?}', 'PatientsController@edit_patient');

Route::get('/register', 'PatientsController@register');
Route::get('/patients-registration-print/{registration_id?}', 'PatientsController@patients_registration_print');
Route::get('/advance-payment-receipt/{registration_id}/{receipt_id?}', 'PatientsController@advance_payment_receipt');
Route::post('/patients/save', 'PatientsController@save');


Route::get('/print-advance-receipt/{registration_id}/{receipt_id?}', 'PatientsController@print_advance_payment_receipt');
Route::post('/save-advance-payment-receipt', 'PatientsController@save_advance_payment_receipt');


Route::get('/patients/consent/{registration_id}', 'PatientsController@consent');
Route::get('/patients/print-patient-consent/{registration_id}', 'PatientsController@consent_print');
Route::post('/patients/save-consent', 'PatientsController@save_consent');
Route::get('/patients/print-consent/{registration_id}/{is_consent}', 'PatientsController@patients_registration_print');

//Route::get('/patients/discharge/{registration_id}', 'PatientsController@discharge');
Route::get('/patients/discharge/{registration_id}', 'PatientsController@discharge_2023');

// //New consent form
// Route::post('/patients/save-consent-new', 'PatientsController@save_consent');
// Route::get('/patients/print-consent-new/{registration_id}/{is_consent}', 'PatientsController@patients_registration_print');


Route::resource('/Patients/Discharge', 'PatientsDischargeController',array(
    'only' => array('index','edit','update')
));


Route::post('/PatientsDischargeController/grid', 'PatientsDischargeController@grid');
Route::post('/Patients/save-discharge', 'PatientsController@save_discharge');
//Route::get('/patients/discharge/print/{discharge_id}', 'PatientsController@patients_discharge_print');
Route::get('/patients/discharge/print/{discharge_id}', 'PatientsController@patients_discharge_print_2023');

Route::get('/patients/prescription', 'PatientsController@edit_prescription');
//Route::get('/add-patients-prescription-dropdowns/{case_number}', 'Case_mastersController@add_ent_prescription_dropdowns');
Route::post('/patients/save-prescription', 'PatientsController@update_patients_prescription');

//IPD Patient bill
Route::resource('/patients_ipd_bill/patientBill', 'patient_BillController',array(
    'only' => array('index','edit','update')
));
Route::get('/patients_ipd_bill/print/{id}', 'patient_BillController@printbill')->name('IPD.patientBillController.print');
Route::get('/patients_ipd_bill/printReceipt/{id}', 'patient_BillController@printReceipt')->name('IPD.patientBillController.printReceipt');
Route::post('/patients_ipd_bill/grid', 'patient_BillController@grid');

//===================================================

//IPD Patient bill
Route::resource('/patients_ipd/patientBill', 'PATIENTS_IPD\patientBillController',array(
    'only' => array('index','edit','update')
));
Route::get('/patients_ipd/patientBill/print/{id}', 'PATIENTS_IPD\patientBillController@printbill')->name('PATIENTS_IPD.patientBillController.print');
Route::get('/patients_ipd/patientBill/printReceipt/{id}', 'PATIENTS_IPD\patientBillController@printReceipt')->name('PATIENTS_IPD.patientBillController.printReceipt');
Route::post('/patients_ipd/patientBill/grid', 'PATIENTS_IPD\patientBillController@grid');
//Route::get('/discharge/print/{case_id}', 'dischargeController@printbill')->name('discharge.print');

//IPD Patient Register
Route::resource('/patients_ipd/patientRegsiter', 'PATIENTS_IPD\patientRegsiterController',array(
    'only' => array('index','edit','update')
));
Route::get('/patients_ipd/patientRegsiter/print/{id}', 'PATIENTS_IPD\patientRegsiterController@printbill')->name('IPD.patientRegsiterController.print');
Route::delete('/patients_ipd/patientRegsiter/delete/{id}','PATIENTS_IPD\patientRegsiterController@delete')->name('IPD.patientRegsiterController.delete');
Route::post('/patients_ipd/patientRegsiter/grid', 'PATIENTS_IPD\patientRegsiterController@grid');

Route::resource('ipd-settings', 'IpdSettingController');
Route::post('/update_ipd_perticulars', 'IpdSettingController@update_ipd_perticulars')->name('update_ipd_perticulars');



//================================= ipd payments================================================
Route::get('/add-ipd-payment/{registration_id}', 'PATIENTS_IPD\PaymentsController@add_ipd_payment');
Route::get('/edit-ipd-payment/{registration_id}/{payment_id}', 'PATIENTS_IPD\PaymentsController@edit_ipd_payment');
Route::get('/delete-ipd-payment/{registration_id}/{payment_id}', 'PATIENTS_IPD\PaymentsController@delete_ipd_payment');
Route::get('/print-ipd-payment/{registration_id}/{payment_id}', 'PATIENTS_IPD\PaymentsController@print_ipd_payment');

Route::post('/patients/payments-save', 'PATIENTS_IPD\PaymentsController@save_ipd_payment');

//================================= ipd particulars================================================

Route::get('/hospital-charges-particulars/{registration_id}', 'PATIENTS_IPD\PaymentsController@add_hospital_charges_particulars');
Route::get('/edit-hospital-charges-particulars/{registration_id}/{particular_id?}', 'PATIENTS_IPD\PaymentsController@edit_hospital_charges_particulars');
Route::get('/delete-hospital-charges-particulars/{registration_id}/{particular_id}', 'PATIENTS_IPD\PaymentsController@delete_hospital_charges_particulars');
Route::get('/print-hospital-charges-particulars/{registration_id}/{particular_id?}', 'PATIENTS_IPD\PaymentsController@print_hospital_charges_particulars');
//Route::get('/print-ipd-payment/{registration_id}/{payment_id}', 'PATIENTS_IPD\PaymentsController@print_ipd_payment');

Route::post('/save-hospital-charges-particulars', 'PATIENTS_IPD\PaymentsController@save_hospital_charges_particulars');

//================================= ipd estimate bill ================================================

Route::get('/ipd-estimate-bill/{registration_id}', 'PATIENTS_IPD\PaymentsController@ipd_estimate_bill');
Route::get('/print-ipd-estimate-bill/{registration_id}', 'PATIENTS_IPD\PaymentsController@print_ipd_estimate_bill');
Route::post('/save-ipd-estimate-bill', 'PATIENTS_IPD\PaymentsController@save_ipd_estimate_bill');

Route::get('/ipd-summary-final-bill/{registration_id}', 'PATIENTS_IPD\PaymentsController@ipd_summary_final_bill');
Route::get('/print-ipd-summary-final-bill/{registration_id}', 'PATIENTS_IPD\PaymentsController@print_ipd_summary_final_bill');
Route::post('/save-ipd-summary-final-bill', 'PATIENTS_IPD\PaymentsController@save_ipd_summary_final_bill');



Route::get('/admission-consent/{registration_id?}', 'PatientsController@admission_consent');


Route::get('/manage-advertisement/{id?}', 'IpdSettingController@manage_advertisement');
Route::post('/update-advertisement', 'IpdSettingController@update_advertisement');


//==============================NewHomePageController====================================================
Route::get('/section-slider-footer', 'NewHomePageController@section_slider_footer');
Route::get('/add-section-slider-footer', 'NewHomePageController@add_section_slider_footer');
Route::get('/edit-section-slider-footer/{id?}', 'NewHomePageController@add_section_slider_footer');
Route::post('/manage-section-slider-footer/{id?}', 'NewHomePageController@manage_section_slider_footer');
Route::post('/section-slider-footer-grid', 'NewHomePageController@section_slider_footer_grid');


Route::get('/section-slider-footer2', 'NewHomePageController@section_slider_footer2');
Route::get('/add-section-slider-footer2', 'NewHomePageController@add_section_slider_footer2');
Route::get('/edit-section-slider-footer2/{id?}', 'NewHomePageController@add_section_slider_footer2');
Route::post('/manage-section-slider-footer2/{id?}', 'NewHomePageController@manage_section_slider_footer2');
Route::post('/section-slider-footer2-grid', 'NewHomePageController@section_slider_footer2_grid');


Route::post('/delete-section-slider-footer/{id?}', 'NewHomePageController@delete_section_slider_footer');
Route::post('/delete-section-our-departments/{id?}', 'NewHomePageController@delete_section_slider_footer');

Route::get('/section-our-departments', 'NewHomePageController@section_our_departments');
Route::get('/add-section-our-departments', 'NewHomePageController@add_section_our_departments');
Route::get('/edit-section-our-departments/{id}', 'NewHomePageController@add_section_our_departments');
Route::post('/manage-section-our-departments/{id?}', 'NewHomePageController@manage_section_our_departments');
Route::post('/section-our-departments-grid', 'NewHomePageController@section_our_departments_grid');

Route::get('/list-events', 'NewEventController@list_events');
Route::get('/add-event', 'NewEventController@add_event');
Route::get('/edit-event/{id}', 'NewEventController@add_event');
Route::post('/manage-event/{id?}', 'NewEventController@manage_event');
Route::post('/events-grid', 'NewEventController@new_events_grid');
Route::post('/delete-event/{id?}', 'NewEventController@delete_event');


Route::get('/all-events/{id?}', 'HomeController@show_events');
Route::get('/event-details/{id?}', 'HomeController@event_details');

Route::post('/save-event-comments', 'HomeController@save_event_comments');

Route::post('/like-this-event', 'HomeController@like_event');


Route::get('/list-comments/{id}', 'NewEventController@list_comments');
Route::post('/list-comments-grid', 'NewEventController@list_comments_grid');

Route::post('/delete-comment/{id?}', 'NewEventController@delete_comment');
Route::post('/show-comment/{id?}', 'NewEventController@show_comment');
Route::post('/hide-comment/{id?}', 'NewEventController@hide_comment');

Route::get('/section-work', 'NewHomePageController@section_work');
Route::get('/add-work', 'NewHomePageController@add_section_work');
Route::get('/edit-work/{id}', 'NewHomePageController@add_section_work');
Route::post('/manage-work/{id?}', 'NewHomePageController@manage_section_work');
Route::post('/section-work-grid', 'NewHomePageController@section_work_grid');
Route::post('/delete-work/{id?}', 'NewHomePageController@delete_section_slider_footer');

Route::get('/section-paper-cutting', 'NewHomePageController@section_paper_cutting');
Route::get('/add-paper-cutting', 'NewHomePageController@add_section_paper_cutting');
Route::get('/edit-paper-cutting/{id}', 'NewHomePageController@add_section_paper_cutting');
Route::post('/manage-paper-cutting/{id?}', 'NewHomePageController@manage_section_paper_cutting');
Route::post('/section-paper-cutting-grid', 'NewHomePageController@section_paper_cutting_grid');
Route::post('/delete-paper-cutting/{id?}', 'NewHomePageController@delete_section_slider_footer');


Route::get('/all-works/', 'HomeController@all_works');
Route::get('/all-paper-cuttings/', 'HomeController@all_paper_cttings');


Route::get('/upload-case-form/{case_id}', 'Case_mastersController@upload_case_form')->name('upload-case-form.addEdit');

Route::post('/store-upload-case-form/{id?}', 'Case_mastersController@store_upload_case_form')->name('store-upload-case-form');

Route::post('/print-upload-case-form-image', 'Case_mastersController@print_upload_case_form_image')->name('print-upload-case-form-image');


Route::post('/patients/delete', 'PatientsController@patients_delete');

//---------------------------------------New IPD Bill Reports-------------------------------------------------------
Route::get('/new-ipd-bill-report', 'IpdReportsController@ipdViewReport');
Route::get('/new-ipd-bill-report-grid', 'IpdReportsController@ipdViewReportGrid');//{docid}

Route::get('new-ipd-bill-payment-report', 'IpdReportsController@ipdBillPaymentReport');
Route::get('new-ipd-bill-payment-report-grid', 'IpdReportsController@ipdBillPaymentReportGrid');//{docid}

Route::get('new-ipd-bill-balance-report', 'IpdReportsController@ipdBillBalanceReport');
Route::get('new-ipd-bill-balance-report-grid', 'IpdReportsController@ipdBillBalanceReportGrid');//{docid}
//---------------------------------END New IPD Bill Reports-------------------------------------------------------

Route::get('/section-welcome', 'NewHomePageController@edit_section_welcome');
Route::post('/manage-section-welcome/{id?}', 'NewHomePageController@manage_section_welcome');



Route::get('/section-slider2', 'NewHomePageController@section_slider2');
Route::get('/add-section-slider2', 'NewHomePageController@add_section_slider2');
Route::get('/edit-section-slider2/{id?}', 'NewHomePageController@add_section_slider2');
Route::post('/manage-section-slider2/{id?}', 'NewHomePageController@manage_section_slider2');
Route::post('/section-slider2-grid', 'NewHomePageController@section_slider2_grid');

//=========================== Psychiatrist ============================
//Route::get('/psyciatrist-case-form/{case_id?}', 'PsychiatristController@add')->name('psyciatrist-case-form.add');

Route::get('/psyciatrist-case-form/{case_id?}', 'PsychiatristController@add')->name('psyciatrist-case-form.add');

Route::get('/psyciatrist-case-form-patient/{case_id?}', 'PsychiatristController@add')->name('psyciatrist-case-form.add');
Route::get('/psyciatrist-case-form-doctor/{case_id?}', 'PsychiatristController@add_doctor')->name('psyciatrist-case-form.doctor-form');

Route::post('/save-psychiatrist-case-form/{case_id?}', 'PsychiatristController@save')->name('psyciatrist-case-form.save');
Route::get('/view-psyciatrist-case-form/{case_id?}', 'PsychiatristController@view')->name('psyciatrist-case-form.view');
Route::get('/print-psyciatrist-case-form/{case_id?}', 'PsychiatristController@print')->name('psyciatrist-case-form.print');

Route::post('/save-psychiatrist-notes/{case_id?}', 'PsychiatristController@save_notes')->name('psyciatrist-notes.save');

Route::post('/psychiatrists-delete-note/{note_id?}', 'PsychiatristController@delete_notes')->name('psyciatrist-notes.delete');

Route::post('/save-psychiatrist-followup', 'PsychiatristController@save_followup')->name('save-psychiatrist-followup');


Route::get('/print-psychiatrist-prescription/{case_number}', 'PsychiatristController@printprescription');

Route::get('/print-psychiatrist-notes/{case_number}', 'PsychiatristController@print_notes');

Route::post('get-psychiatrist-prescription-template/{case_number?}', 'PsychiatristController@get_prescription_template');

Route::get('/add-psychiatrist-prescription-dropdowns/{case_number}', 'PsychiatristController@add_prescription_dropdowns');

Route::get('add-psychiatrist-prescription-templates/{case_number?}', 'PsychiatristController@add_prescription_templates');

Route::get('psychiatrist-prescription-templates-listing/{case_number?}', 'PsychiatristController@psychiatrist_priscription_templates');

Route::get('edit-psychiatrist-prescription-templates/{template_id?}/{case_number?}', 'PsychiatristController@edit_prescription_templates');

Route::resource('/ivf', 'IvfController');


Route::get('ivf-icsi/{case_id?}', 'IvfController@ivf_icsi');
Route::get('ivf-icsi-view/{case_id?}', 'IvfController@ivf_icsi_view');
Route::get('ivf-icsi-print/{case_id?}', 'IvfController@ivf_icsi_print');
Route::get('ivf-hcg-injection-sop-print/{case_id?}', 'IvfController@ivf_hcg_injection_sop_print');

Route::get('ivf-od/{case_id?}', 'IvfController@ivf_od');
Route::get('ivf-od-view/{case_id?}', 'IvfController@ivf_od_view');
Route::get('ivf-od-print/{case_id?}', 'IvfController@ivf_od_print');

Route::get('ivf-ed-view/{case_id?}', 'IvfController@ivf_ed_view');
Route::get('ivf-ed-print/{case_id?}', 'IvfController@ivf_ed_print');

Route::get('ivf-fet-view/{case_id?}', 'IvfController@ivf_fet_view');
Route::get('ivf-fet-print/{case_id?}', 'IvfController@ivf_fet_print');

Route::get('ivf-ed/{case_id?}', 'IvfController@ivf_ed');
Route::get('ivf-fet/{case_id?}', 'IvfController@ivf_fet');


Route::post('save-ivf/{case_id?}', 'IvfController@save_ivf');
Route::get('/ivf-form/{Id}','IvfController@ivf_form')->name('ivf-form');


Route::get('/upload-document-listing','UploadDocumentController@upload_listing')->name('upload-document-listing');
Route::get('/upload-document/{Id}','UploadDocumentController@upload_document')->name('upload-document');
Route::post('/store-upload-document/{id?}', 'UploadDocumentController@store_upload_document')->name('store-upload-document');

Route::get('/ipd-upload-document/{Id}','UploadDocumentController@ipd_upload_document')->name('ipd-upload-document');
Route::post('/ipd-store-upload-document/{id?}', 'UploadDocumentController@ipd_store_upload_document')->name('ipd-store-upload-document');


Route::get('/upload-reports-listing','UploadDocumentController@upload_reports_listing')->name('upload-reports');
Route::get('/upload-reports/{Id}','UploadDocumentController@upload_reports')->name('upload-reports');
Route::post('/store-upload-reports/{id?}', 'UploadDocumentController@store_upload_reports')->name('store-upload-reports');

Route::get('/ipd-upload-reports/{Id}','UploadDocumentController@ipd_upload_reports')->name('ipd-upload-reports');
Route::post('/ipd-store-upload-reports/{id?}', 'UploadDocumentController@ipd_store_upload_reports')->name('ipd-store-upload-reports');

Route::get('/upload-report-documents-listing','UploadDocumentController@upload_listing')->name('upload-repot-documents-listing');
Route::get('/upload-report-documents/{Id}','UploadDocumentController@upload_report_documents')->name('upload-repot-documents');
//Route::post('/store-upload-report-documents', 'UploadDocumentController@store_upload_report_documents')->name('store-upload-repot-documents');

Route::post('/store-upload-report-documents/{id?}', 'UploadDocumentController@store_upload_report_documents')->name('store-upload-report-documents');


Route::get('/ipd-upload-report-documents/{Id}','UploadDocumentController@ipd_upload_report_documents')->name('ipd-upload-repot-documents');
Route::post('/ipd-store-upload-report-documents/{id?}', 'UploadDocumentController@ipd_store_upload_report_documents')->name('ipd-store-upload-report-documents');

Route::get('/patients_history_sheet/{registration_id}', 'PatientsController@patients_history_sheet');
Route::get('/patients_history_sheet/print/{registration_id}', 'PatientsController@patients_history_sheet_print');

Route::post('/save-history-sheet', 'PatientsController@save_history_sheet');

Route::delete('/delete-dropdown-db-val/{Id}','EyeFormController@delete_dropdown_db_val')->name('delete-dropdown-db-val');

//============================================================================

Route::get('daily-order-sheet/{case_id?}', 'DailyOrderSheetController@add');
Route::get('daily-order-sheet-view/{case_id?}', 'DailyOrderSheetController@view');
Route::get('daily-order-sheet/print/{case_id?}', 'DailyOrderSheetController@print');
Route::post('daily-order-sheet/{case_id?}', 'DailyOrderSheetController@save');

Route::get('rbs-insulin-chart/{case_id?}', 'RbsInsulinChartController@add');
Route::get('rbs-insulin-chart-view/{case_id?}', 'RbsInsulinChartController@view');
Route::get('rbs-insulin-chart/print/{case_id?}', 'RbsInsulinChartController@print');
Route::post('rbs-insulin-chart/{case_id?}', 'RbsInsulinChartController@save');

Route::get('tpr-monitoring-chart/{case_id?}', 'TprMonitoringChartController@add');
Route::get('tpr-monitoring-chart-view/{case_id?}', 'TprMonitoringChartController@view');
Route::get('tpr-monitoring-chart/print/{case_id?}', 'TprMonitoringChartController@print');
Route::post('tpr-monitoring-chart/{case_id?}', 'TprMonitoringChartController@save');

Route::get('treatment-medication-sheet/{case_id?}', 'TreatmentMedicationSheetController@add');
Route::get('treatment-medication-sheet-view/{case_id?}', 'TreatmentMedicationSheetController@view');
Route::get('treatment-medication-sheet/print/{case_id?}', 'TreatmentMedicationSheetController@print');
Route::post('treatment-medication-sheet/{case_id?}', 'TreatmentMedicationSheetController@save');

Route::get('nurses-over-report/{case_id?}', 'NursesOverReportController@add');
Route::get('nurses-over-report-view/{case_id?}', 'NursesOverReportController@view');
Route::get('nurses-over-report/print/{case_id?}', 'NursesOverReportController@print');
Route::post('nurses-over-report/{case_id?}', 'NursesOverReportController@save');

//===============================================================================

Route::get('/add-hospital-charges-particulars-template/{registration_id?}', 'PATIENTS_IPD\PaymentsController@add_hospital_charges_particulars_template');

Route::post('update-hospital-charges-particulars-template/{case_number?}', 'PATIENTS_IPD\PaymentsController@update_hospital_charges_particulars_template');

Route::get('hospital-charges-particulars-templates-listing/{case_number?}', 'PATIENTS_IPD\PaymentsController@hospital_charges_particulars_templates_listing');

Route::post('hospital-charges-particulars-templates-listing-grid', 'PATIENTS_IPD\PaymentsController@hospital_charges_particulars_templates_listing_grid');

Route::get('edit-hospital-charges-particulars-template/{template_id?}/{case_number?}', 'PATIENTS_IPD\PaymentsController@edit_hospital_charges_particulars_template');

Route::post('get-hospital-charges-particulars-template/{case_number?}', 'PATIENTS_IPD\PaymentsController@get_hospital_charges_particulars_template');

Route::get('delete-hospital-charges-particulars-template/{template_id?}/{case_number?}', 'PATIENTS_IPD\PaymentsController@delete_hospital_charges_particulars_template');

//============================= new web template ========================================
Route::get('certificate-list','HomepageController@certificate_list')->name('certificate-list');
Route::get('add-certificate','HomepageController@add_certificate')->name('add-certificate');
Route::post('save-certificates','HomepageController@save_certificate')->name('save-certificates');
Route::get('delete-certificate/{id}','HomepageController@delete_certificate')->name('delete-certificate');

Route::get('services-list','HomepageController@service_list')->name('services-list');
Route::get('add-services','HomepageController@add_service')->name('add-services');
Route::post('save-service','HomepageController@save_service')->name('save-service');
Route::get('delete-services/{id}','HomepageController@delete_service')->name('delete-services');

Route::get('consultant-list','HomepageController@consultant_list')->name('consultant-list');
Route::get('add-consultant','HomepageController@add_consultant')->name('add-consultant');
Route::post('save-consultant','HomepageController@save_consultant')->name('save-consultant');
Route::get('delete-consultant/{id}','HomepageController@delete_consultant')->name('delete-consultant');


Route::get('feedback-list','HomepageController@feedback_list')->name('feedback-list');
Route::get('add-feedback','HomepageController@add_feedback')->name('add-feedback');
Route::post('save-feedback','HomepageController@save_feedback')->name('save-feedback');
Route::get('delete-feedback/{id}','HomepageController@delete_feedback')->name('delete-feedback');

Route::get('new-dynamic-text-list','HomepageController@new_dynamic_text_list')->name('new-dynamic-text-list');
Route::get('add-new-dynamic-text','HomepageController@add_new_dynamic_text')->name('add-new-dynamic-text');
Route::get('edit-new-dynamic-text/{id}','HomepageController@edit_new_dynamic_text')->name('edit-new-dynamic-text');
Route::post('save-new-dynamic-text','HomepageController@save_new_dynamic_text')->name('save-new-dynamic-text');
Route::get('delete-new-dynamic-text/{id}','HomepageController@delete_new_dynamic_text')->name('delete-new-dynamic-text');

Route::get('new-edit-settings','HomepageController@edit_settings')->name('new-edit-settings');
Route::post('new-update-settings','HomepageController@new_update_settings')->name('new-update-settings');

Route::get('new-home-slider-list','HomepageController@new_home_slider_list')->name('new-home-slider-list');
Route::get('new-home-slider-add','HomepageController@new_home_slider_add')->name('new-home-slider-add');
Route::get('new-home-slider-edit/{id}','HomepageController@new_home_slider_edit')->name('new-home-slider-edit');
Route::post('new-home-slider-update/{id?}','HomepageController@update_image_gallery')->name('new-home-slider-update');
Route::post('new-home-slider-grid', 'HomepageController@slider_grid');
Route::post('new-home-slider-delete/{id}', 'HomepageController@slider_delete');

Route::get('new-iamge-gallery-list','HomepageController@new_image_gallery_list')->name('new-iamge-gallery-list');
Route::get('new-iamge-gallery-add','HomepageController@new_image_gallery_add')->name('new-iamge-gallery-add');
Route::get('new-iamge-gallery-edit/{id}','HomepageController@new_image_gallery_edit')->name('new-iamge-gallery-edit');
//============================= end new web template ====================================

Route::get('/new-gallery', 'NewfrontendController@Imagaegallery');
Route::get('/client-feedback', 'NewfrontendController@client_feedback');
Route::post('/save-client-feedback', 'NewfrontendController@save_client_feedback');

Route::get('/all-doctors', 'NewfrontendController@all_doctors');
Route::delete('delete-rating/{RatingId}','RatingController@delete_rating');

//============================ 2 apr 2023 ============================
Route::get('/patients/discharge_2023/{registration_id}', 'PatientsController@discharge_2023');
Route::post('dynamic-field/insert-discharge', 'DynamicFieldController@insert_discharge')->name('dynamic-field.insert-discharge');
Route::post('dynamic-field/dynamic-field.get-record', 'DynamicFieldController@get_record')->name('dynamic-field.get-record');
Route::post('/Patients/save-discharge-2023', 'PatientsController@save_discharge_2023');

Route::get('/patients/discharge/print_2023/{discharge_id}', 'PatientsController@patients_discharge_print_2023');


