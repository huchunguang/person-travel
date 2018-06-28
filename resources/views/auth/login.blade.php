@extends('app')
@section('content')
<div class="container-fluid" style="margin-top:10%;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="/auth/login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label"><span class="regist-star">*</span>Username</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="UserName" value="{{ old('UserName') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"><span class="regist-star">*</span>Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="Pwd">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"></label>
							<div class="col-md-6">
								<label> <input type="checkbox" class="icheck" name="remember" value="1" {{old('remember')?'checked':''}}>  Remember Me</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Login
								</button>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$('input').iCheck({checkboxClass: 'icheckbox_minimal-green'});
</script>
@endsection
