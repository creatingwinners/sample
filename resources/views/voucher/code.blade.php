@extends('layouts.form')

@section('content')
    <div class="container">
    		<div class="col-md-6">
    			<div class="content bg-light-blue radius-15 p-3 p-lg-5 mb-lg-0">
    				<form method="POST" id="form" action="{{ route('voucher.verify') }}" autocomplete="off">
                        {{ csrf_field() }}
    					<div class="form-group mt-2 mt-lg-0">
                            <input name="code" type="text" class="form-control" id="code" placeholder="Code">
                            <div class="invalid-feedback text-left"></div>
    					</div>
    					<div class="form-group">
                            <input value="" name="email" type="text" class="form-control" id="email" placeholder="E-mail">
                            <div class="invalid-feedback text-left"></div>
    					</div>
    					<div class="custom-control custom-checkbox mb-3 mb-lg-5">
    						<input name="akkoord" value="yes" type="checkbox" class="custom-control-input" id="akkoord">
    						<label class="custom-control-label noselect" for="akkoord">Yes, agree with terms</label>
    					</div>
    					<button type="submit" class="btn-submit" id="submitButton">Submit</button>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@endsection
