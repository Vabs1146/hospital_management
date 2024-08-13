@extends(env('layoutTemplate'))
@section('pagebody')
<!-- ===================================================================================================== -->
<!-- Start Body section -->
 
 <section class="pt-breadcrumb" style="background: url('assets/img/conatcbg.jpg');">
   <div class="pt-bg-overley pt-opacity4" ></div>
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <h1 class="pt-breadcrumb-title">Gallery</h1>
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page"> Gallery</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </section>

  <section class="gallerysec pt-80 pb-80">
      <div class="container">
         <div class="">
            <div class="ourProtfolio">
               <div class="row" id="Gallery">
			   @foreach($gallery_images as $gallery_images_row) 
                     <a href="{{url('/')}}/uploads/images/{{ $gallery_images_row->imgUrl }}" class="content col-sm-4 mb-30">
                        <div class="lg-imgbox">
                           <img src="{{url('/')}}/uploads/images/{{ $gallery_images_row->imgUrl }}" class="img-responsive" alt="" />
                           <div class="demo-gallery-poster">
                                 <h3><span class="ti-plus"></span></h3>
                           </div>
                        </div>
                     </a>
				@endforeach

                 
                  
               </div>
            </div>
         </div>
      </div>
  </section>
  
<!-- End of Body section -->
<!-- ===================================================================================================== -->
@endsection