@extends('layouts.form')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 formulier order-md-1 mb-5">
                <form id="addressForm" action="{{ route('voucher.save') }}" autocomplete="off" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="hash" value="{{ \Hashids::encode($voucher->id) }}" />

                    <div class="form-group mt-2 mt-lg-0">
                        <label for="naam">Name</label>
                        <input class="form-control" type="text" id="naam" name="naam" placeholder="Name">
                        <div class="invalid-feedback text-left"></div>
                    </div>
                    <div class="form-group mt-2 mt-lg-0">
                        <label for="adres">Address</label>
                        <input class="form-control" type="text" id="adres" name="adres" placeholder="Address">
                        <div class="invalid-feedback text-left"></div>
                    </div>
                    <div class="form-group mt-2 mt-lg-0">
                        <label for="huisnummer">Housenumber</label>
                        <input class="form-control" type="text" id="huisnummer" name="huisnummer" placeholder="Housenumber">
                        <div class="invalid-feedback text-left"></div>
                    </div>
                    <div class="form-group mt-2 mt-lg-0">
                        <label for="postcode">Zipcode</label>
                        <input class="form-control" type="text" id="postcode" name="postcode" placeholder="Zipcode">
                        <div class="invalid-feedback text-left"></div>
                    </div>
                    <div class="form-group mt-2 mt-lg-0">
                        <label for="woonplaats">City</label>
                        <input class="form-control" type="text" id="woonplaats" name="woonplaats" placeholder="City">
                        <div class="invalid-feedback text-left"></div>
                    </div>

                    <button type="submit" class="btn-submit mt-4">Verzenden</button>
                </form>
            </div>
        </div>
    </div>

@endsection
