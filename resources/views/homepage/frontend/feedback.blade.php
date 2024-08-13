@extends(env('layoutTemplate'))
@section('pagebody')
<style>
iframe {
    width: 100%;
    height: 400px;
}
</style>
<!-- ===================================================================================================== -->
<!-- Start Body section -->
 
 <section class="pt-breadcrumb" style="background: url('assets/img/conatcbg.jpg');">
   <div class="pt-bg-overley pt-opacity4" ></div>
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <h1 class="pt-breadcrumb-title">Feedback</h1>
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page"> Feedback</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </section>

       <div class="contact-sec pt-50 pb-50">
    <div class="container">
         <div class="col-md-7 col-sm-6 mob-plr-0">
            <div class="contact-form">
                
                <div class="section-head">
                    @include('shared.error') 
					@if(Session::has('flash_message'))
						<div class="alert alert-success">
							{{ Session::get('flash_message') }}
						</div>
					@endif
                </div>
                <!-- <form action="contactmail.php" method="post"> -->

				<form action="{{url('save-client-feedback')}}" method="post" enctype="multipart/form-data">
                   <div class="row">
                       <div class="col-sm-12 mob-plr-0">
                           <input  type="text" name="username" class="text-box" placeholder="Name" id="" required>
                       </div> 
                   </div>
                   <div class="row">
                       <div class="col-sm-6 mob-plr-0">
                           <input type="file" required name="userimage" class="text-box" placeholder="Mobile" id="">
                       </div>
                       <div class="col-sm-6 mob-plr-0">
                           <input class="text-box" type="text" maxlength="10" onkeypress="return ValDigit(this);" placeholder="Mobile Number" name="mobileno" required>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-sm-12 mob-plr-0">
                           <input id="ratingscore" name="ratingscore" class="rating rating-loading" data-min="0" data-max="5"
                            data-step="1" value="0">
                       </div> 
                   </div>
                   <div class="row">
                       <div class="col-sm-12 mob-plr-0">
                           <textarea required name="feedback" class="text-box text-area" id="" cols="30" rows="4" placeholder="Feedback"></textarea>
                       </div> 
                   </div>
                   <div class="row">
                       <div class="col-sm-12 mob-plr-0">
                           <input type="submit" name="submit" value="Submit" class="btn1 ">
                           
                       </div>
                   </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 col-sm-6 mob-plr-0">
            <div class="contact-details">

                <!-- <div class="section-head">
                    <div class="mt-separator-outer separator-left ">
                        <div class="mt-separator">
                            <h2 class="text-uppercase sep-line-one "><span class="font-weight-300 text-primary">CONTACT</span> DETAILS</h2>
                        </div>
                    </div>
                </div> -->
                <ul class="details-box">
                   <li>
                       <div class="details-icons">
                        <span class="ti-location-pin"></span>
                       </div>
                       <div class="details-info">
                           <h5>Address :</h5>
                           <p><?php echo isset($address->value) ? $address->value : ''?></p>
                       </div>
                   </li>
                   <li>
                       <div class="details-icons">
                         <span class="ti-email"></span>
                       </div>
                       <div class="details-info">
                           <h5>Email :</h5>
                           <p><a href="mailto:<?php echo isset($email->value) ? $email->value : ''?>"><?php echo ($email->value) ? $email->value : ''?></a> </p>
                       </div>
                   </li>
                   <li>
                       <div class="details-icons">
                       <span class="ti-mobile"></span>
                       </div>
                       <div class="details-info">
                           <h5>Call Us:</h5>
                           <p>  <a href="tel:+91 <?php echo isset($call_us->value) ? $call_us->value : ''?>">+91 <?php echo ($call_us->value) ? $call_us->value : ''?></a></p>
                       </div>
                   </li>
                   
                  
                </ul>
            </div>
        </div>
        
    </div>
</div>


  
<!-- End of Body section -->
<!-- ===================================================================================================== -->
@endsection

@section('footescripts')

@endsection