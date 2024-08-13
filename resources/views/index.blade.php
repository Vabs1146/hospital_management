@extends('adminlayouts.master')
@section('content')
<section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                               Dashboard
                            </h2>
                           
                        </div>
                        <div class="body">
                            @if(isset(Auth::user()->email))
                Welcome {{ Auth::user()->name }} You are logged in!
                  @else
                   Welcome Admin.   You are notsd logged in!
                     @endif
                        </div>
                    </div>
                </div>
              
            </div>
            </div>
          </section>

@endsection