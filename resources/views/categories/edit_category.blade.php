@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>

<script>

$(document).ready(function() {
        //$('.js-example-basic-single').select2();
    });

</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">


        <section class="content">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Category</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{route('category.update',$category->id)}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Name<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input value="{{$category->name}}" type="text" name="name" class="form-control" required="" autocomplete="FALSE" aria-invalid="false">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="parent_category" type="hidden" value="{{$category->parent_category_id}}" />
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Parent Category<span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <select id="parent_category_id" class="form-control" style="width: 100%;" name="parent_category_id" id="parent_category_id">         
                                                            <option value="">Select Parent Category</option>
                                                            @foreach($categories as $categorylist)
                                                                <option  value="{{$categorylist->id}}">{{$categorylist->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4"> 
                                                <div class="form-group demo-checkbox">
                                                <br>
                                                    <input type="checkbox" value="{{$category->is_active}}" id="is_active" class="filled-in" name="is_active" >
                                                    <label id="is_active_label" for="is_active">Active</label>
                                                </div>
                                            </div>
                                            <input id="isactive" type="hidden">

                                        </div>

                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" value="Submit" class="btn btn-rounded btn-info">
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

    </div>
</div>
<!-- /.content-wrapper -->

<script>

    $(document).ready(function() {

        $("#parent_category_id").select().val($("#parent_category").val()).trigger('change');

        if($("#is_active").val() == 1){
            $("#is_active").prop('checked', true);
            $("#is_active").val(1);
        }else{
            $("#is_active").prop('checked', false);
            $("#is_active").val(0);
        }

        
    });

    var is_active = document.querySelector("#is_active");

    is_active.addEventListener('change', function() {
    if (this.checked) {
        $("#is_active_label").html("Active");
        $("#is_active").val(1);
    } else {
        $("#is_active_label").html("Inactive");
        $("#is_active").val(0);
    }
});

    

</script>

@endsection