@extends('layouts.form')

@section('content')
    <div class="container">
    	<div class="row">
    		<div class="col-md-6">
				<h1 class="mb-3">
                    Bad luck!!!!
                    <br />
                    <span class="small">No price for you this time.</span>
                </h1>
				<p>
                    Try again, we hope to see you back soon, {{ $actie->name }}.
                </p>
    		</div>
    	</div>
    </div>
@endsection
