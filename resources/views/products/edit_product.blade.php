@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-full">
        
        <input id="all_tags" type="hidden" value="{{$tags}}" />
        <section class="content">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Update Product</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <h5>Product Name<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" value="{{$product->name}}" class="form-control" required="" autocomplete="FALSE" aria-invalid="false">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <h5>Description<span class="text-danger"></span></h5>
                                                    <textarea name="description" rows="5" cols="5" class="form-control">{{$product->description}}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <input id="category" type="hidden" value="{{$product->category_id}}" />
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5>Product Category<span class="text-danger"></span></h5>
                                                        <div class="controls">
                                                            <select class="form-control" style="width: 100%;" name="category_id" id="category_id">
                                                                <option value="">Select Product Category</option>
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Tags<span class="text-danger"></span></h5>
                                                        <div class="controls">
                                                            <select class="form-control select2 js-example-basic-single" multiple style="width: 100%;" name="tags" id="tags">
                                                            <?php  $all_tagss = explode(',',$product->tags); ?>
                                                                @foreach ($all_tagss as $taag) 
                                                                    <option selected value="{{$taag}}" >{{$taag}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block"></div>
                                                        </div>
                                                        <input type="hidden" value="{{$product->tags}}" id="product_tags" name="product_tags" />
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="image" class="form-label">Product Picture</label>
                                                        <input type="file" id="image" name="image" class="form-control" >
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <img id="target" src="{{asset($product->picture)}}" style="height: 300px;width: 300px;">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>
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

    var all_tags = $("#all_tags").val();
    var temp = all_tags.split(',');

    $(document).ready(function() {

        $('#tags').select2({
            tags: temp,
            tokenSeparators: [",", ""]
        });

        $("#category_id").select().val($("#category").val()).trigger('change');

        $('#tags').select2({
            tags: temp,
            tokenSeparators: [",", ""]
        });

        $('#tags').on('select2:select', function (e) {
        var data = e.params.data;
        $('#product_tags').val($(this).val().toString());
    });

    });

    $("#image").change(function() {
        putImage();
    });

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