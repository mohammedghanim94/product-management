@extends('admin.admin_master')
@section('admin')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">

        <section class="content">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Update User</h4>
                    <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{route('update.profile',$user->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>User Name<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input value="{{$user->name}}" type="text" name="name" class="form-control" required="" autocomplete="FALSE" aria-invalid="false">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>User Email<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input value="{{$user->email}}" type="email" name="email" class="form-control" autocomplete="FALSE" required="">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>User Mobile<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input value="{{$user->mobile}}" type="text" name="mobile" class="form-control" required="" autocomplete="FALSE" aria-invalid="false">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>User Address<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input value="{{$user->address}}" type="address" name="address" class="form-control" autocomplete="FALSE" required="">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>User Gender<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="gender" id="gender" selected="" required="" class="form-control">
                                                            <option value="">Select Role</option>
                                                            <option value="Male" {{$user->gender == "Male" ? "selected" : ""}}>Male</option>
                                                            <option value="Female" {{$user->gender == "Female" ? "selected" : ""}}>Female</option>
                                                        </select>
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>Profile Image</h5>
                                                            <div class="controls">
                                                                <input onchange="putImage()" type="file" name="image" id="image" class="form-control">
                                                                <div class="help-block"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <img style="width: 100px; height: 100px;" src="{{asset($user->image)}}" id="target" class="form-control" required="">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" value="Update" class="btn btn-rounded btn-info">
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
<script type="text/javascript">
    
    function showImage(src, target) {
        var fr = new FileReader();
        fr.onload = function() {
            target.src = fr.result;
        }
        fr.readAsDataURL(src.files[0]);
    }

    function putImage() {
        var src = document.getElementById("image");
        var target = document.getElementById("target");
        showImage(src, target);
    }
</script>
@endsection