@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>



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
                            <form action="{{route('category.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Name<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control" required="" autocomplete="FALSE" aria-invalid="false">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Parent Category<span class="text-danger"></span></h5>
                                                    <div class="controls">
                                                        <select class="form-control" style="width: 100%;" name="parent_category_id" id="parent_category_id">         
                                                            <option value="">Select Parent Category</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4"> 
                                                <div class="form-group demo-checkbox">
                                                <br>
                                                    <input type="checkbox" id="is_active" class="filled-in" name="is_active" checked="">
                                                    <label id="is_active_label" for="is_active">Active</label>
                                                </div>
                                            </div>

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
        $('.js-example-basic-single').select2();
    });

    var is_active = document.querySelector("#is_active");

    is_active.addEventListener('change', function() {
    if (this.checked) {
        $("#is_active_label").html("Active");
    } else {
        $("#is_active_label").html("Inactive");
    }
});

    

</script>

@endsection