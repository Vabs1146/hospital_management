@extends('adminlayouts.master')

@php //echo "========= <pre>"; print_r($sp_test_image); exit;@endphp
@section('style')
<style>
    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }

</style>

<style>

    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}


    @media screen and (max-width: 767px) {
        .select2 {
            width: 100% !important;
        }
    }
    .ui-autocomplete-loading {
        background: white url("{{asset('images/ui-anim_basic_16x16.gif')}}") right center no-repeat;
    }

    .canvas{
        position:relative; width:150px; height:200px; background-color:#7a7a7a; margin:70px auto 20px auto;
    }
    #button {
  display: inline-block;
  background-color: #FF9800;
  text-decoration: none;
  width: 36px;
  height: 37px;
  text-align: center;
  border-radius: 4px;
  position: fixed;
  bottom: 52px;
  right: 33px;
  transition: background-color .3s, 
    opacity .5s, visibility .5s;
  opacity: 0;
  color: white;
  visibility: hidden;
  z-index: 1000;
}
#button::after {
 
  font-family: 'Material Icons';
  font-weight: bolder;
  font-style: normal;
  font-size: 1em;
  line-height: 40px;
  color: white;
}
#button:hover {
  cursor: pointer;
  background-color: #333;
}
#button:active {
  background-color: #555;
}
#button.show {
  opacity: 1;
  visibility: visible;
}
.details-section {
    color: initial;
    /* background-color: white; */
    text-align: center;
    margin-bottom: 7px;
    padding-top: 4px;
    padding-bottom: 1px;
    margin-top: -2px;
}

</style>

<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

{{--
<div class="container-fluid">
    <div class="list-group list-group-horizontal">
       @foreach ($casedata['DateWiseRecordLst'] as $VisitListDateWise)
                @if($casedata['id'] == $VisitListDateWise['id'])
                    <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item active">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>    
                @else
                    <a href="{{ url('/PatientMedicalDetails').'/'.$VisitListDateWise['id'] }}" class="list-group-item">{{ Carbon\Carbon::parse($VisitListDateWise['created_at'])->format('d-M-Y') }}</a> <span> &nbsp;</span>
                @endif
        @endforeach
    </div>
</div>
--}}
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('shared.error')
                          @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                          {{ Session::get('flash_message') }}
                          </div>
                          @endif
                       <div class="card">
           
           {{ Form::model($casedata, array('route' => array('ipd-store-upload-document'), 'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data' )) }}
            {{ csrf_field() }}
                         <div class="header bg-pink">
                            <h2>
                               Manage Documents
                            </h2>
                          
                        </div>
                        <div class="body">
                          {{ Form::hidden('id', Request::old('id'), array('class'=> 'form-control')) }}
                          <div class="row clearfix">
                          
                       
                          <div class="col-md-12">
<div class="col-md-12">
<label>Uploads : </label>
<input type="file" class="img-thumb-upload" id="sp_test_images" name="sp_test_images[]"  multiple="">
</div>

</div>

<div class="col-md-12">
<?php foreach ($sp_test_image as  $k=>$value) { ?>
<div class="col-md-3 image-div">
<input type="hidden" name="old_images[]" value="{{$value['id']}}">
<div class="form-group">
<img class="show-image" data-src="{{ asset('/sp_test_images/'.$value['filePath']) }}" src="{{ asset('/sp_test_images/'.$value['filePath']) }}" height="200px" width="200px" style="margin: 10px;" data-image_title="{{$value['title']}}">
<input type="text" class="input-image-title" name="old_images_title[{{$value['id']}}]" value="{{$value['title']}}">
<a href="javascript:void(0)" class="btn btn-info remove-image">Remove</a>
	</div>
</div>
<?php } ?>

</div>
<!---------------follow-up-date---------------------->   

                   
                       
 <!---------------follow-up-date---------------------->       

                           
                            <div class="row clearfix">
                            <div class="col-md-8 col-md-offset-3">
                            <div class="">
                            <button type="submit" name="submit" class="btn btn-success btn-lg" value="submit" >
                            <i class="fa fa-plus"></i> Submit
                            </button>
                                <a class="btn btn-default btn-lg" href="{{ url('/case_masters') }}"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
                              
                                </div>
                                </div>
                               
                            </div>

                            
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>


</div>

  <div class="modal fade" id="img_Modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_title">Document</h4>
        </div>
        <div class="modal-body"  id='print_ascan_document'>
			<img style="width: 100%;" id="modal_img" src="">
			<div id="image_data"></div>
        </div>
        <div class="modal-footer">
          <!-- <button type="button"  onclick='printDiv();' class="btn btn-default">print</button>  -->
		  
		  <form method="POST" action="{{url('/print-upload-case-form-image')}}">
		  {{ csrf_field() }}
			<input type="hidden" id="image_to_print" name="image_to_print" value="">
			<input type="hidden" id="image_to_print_title" name="image_to_print_title" value="">

			<input class="btn btn-default" type="submit" name="submit" value="Print" formtarget="_blank">
		  </form>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
 <script src="{{ url('/')}}/select2/js/select2.min.js"></script>
   <script type="text/javascript">
     $(document).ready(function() {
     });
     $(".select2").select2();
   </script>


    <script type="text/javascript">
    
    $(document).ready(function(){

	//=========================================================================================
 $("#appointment_dt").on('change.dp', function (e) {            });
     $(document).on('click', '#slotsrec input[type="radio"]', function() {
     //alert($(this).val());
     $("#FollowUpTimeSlot").empty();
      $("#FollowUpTimeSlot").val($(this).val());
    });
	//==============================================================================================
    });



	$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {

	$(".img-thumb-upload").on("change", function(event) {

        console.log("File uploaded");
      var files = event.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
         
		   $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
			"<br/><input name=\"new_image_title[]\" type=\"text\" class=\"input-title form-control\"/>" +
			"<br/><div style='display:none;'><textarea name=\"new_image_data[]\" >" + e.target.result + "</textarea></div>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter('#'+event.target.id);

		  $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }

	});
</script>

<script>
	function printDiv() 
{
	var divToPrint=document.getElementById('print_ascan_document');
	var modal_img=document.getElementById('modal_img');
	/*
	//alert('hjiiiiiiiiiiii');
var divToPrint=document.getElementById('print_ascan_document');
var newWin=window.open('','Print-Window');
newWin.document.open();
newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
newWin.document.close();
setTimeout(function(){newWin.close();},10);
*/

var win = window.open(modal_img.src, '_blank');
if (win) {
    //Browser has allowed it to be opened
    win.focus();
} else {
    //Browser has blocked it
    alert('Please allow popups for this website');
}

}

	$(document).on('click', '.show-image', function() {
		//alert($(this).data('src'));
		$('#image_data').html('');
		$('#modal_img').attr('src', $(this).data('src'));
		$('#image_data').html($(this).data('info'));
		$('#modal_title').html($(this).data('image_title'));


		$('#image_to_print').val($(this).data('src'));
		$('#image_to_print_title').val($(this).data('image_title'));

		
		$('#img_Modal').modal('show');
	});

	$('.remove-image').click(function() {
		$(this).closest('.image-div').remove();
   });
  </script>
<!-- jQuery Easing -->


@endsection


