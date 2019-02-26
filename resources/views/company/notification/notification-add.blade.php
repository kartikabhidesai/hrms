@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		{{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','id' => 'taxId' )) }}
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Sent Notification</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>

				<div class="ibox-content">
					<div class="form-group">
						<h2>Coming Soon</h2>
					<!--	<label class="col-lg-2 control-label">Tax</label>
						<div class="col-lg-6">
							 {{ Form::text('amount', isset($taxResult) ? $taxResult->tax_amount : '' , array('placeholder'=>'Tax','max'=>'100', 'class' => 'form-control amount' ,'required')) }} -->
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="col-lg-offset-2 col-lg-9">
							<button class="btn btn-sm btn-primary" type="submit">Save</button>
						</div>
					</div> -->
				</div>
			</div>
		</div>	
		{{ Form::close() }}
	</div>
</div>

@endsection