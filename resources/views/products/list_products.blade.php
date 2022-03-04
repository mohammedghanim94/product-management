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
				  <h3 class="box-title">Products List</h3>
                  <a href="{{route('product.add')}}" style="float: right" class="btn btn-rounded btn-success mb-5">Add Product</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <th>#</th>
								<th>Name</th>
                                <th>Description</th>
								<th>Category</th>
                                <th>Tags</th>
								<th>Picture</th>
								<!--<th>Created Before</th>-->
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($products as $product)
							<tr>
                                <td>{{$products->firstItem()+$loop->index}}</td>
								<td>{{$product->name}}</td>
                                <td>{{$product->description}}</td>
								<td>{{$product->ProductCategory->name}}</td>
                                <td><?php $product_tags = explode(',',$product->tags);
                                    foreach($product_tags as $tag){
                                        echo '<span class="badge badge-dark">'.$tag.'</span>&nbsp;&nbsp;';
                                    }                                   
                                ?></td>
								<td><img src="{{asset($product->picture)}}" style="height: 40px; width: 70px;"></td>
								<!--<td>
									@if($product->created_at == NULL)
									<span class="text-danger">No Date Set</span>
									@else
									{{ Carbon\Carbon::parse($product->created_at)->diffforHumans() }}
                            	</td>-->
								@endif
								<td>
									<a href="{{route('product.edit',$product->id)}}" class="btn btn-info" >Edit</a>
									<a href="{{route('product.delete',$product->id)}}" id="delete" class="btn btn-danger">Delete</a>
								</td>
							</tr>
                            @endforeach
					  </table>
                      {{$products->links()}}
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