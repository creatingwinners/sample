@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt-4">

        <div class="row mt-4">
            <div class="col-md-3">
                <form method="POST" action="{{ route('maandprijs.select') }}" id="maandprijsWinnaarZoek">
                    @csrf
                    <input type="hidden" name="winner" id="winnerId" />
                    <div class="card">
                        <div class="card-header">
                            <span class="font-weight-bold">Criteria</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Action(s)</label>
                                <div class="col-sm-8">

                                    @foreach ($acties as $actie)
                                        @if($actie->active == true && $actie->start_at <= date('Y-m-d') && $actie->end_at >= date('Y-m-d'))

                                            <div class="form-check">
                                                <input name="actie[{{ $actie->id }}]" class="form-check-input" type="checkbox" value="{{ $actie->id }}" id="actie{{ $actie->id }}">
                                                <label class="form-check-label" for="actie{{ $actie->id }}">
                                                    {{ $actie->name }}
                                                </label>
                                            </div>

                                        @endif
                                    @endforeach

                                    <hr />

                                    @foreach ($acties as $actie)
                                        @if($actie->active != true || $actie->start_at > date('Y-m-d') || $actie->end_at < date('Y-m-d'))

                                            <div class="form-check">
                                                <input name="actie[{{ $actie->id }}]" class="form-check-input" type="checkbox" value="{{ $actie->id }}" id="actie{{ $actie->id }}">
                                                <label class="form-check-label" for="actie{{ $actie->id }}">
                                                    {{ $actie->name }}
                                                </label>
                                            </div>

                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">From</label>
                                <div class="col-sm-8">
                                    <input name="start" type="date" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Till</label>
                                <div class="col-sm-8">
                                    <input name="end" type="date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Search candidate</button>
                            <hr class="saveWinner d-none" />
                            <button type="button" class="btn btn-success btn-block saveWinner d-none" id="saveWinner">
                                Save as monthprice winner
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-9 d-none" id="resultatenContent">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2">Candidate</th>
                                </tr>
                            </thead>
                            <tbody id="contender"></tbody>
                        </table>
                    </div>
                    <div class="col">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2">Voucher</th>
                                </tr>
                            </thead>
                            <tbody id="voucher"></tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="5" id="deelnames-title">Participations</th>
                                </tr>
                            </thead>
                            <tbody id="deelnames"></tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="6">Other participants with same ip address</th>
                                </tr>
                            </thead>
                            <tbody id="anderen"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('#maandprijsWinnaarZoek').submit(function(e) {
                if($(this).attr('action') != '{{ route('maandprijs.save') }}') {
                    e.preventDefault();
                    $('#winnerId').val('');
                    $.ajax({
                        dataType: 'json',
                        url: $(this).attr('action'),
                        data: $(this).serializeArray(),
                        method: 'post',
                        statusCode: {
                            422: function(data) {
                                console.log(data);
                            },
                            200: function(data) {
                                showResults(data);
                            }
                        }
                    });
                } else {
                    return true;
                }
            });
            $('#saveWinner').click(function(e) {
                e.preventDefault();
                if(confirm('Save as winner?')) {
                    $('#maandprijsWinnaarZoek').attr('action', '{{ route('maandprijs.save') }}');
                    $('#maandprijsWinnaarZoek').submit();
                }
            });
        });

        function showResults(data)
        {
            $('#winnerId').val(data.win_voucher.id);

            var contender = '';
            contender += '<tr><td>Mail</td><td>'+data.participant.email+'</td></tr>';
            if(data.win_voucher.naam) {
                contender += '<tr><td>Name</td><td>'+data.win_voucher.naam+'</td></tr>';
                contender += '<tr><td>Address</td><td>'+data.win_voucher.adres+' '+data.win_voucher.huisnummer+'</td></tr>';
                contender += '<tr><td>City</td><td>'+data.win_voucher.postcode+' '+data.win_voucher.woonplaats+'</td></tr>';
            }

            var voucher = '';
            voucher += '<tr><td>Action</td><td>'+data.win_voucher.actie.name+'</td></tr>';
            voucher += '<tr><td>Voucher</td><td>'+data.win_voucher.code+'</td></tr>';
            voucher += '<tr><td>Participation</td><td>'+data.win_voucher.updated_at+'</td></tr>';
            voucher += '<tr><td>IP address</td><td>'+data.win_voucher.ipaddress+'</td></tr>';

            var deelnames = '<tr><th>Action</th><th>Voucher</th><th>Prijs</th><th>Participation</th><th>IP</th></tr>';
            $.each(data.all_vouchers, function(i, e) {
                var price = '';
                if(e.price_id != null) {
                    price = e.price.short;
                }
                deelnames += '<tr><td>'+e.actie.name+'</td><td>'+e.code+'</td><td>'+price+'</td><td>'+e.updated_at+'</td><td>'+e.ipaddress+'</td></tr>';
            });

            if(data.other_participants.length == 0) {
                var anderen = '<tr><td colspan="6" class="text-center">No data</td></tr>';
            } else {
                var anderen = '<tr><th>Action</th><th>Voucher</th><th>Mail</th><th>Prijs</th><th>Participation</th><th>IP</th></tr>';
                $.each(data.other_participants, function(i, e) {
                    var price = '';
                    if(e.price_id != null) {
                        price = e.price.short;
                    }
                    anderen += '<tr><td>'+e.actie.name+'</td><td>'+e.code+'</td><td>'+e.participant.email+'</td><td>'+price+'</td><td>'+e.updated_at+'</td><td>'+e.ipaddress+'</td></tr>';
                });
            }

            $('#contender').html(contender);
            $('#voucher').html(voucher);
            $('#deelnames-title').html(data.participant.email);
            $('#deelnames').html(deelnames);
            $('#anderen').html(anderen);
            $('#resultatenContent').removeClass('d-none');
            $('.saveWinner').removeClass('d-none');
        }
    </script>

@endsection
