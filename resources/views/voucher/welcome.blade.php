@extends('layouts.simple')

@section('content')
    <div class="container">
    	<div class="row">
    		<div class="col-md-6">
    			<div class="content fill bg-light-blue radius-15 p-3 p-lg-5">
    				<a href="{{ route('voucher.code') }}" class="btn btn-primary">Continue</a>
    			</div>
    		</div>
    	</div>
    </div>
@endsection
