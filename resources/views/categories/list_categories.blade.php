@extends('admin.admin_master')
@section('admin')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	  <div class="container-full">


		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Categories List</h3>
                  <a href="{{route('category.add')}}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Category</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <th>#</th>
								<th>Category Name</th>
								<th>Parent Category Name</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($categories as $category)
                            <?php if($category->is_active == 1){
                                $class = "badge badge-success-light badge-lg";
                                $status = "Active";
                            } else{
                                $class = "badge badge-danger-light badge-lg";
                                $status = "Inactive";
                            } ?>
							<tr>
                                <td>{{$categories->firstItem()+$loop->index}}</td>
								<td>{{$category->name}}</td>
								<td>{{$category->ParentCategory ? $category->ParentCategory->name : $category->ParentCategory}}</td>
								<td><span class="{{$class}}">{{$status}}</span></td>
								<td>
									<a href="{{route('category.edit',$category->id)}}" class="btn btn-info" >Edit</a>
									<a href="{{route('category.delete',$category->id)}}" id="delete" class="btn btn-danger">Delete</a>
								</td>
							</tr>
                            @endforeach
					  </table>
                      {{$categories->links()}}
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			  <!-- /.box -->          
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>
  <!-- /.content-wrapper -->

@endsection