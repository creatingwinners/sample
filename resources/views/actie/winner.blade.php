@extends('layouts.form')

@section('content')
    <div class="container">
    	<div class="row">
    		<div class="col-md-6 text-center order-md-1 mt-3 mb-5 m-xl-0">
				<h1 class="mb-5">
                    Grats!
                    <br />
                    <span class="small">You've won a price!</span>
                </h1>
				<p>
                    Check your mail
                </p>
                <p>
                    We hope to see you back soon, {{ $actie->name }}.
                </p>
    		</div>
    	</div>
    </div>
@endsection
