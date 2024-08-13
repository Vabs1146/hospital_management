@extends('adminlayouts.master')
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
<link href="{{ url('/')}}/select2/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
<!--                <form  class="form-horizontal" id="sectionform" action="#"  method="post">-->
                    {{ csrf_field() }}

                    <div class="header bg-pink">
                        <h2>User Access New</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix ">
                            <div class="col-md-12 col=md-offset-3">
                                <div class="col-md-2">
                                    <div class="form-group labelgrp">
                                        <label for="case_number">Select User :</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select id="user_id" name="user_id" class="form-control select2"  required="" data-live-search='true'>
                                            <option selected value disabled>Select User</option>
                                            @foreach($user_list as $userlist)
                                            <option value="{{ $userlist->id }}" {{$userlist->id == $user_id  ? 'selected' : ''}}>{{ $userlist->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </div>
                            @if($user_id != "" && $user_id > 0)
                            <div class="col-md-12">
                                <div class="body table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="sectiontable" name="sectiontable">
                                        <thead>
                                            <tr>
                                                <th align='center' class="never">Section Id</th>
                                                <th align='center'>Section Name</th>
                                                <th align=''><input type="checkbox" id="selectallList" data-type="List" name="isActiveList" class="filled-in" /><label for="selectallList">Listing</label></th>
                                                <th align=''><input type="checkbox" id="selectallView" data-type="View" name="isActiveView" class="filled-in" /><label for="selectallView">View</label></th>
                                                <th align=''><input type="checkbox" id="selectallAdd" data-type="Add" name="isActiveAdd" class="filled-in" /><label for="selectallAdd">Add</label></th>
                                                <th align=''><input type="checkbox" id="selectallEdit" data-type="Edit" name="isActiveEdit" class="filled-in" /><label for="selectallEdit">Edit</label></th>
                                                <th align=''><input type="checkbox" id="selectallDelete" data-type="Delete" name="isActiveDelete" class="filled-in" /><label for="selectallDelete">Delete</label></th>
                                            </tr>
                                        </thead>
                                        <tbody>
@php $parent_menu=""; @endphp
                                            @foreach($sectionlist as $sectionlist)
                                            @if($parent_menu != $sectionlist->parent_menu)
                                                    @php $parent_menu = $sectionlist->parent_menu;@endphp
                                                    
                                                    
                                            <tr><td colspan="7"></td></tr>
                                               <tr><td colspan="3">{{$sectionlist->parent_title}}</td><td colspan="4"></td></tr>
                                            @endif
                                            <tr>
                                                <td>{{ $sectionlist->sectionid }}
                                                    <input type="hidden" name="sectionid" id="sectionid" value="{{ $sectionlist->sectionid }}">
                                                </td>
                                                <td>{{ $sectionlist->menu_title }}
                                                    <input type="hidden" name="sectionname" id="sectionname" value="{{ $sectionlist->menu_title }}"></td>
<td>
    <div class="demo-checkbox">
        <input type="checkbox" id="selectrecList{{$sectionlist->sectionid}}" data-section="{{$sectionlist->sectionid}}" data-col="listing_permission" name="selectrecList[]" class="chk selectrecList" value="{{ $sectionlist->sectionid }}" <?php echo ($sectionlist->listing_permission == "1") ? "checked" : "unchecked"; ?> class="filled-in">
        <label for="selectrecList{{$sectionlist->sectionid}}"></label>
    </div>
</td>
<td>
    <div class="demo-checkbox">
        <input type="checkbox" id="selectrecView{{$sectionlist->sectionid}}" data-section="{{$sectionlist->sectionid}}" data-col="view_permission" name="selectrecView[]" class="chk selectrecView" value="{{ $sectionlist->sectionid }}" <?php echo ($sectionlist->view_permission == "1") ? "checked" : "unchecked"; ?> class="filled-in">
        <label for="selectrecView{{$sectionlist->sectionid}}"></label>
    </div>
</td>
<td>
    <div class="demo-checkbox">
        <input type="checkbox" id="selectrecAdd{{$sectionlist->sectionid}}" data-section="{{$sectionlist->sectionid}}" data-col="add_permission" name="selectrecAdd[]" class="chk selectrecAdd" value="{{ $sectionlist->sectionid }}" <?php echo ($sectionlist->add_permission == "1") ? "checked" : "unchecked"; ?> class="filled-in">
        <label for="selectrecAdd{{$sectionlist->sectionid}}"></label>
    </div>
</td>
<td>
    <div class="demo-checkbox">
        <input type="checkbox" id="selectrecEdit{{$sectionlist->sectionid}}" data-section="{{$sectionlist->sectionid}}" data-col="edit_permission" name="selectrecEdit[]" class="chk selectrecEdit" value="{{ $sectionlist->sectionid }}" <?php echo ($sectionlist->edit_permission == "1") ? "checked" : "unchecked"; ?> class="filled-in">
        <label for="selectrecEdit{{$sectionlist->sectionid}}"></label>
    </div>
</td>
<td>
    <div class="demo-checkbox">
        <input type="checkbox" id="selectrecDelete{{$sectionlist->sectionid}}" data-section="{{$sectionlist->sectionid}}" data-col="delete_permission" name="selectrecDelete[]" class="chk selectrecDelete" value="{{ $sectionlist->sectionid }}" <?php echo ($sectionlist->delete_permission == "1") ? "checked" : "unchecked"; ?> class="filled-in">
        <label for="selectrecDelete{{$sectionlist->sectionid}}"></label>
    </div>
</td>

                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            @endif    
                        </div>
                    </div>
<!--                    <div class="panel-footer">
                        <button type="button" class="btn btn-lg btn-success" id="btnsbmit">Save </button>
                    </div>-->
<!--                </form>-->
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="{{ url('/')}}/select2/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
});
$(".select2").select2();
$(document).ready(function () {

    sectiontable = $('#sectiontable1').dataTable({
        "ordering": false,
        stateSave: true

    });



// Handle click on "Select all" control
    /*    $('#selectallList').on('click', function () {
        if($(this).is(':checked')) {
            alert('checked');
        sectiontable.$(".selectrecList").prop('checked', $(this.checked));
    } else {
            alert('un checked');
        sectiontable.$(".selectrecList").removeAttr('checked');
    }
    });
    */
    
    $('#selectallList').on('click', function () {
        sectiontable.$(".selectrecList").prop('checked', $(this).is(':checked'));
        
        sectiontable.$(".selectrecList").each(function() {
            console.log('list_permission' +$(this).data('section') +' || '+$(this).is(':checked'));
        });
    });
    
    $('#selectallView').on('click', function () {
        sectiontable.$(".selectrecView").prop('checked', $(this).is(':checked'));
    });
    
    $('#selectallAdd').on('click', function () {
        sectiontable.$(".selectrecAdd").prop('checked', $(this).is(':checked'));
    });
    
    $('#selectallEdit').on('click', function () {
        sectiontable.$(".selectrecEdit").prop('checked', $(this).is(':checked'));
    });
    
    $('#selectallDelete').on('click', function () {
        sectiontable.$(".selectrecDelete").prop('checked', $(this).is(':checked'));
    });

   
    
    $('.chk').on('click', function () {
        console.log($(this).data('col') +$(this).data('section') +' || '+ $(this).is(':checked'));
        var update_value = $(this).is(':checked') ? 1 : 0;
        update_permission($(this).data('section'), $(this).data('col'), update_value);
    });
});

