@extends('layouts.form')

@section('content')
    <div class="container">
		<div class="col-md-6">
			<h1 class="mb-5">Oops</h1>
			<p class="mb-5">
                {{ $actie->name }} hasn't started or is already ended.
            </p>
		</div>
    </div>
@endsection
