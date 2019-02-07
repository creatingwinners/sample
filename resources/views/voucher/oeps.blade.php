@extends('layouts.simple')

@section('content')
    <div class="container">
    		<div class="col-md-6">
				<h1 class="mb-5">
                    Oops,
                    <br>
                    <span class="small">something went wrong...</span>
                </h1>
				<p class="mb-5">
                    Code already used?
                    <br class="d-none d-lg-inline d-xl-none">Something else went wrong?</p>
				<a href="{{ route('voucher.code') }}" class="btn-yellow mt-3 mt-lg-5">Try again</a>
    		</div>
    	</div>
    </div>
@endsection
