<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\dynamic_text;

use DB;
use Storage;
use Response;
use HTML;
use Auth;
use App\Helpers\Helpers;

class dynamic_textController extends AdminRootController
{

    public function edit(Request $request, $textType, $relationshipKey)
    {
        if(empty($textType)){
             return Response::make('Not found',404);
        }
        $dynamic_text = dynamic_text::where('textType','=',$textType)->where('relationshipKey','=',$relationshipKey)->first();
        if(empty($dynamic_text)){
            $dynamic_text = new dynamic_text;
            $dynamic_text->textType = $textType;
            $dynamic_text->relationshipKey = $relationshipKey;
        }else{
            $dynamic_text->html_text = HTML::decode($dynamic_text->html_text);
        }
        return view('dynamic_text.add', ['model' => $dynamic_text]);
    }

    public function update(Request $request)
    {
        $dynamic_text = null;
        if ($request->id > 0) {
            $dynamic_text = dynamic_text::findOrFail($request->id);
        } else {
            $dynamic_text = new dynamic_text;
        }
		if($request->hasFile('uploadeImage')) {	
			$image = $request->file('uploadeImage');

			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'gallery_image/';
			$image->move($destinationPath, $name);
			$dynamic_text->image = $name;
		}
        $dynamic_text->html_text = HTML::entities($request->html_text);
        $dynamic_text->textType = $request->textType;
        $dynamic_text->relationshipKey = $request->relationshipKey;
        $dynamic_text->name = $request->name;
        $dynamic_text->description = $request->description;
        $dynamic_text->meta_title = $request->meta_title;
        $dynamic_text->meta_desc = $request->meta_desc;
        $dynamic_text->meta_key = $request->meta_key;
        $dynamic_text->isActive = is_null($request->isActive)?0:1;
        $dynamic_text->save();
          //  \LogActivity::addToLog('dynamic text  updated successfully');
        return back()->withInput()->with('flash_message', 'Record added/updated successfully');
    }


    public function TinyMCEUpload(Request $request){
        
        $imgUrl = $request->file('file')->store('uploads');
        $imgUrl = Storage::disk('local')->url($imgUrl);
        return "<script>top.$('.mce-btn.mce-open').parent().find('.mce-textbox').val('" . $imgUrl . "').closest('.mce-window').find('.mce-primary').click();</script>";
    }
}
