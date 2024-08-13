{{-- 

    Reference taken from :- https://itsolutionstuff.com/post/bootstrap-star-rating-example-using-bootstrap-star-rating-pluginexample.html
<!DOCTYPE html>
<html>
<head>
	<title>Bootstrap star rating example</title>
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
</head>
<body>


<div class="container">


	<h2>Bootstrap star rating example</h2>


    <br/>
    <label for="input-1" class="control-label">Give a rating for Skill:</label>
    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2">


    <br/>
    <label for="input-2" class="control-label">Give a rating for Knowledge:</label>
    <input id="input-2" name="input-2" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="4">


    <br/>
    <label for="input-3" class="control-label">Give a rating for PHP:</label>
    <input id="input-3" name="input-3" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="5">


</div>


<script>
$("#input-id").rating();
</script>


</body>
</html> --}}



@extends('shared.layoutProspera')
@section('pageheader')
<!-- Bootstrap Core CSS -->
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

	<style>
	    
	    .rating-container .filled-stars {
            position: absolute;
            left: 0;
            top: 0;
            margin: auto;
            color: #fde16d !important;
            white-space: nowrap;
            overflow: hidden;
            -webkit-text-stroke: 1px #777;
            text-shadow: 1px 1px #999;
	    }
	    
	    i, .icon {
	        color: #fde16d !important;
	    }
	    
        .feedbackdesign .modal-content {
            padding: 22px;
        }

        .star_rating {
    position: relative;
    padding: 10px;
    box-shadow: 0px 0px 7px 0px #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.star_rating .user_img img {
    width: 81px;
    height: 81px;
    padding: 0px;
    margin-top: 4px;
    border-radius: 50%;
    border: 1px solid #ccc;
}

.user_info h4 {
    margin-top: 0;
    margin-bottom: 10px;
}

.user_img {
    position: absolute;
}

.user_info {
    padding-left: 83px;
}
.rating-md {
    font-size: 2em !important;
}
.modal-header .close {
    margin-top: -46px;
    margin-left: -24px;
}
	</style>

@endsection 
@section('pagebody')
<article>

<div class="row" style="padding-top: 6px;">

 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1" style="margin-left: 211px;margin-top: 6px;">Add rating</button>
 <div class="col-md-6">
  <div class="feedbackdesign">
        <div id="myModal1" class="modal fade" style="padding-top: 27px;">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">       
            <form class="form-horizontal" name="AddFeedback" id="AddFeedback"  action="{{ url('/AddRating/Submit') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type="hidden" id="hdnCsrfToken" data-token="{{ csrf_token() }}"/>
                <div class="modal-header">
                    <h4 class="modal-title">Provide Feedback</h4>
                    <button type="button" class="close" data-dismiss="modal"><span style="margin-right: -21px;">×</span>
                                                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        @include('shared.error') 
                        @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                                {{ Session::get('flash_message') }}
                            </div>
                        @endif
                    </div>
                  

                    <div class="form-group">
                        <label for="feedback" class="control-label" >Name:</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>

                      <div class="form-group" >
                        <label for="feedback" class="control-label">Mobile No:</label>
                        <input type="text" class="form-control" name="mobileno" id="mobileno">
                    </div>

                     <div class="form-group" >
                        <label for="feedback" class="control-label">User Image:</label>
                        <input type="file" class="form-control" name="userimage" id="userimage" >
                    </div>  

                    <div class="form-group">
                        <label for="feedback" class="control-label">Provide Feedback:</label>
                        <textarea type="text" class="form-control" id="feedback" name="feedback" placeholder="Feedback" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ratingscore" class="control-label">Give a rating for Skill:</label>
                        <input id="ratingscore" name="ratingscore" class="rating rating-loading" data-min="0" data-max="5"
                            data-step="1" value="0">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" id="submitBtn"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..">Submit</button>
                    <a href="{{ url('/') }}" class="btn btn-default" > Home </a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
 <div class="col-md-8 col-md-offset-2">
     

    <div id="myModal" class="" role="dialog">
        <div class="modal-dialog">
        
            <div class="modal-content">   
    <ul class="list-group list-group-flush">
    @foreach ($ratingLst as $item)
        <li class="list-group-item">

            <div class="star_rating">
            <div class="user_img">
                <img src="{{ asset('images')}}/{{$item->userimage}}" alt="">
                
            </div>
            <div class="user_info">
                <h4>{{ $item->username}}</h4>
                <div>
                     <input id="ratingscore" name="ratingscore" value="{{$item->ratingscore}}" class="rating rating-loading" data-min="0" data-max="5"
                            data-step="1" value="0" readonly>
                </div>
                <p> {{ $item->feedback or "" }}</p>
            </div>
        </div>

           
            <br/>
           
        </li>
    @endforeach
    </ul>
    </div>
    </div>
    </div>
</div> 


        

</div>
<article>
@endsection 
@section('footescripts')

<script src="{{ asset('js/jquery.min.js')}} "></script>
<script src="{{ asset('js/jquery.easing.1.3.js') }} "></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script>    
$(document).ready(function(){
    //$("#ratingscore").rating();
});
</script>
@endsection