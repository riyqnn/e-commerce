@extends('admin.admin_master')
@section('content')

<section class="content">
    <div class="row">
    <div class="col-8">
    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Slider list</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                   <tr>
                       <th>Slider image</th>
                       <th>Title</th>
                       <th>Description</th>
                       <th>Status</th>
                       <th>Action</th>
                   </tr>
               </thead>
               <tbody>
                    @foreach ($sliders as $item)
                    <tr>
                        <td><img style="width:300px;" src="{{asset($item->slider_img)}}"></td>
                        <td>
                            @if ($item->title === NULL)
                                <span class="badge badge-danger">No Title</span>
                            @else
                                {{$item->title}}
                            @endif
                        </td>
                        <td>{{$item->description}}</td>
                        <td>
                            @if ($item->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">InActive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('slider.edit',$item->id)}}" class="btn btn-primary mb-5">Edit</a>
                            <a href="{{ route('slider.delete',$item->id)}}" class="btn btn-danger mb-5" id="delete">Delete</a>
                            @if ($item->status == 1)
                            <a href="{{ route('slider.inactive', $item->id) }}" class="btn btn-danger mb-2" title="InActive">
                                <i class="fa fa-arrow-down"></i>
                            </a>       
                            @else
                            <a href="{{ route('slider.active', $item->id) }}" class="btn btn-primary mb-2" title="Active">
                                <i class="fa fa-arrow-up"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
               </tbody>
             </table>
           </div>
        </div>
       <!-- /.box-body -->
     </div>
     <!-- /.box -->
    </div>
   <!-- /.col -->
   <div class="col-4">
    <div class="box">
       <div class="box-header with-border">
         <h3 class="box-title">Add Slider</h3>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
           <div class="table-responsive">
            <form method="post" action="{{ route('slider.store')}}" enctype="multipart/form-data">
            @csrf
                <div class="col-12">
                    <div class="form-group">
                        <h5>Title</h5>
                        <div class="controls">
                            <input type="text" name="title" class="form-control"> 
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Description</h5>
                        <div class="controls">
                            <input type="text" name="description" class="form-control"> 
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Slider Image</h5>
                        <div class="controls">
                            <input type="file" name="slider_img" class="form-control">
                            @error('slider_img')
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Slider">
                    </div>
                </div>
            </form>
           </div>
        </div>
       <!-- /.box-body -->
     </div>
     <!-- /.box -->
    </div>
   <!-- /.col -->
      
 </div>
</div>
</section>
<!-- /.content-wrapper -->


@endsection