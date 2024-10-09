@extends('admin.admin_master')

@section('content')
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="container-full">   
		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">Edit Profile </h3> 
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">

					<form method="post" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
					@csrf

					  <div class="row">
						<div class="col-12">	
							
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<h5>Username <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="text" name="name" class="form-control" required=""
											value="{{$editData->name}}"> </div>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group">
										<h5>Email <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="email" name="email" class="form-control" required=""
											value="{{$editData->email}}"> </div>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<h5>Profile image <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="file" id="image" name="profile_photo_path" class="form-control" required> </div>
									</div>
								</div>	

								<div class="col-6">
									<img class="rounded-circle" id="showImage" src="{{(!empty($adminData->profile_photo_path))? url('upload/admin_image/'.$adminData->profile_photo_path):url('upload/no_image.jpg') }}" alt="User " style="width: 100px; height:100px;">
								</div>	


						   <div class="text-xs-right">
							 <input type="submit" class="btn btn-rounded btn-primary mb-5" value="update">
						   </div>
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
		<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>


<script type="text/javascript">
  $(document).ready(function() {
	$(`#image`).change(function(e) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$(`#showImage`).attr('src',e.target.result);	
		}
		reader.readAsDataURL(e.target.files['0']);
	});
  });
</script>

@endsection