function update_permission(section_id, column_name, update_value) {
     var user_id = $("#user_id").val();
    $.ajax({
        url: "{{route('update-permission')}}",
        type:"post",
        data: {'user_id' : user_id, 'section_id' : section_id, 'column_name' : column_name, 'update_value' : update_value},
        datatype:'json',
        success: function(response) {
            console.log(response);
        }
    });
}
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#user_id').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var user_id = this.value;
            var url1 = "{{url('user-permissions')}}/" + user_id;
            window.location.replace(url1);

        });
    });

</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#btnsbmit").click(function () {
            var user_id = $("#user_id").val();
            if (!$('#user_id').val()) {
                alert("Please Select User First");
            } else
            {


                ckb = $(".chk").is(':checked');
                if (ckb)
                {
                    var accesslevel = 1;
//alert(accesslevel);
                } else
                {
                    var accesslevel = 0;
//alert(accesslevel);
                }
                var data = $("#sectionform").serialize();
                var url1 = "{{url('savesection')}}/" + accesslevel + "/" + user_id;

                $.ajax({
                    url: url1,
                    type: 'POST',
                    data: data,
                    success: function (data)
                    {

                        swal({title: "Access Granted", text: "Successfully!!!", type: "success"},
                                function () {
                                    location.reload();
                                }
                        );
                    }
                });

            }


        });
    });

</script>
<script src="{{ url('/')}}/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>


@endsection