<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Menu_list;
use App\dynamic_text;
use App\Image_gallery;
use Storage;
use HTML;
use App\helperClass\drAppHelper;
use App\quantity_dropdown;
use App\strength_dropdown;
use App\number_of_times_dropdown;
use App\Models\IPD\patientRegister;
use App\Models\IPD\ipd_prescription;
use App\Models\form_dropdowns;
use App\Setting;
use App\NewHomePage;
use DB;
use App\helperClass\CommonHelper;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $commonHelper = new CommonHelper();
        view()->share('commonHelper', $commonHelper);

		view()->composer(array('shared.layoutProspera','shared.layout2022'), function($view) {
            
            $all_settings = Setting::all()->keyBy('name');
            
            //dd($all_settings);
            
            //$new_all_settings = DB::table('new_settings')->get()->keyBy('name');
            
            //dd($new_all_settings['hospital_logo']);
            
            $menulst = Menu_list::where('isActive', 1)->orderBy('orderNo')->get();
            
            //dd($menulst);
            
            //====================================================================================
            $new_all_settings['top_slider_text'] = DB::table('new_settings')->where('name', 'top_slider_text')->first(); 
            $new_all_settings['logo'] = DB::table('new_settings')->where('name', 'hospital_logo')->first(); 
            $new_all_settings['call_now'] = DB::table('new_settings')->where('name', 'call_now')->first(); 
            $new_all_settings['appointment_link'] = DB::table('new_settings')->where('name', 'appointment_link')->first(); 
            $new_all_settings['fb_link'] = DB::table('new_settings')->where('name', 'fb_link')->first(); 
            $new_all_settings['insta_link'] = DB::table('new_settings')->where('name', 'insta_link')->first(); 
            $new_all_settings['twitter_link'] = DB::table('new_settings')->where('name', 'twitter_link')->first(); 
            $new_all_settings['whatsapp'] = DB::table('new_settings')->where('name', 'whatsapp')->first(); 
            $new_all_settings['address'] = DB::table('new_settings')->where('name', 'address')->first(); 
            
            
            $new_all_settings['email'] = DB::table('new_settings')->where('name', 'email')->first(); 
            $new_all_settings['call_us'] = DB::table('new_settings')->where('name', 'call_us')->first(); 
            $new_all_settings['google_map'] = DB::table('new_settings')->where('name', 'google_map')->first(); 
            $new_all_settings['copyright'] = DB::table('new_settings')->where('name', 'copyright')->first(); 
			
			
            $new_all_settings['google_map'] = DB::table('new_settings')->where('name', 'google_map')->first(); 
            $new_all_settings['copyright'] = DB::table('new_settings')->where('name', 'copyright')->first(); 
			
			$new_all_settings['homepage_slider_images'] = DB::table('new_web_image_gallery')->where('displayed_in', 'homeSlider')->get(); 
            $new_all_settings['services_data'] = DB::table('tbl_service_main')->get();
            
            $new_all_settings['header_color'] = DB::table('new_settings')->where('name', 'header_color')->first(); 
            $new_all_settings['footer_color'] = DB::table('new_settings')->where('name', 'footer_color')->first(); 
            
            //dd($new_all_settings);
            
           
            //============================================================
            $sql = "SELECT menu_list.*, dynamic_text.id as dynamic_text_id, dynamic_text.html_text FROM menu_list LEFT JOIN dynamic_text ON dynamic_text.relationshipKey = menu_list.id where menu_list.isActive = '1' order by parentId";
            $menu_result = DB::select($sql);
            
            
            
            $menu = [];
            if(!empty($menu_result)) {
                 foreach($menu_result as $all_data_row) {
                         if($all_data_row->parentId) {
                                 $menu['submenu'][$all_data_row->parentId][] = (array) $all_data_row;
                         } else {
                                 $menu['mainmenu'][$all_data_row->id] = (array) $all_data_row;
                         }
                 }
            }
            //dd($menu);
            $new_all_settings['menu'] = $menu;
             
            //============================================================
           
          
   //        echo "=============".__LINE__; //exit;
 //dd($new_all_settings);
            //dd($address);
            //=====================================================================================
            
            $footerText = dynamic_text::where('isActive', 1)->where('textType',5)->first();
            $footerText->html_text = isset($footerText->html_text)?HTML::decode($footerText->html_text) : '';
            //$imageGallery = Image_gallery::where('isActive', 1)->get();
            $bodyOne = dynamic_text::where('textType', 3)->first();
            $siteLogo = Image_gallery::where('isActive', 1)->where('imgTypeId',2)->first();
            $siteLogo = (empty($siteLogo) || !isset($siteLogo->imgUrl)) ? config('app.name', 'Dr App') : Storage::disk('local')->url($siteLogo->imgUrl);
            
             //echo "=============".__LINE__; exit;
            $view->with('menulst', $menulst)->with('siteLogo',$siteLogo)->with('footerText', $footerText)->with('bodyOne', $bodyOne)->with('all_settings', $all_settings)->with('new_all_settings', $new_all_settings);//->with('title',$title);
        });
        //
        view()->composer(array('shared.layoutProspera','shared.layoutCaremed', 'shared_new.layout2022', 'shared_new.layout2022_no_head_foot'), function($view)
        {
            
            $all_settings = Setting::all()->keyBy('name');
            
            $menulst = Menu_list::where('isActive', 1)->orderBy('orderNo')->get();
            
            $menulst = Menu_list::where('isActive', 1)->orderBy('orderNo')->get();
            $footerText = dynamic_text::where('isActive', 1)->where('textType',5)->first();
            $footerText->html_text = isset($footerText->html_text)?HTML::decode($footerText->html_text) : '';
            //$imageGallery = Image_gallery::where('isActive', 1)->get();
            $bodyOne = dynamic_text::where('textType', 3)->first();
            $siteLogo = Image_gallery::where('isActive', 1)->where('imgTypeId',2)->first();
            $siteLogo = (empty($siteLogo) || !isset($siteLogo->imgUrl)) ? config('app.name', 'Dr App') : Storage::disk('local')->url($siteLogo->imgUrl);
            
            $departments_data = NewHomePage::where('type', 'section_departments')->where('is_active', '1')->get();
			$welcome_data = NewHomePage::where('type', 'section_welcome')->where('is_active', '1')->first();
            
            
            $footerAddress = dynamic_text::where('isActive', 1)->where('textType',6)->first();
            $footerAddress->html_text = isset($footerAddress->html_text)?HTML::decode($footerAddress->html_text) : '';
            
            
           // dd($slider_footer_data);
            $view->with('menulst', $menulst)->with('siteLogo',$siteLogo)->with('footerText', $footerText)->with('bodyOne', $bodyOne)->with('all_settings', $all_settings)->with('departments_data', $departments_data)->with('welcome_data', $welcome_data)->with('welcome_data', $welcome_data)->with('footerAddress', $footerAddress);//->with('title',$title);
        });

        view()->composer('shared.add_prescription' ,function($view)
        {
            $id = $view->getData()['id'];
            $drAppHelper = new drAppHelper;
            $getdata = $drAppHelper->getCaseData($id);
            $presDropdowns = [
            'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
            'quantity'=>form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
            'medicine_strength'=>form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText'),
            'medicinlist' => \App\Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get()
            ];
            $mergeArray = array_merge($getdata, $presDropdowns);
            $view->with('casedata', $mergeArray);
        });
        
        view()->composer('ipd_discharge.prescription_add' ,function($view)
        {
            $id = $view->getData()['id'];
            $drAppHelper = new drAppHelper;
            $patientRegister = patientRegister::firstOrNew(['id'=>$id]);
            $prescriptionList = $patientRegister->ipd_prescription()->get();
            $presDropdowns = [
            'numberOfTimes_drpdwn' => form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Times a day')->pluck('ddText','ddText'),
            'quantity'=>form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Quantity')->pluck('ddText','ddText'),
            'medicine_strength'=>form_dropdowns::where('formName', 'Prescription')->where('fieldName', 'Strength')->pluck('ddText','ddText'),
            'medicinlist' => \App\Medical_store::where('isactive', 1)->where('balance_quantity', '>', 0)->orderBy('created_dt', 'desc')->get()
            ];
            $mergeArray = compact('patientRegister', 'presDropdowns', 'prescriptionList');
            //dump($mergeArray);
            $view->with(compact('patientRegister', 'presDropdowns', 'prescriptionList'));
        });
        
        view()->composer('ipd_dailyTreatment.DailyNotes' ,function($view)
        {
            $id = $view->getData()['id'];
            $patientRegister  = patientRegister::firstOrNew(['id'=>$id]);
            $view->with('patientRegister', $patientRegister);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
