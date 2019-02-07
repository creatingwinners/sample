@extends('layouts.simple')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header">
                        Voucher
                    </div>
                    <div class="card-body">
                        <p>
                            Invalid code
                        </p>
                        <p>
                            <a href="{{ route('voucher.welcome') }}">Again</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
