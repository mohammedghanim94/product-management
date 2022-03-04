@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black" style="background: {{asset('admin/images/gallery/full/10.jpg')}}  center center;">
                            <h3 class="widget-user-username">{{$user->name}}</h3>
                            <a href="{{route('edit.profile',$user->id)}}" style="float: right" class="btn btn-rounded btn-success mb-5">Edit Profile</a> 
                            <h6 class="widget-user-desc">{{$user->usertype}}</h6>
                        </div>
                        <div class="widget-user-image">
                            <img class="rounded-circle" height="128px" width="128px" src="{{$user->image ? asset($user->image) : asset('admin/images/user3-128x128.jpg')}}" alt="User Avatar">
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$user->mobile}}</h5>
                                        <span class="description-text">Mobile No</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 br-1 bl-1">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$user->address}}</h5>
                                        <span class="description-text">Address</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$user->gender}}</h5>
                                        <span class="description-text">Gender</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->

@endsection