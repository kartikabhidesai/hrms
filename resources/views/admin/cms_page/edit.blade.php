@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Edit form</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="#">Config option 1</a>
							</li>
							<li><a href="#">Config option 2</a>
							</li>
						</ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a> -->
					</div>
				</div>
				<div class="ibox-content">
					{{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'editCms' )) }}
				
					<div class="form-group"><label class="col-lg-2 control-label">Description</label>
						<div class="col-lg-9">
							<textarea class="summernote" name="cms_content">@php  echo $detail['description'];  @endphp</p></textarea>
						</div>
					</div>	
				<!-- 	<div class="form-group"><label class="col-lg-2 control-label">Last Name</label>
						<div class="col-lg-9">
							<div class="ibox-content no-padding">
								<div class="summernote">
									<h3>Lorem Ipsum is simply</h3>
									dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
									when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
									typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
									<br/>
									<br/>
									<ul>
										<li>Remaining essentially unchanged</li>
										<li>Make a type specimen book</li>
										<li>Unknown printer</li>
									</ul>
								</div>

							</div>
						</div>
					</div> -->

					{{ Form::hidden('edit_id', $detail->id, array('class' => '')) }}
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-9">
							<button class="btn btn-sm btn-primary" type="submit">Save</button>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>	
	</div>
	

</div>

@endsection

