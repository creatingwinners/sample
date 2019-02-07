@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col">
                <table class="table table-bordered" id="participant-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Action</th>
                            <th>Code</th>
                            <th>Coupon</th>
                            <th>Price</th>
                            <th>Participant</th>
                            <th>IP</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            var table = $('#participant-table').DataTable({
                processing: true,
                serverSide: true,
                @if(isset($actie))
                    ajax: '{!! route('participant.data_actie', [$actie->id]) !!}',
                @else
                    ajax: '{!! route('participant.data') !!}',
                @endif
                order: [[ 7, "desc" ]],
                rowId: "id",
                dom: '<"row d-flex justify-content-between"<"col align-self-center table-data-info"><"col"f>><"row"<"col"tr>><"row d-flex justify-content-between"<"col align-self-center"l><"col align-self-center"i><"col"p>>',
                columns: [
                    {
                        className: 'details-control',
                        orderable: false,
                        searchable: false,
                        data: null,
                        defaultContent: '',
                        render: function (data, type, row, meta) {
                            var hide = '';
                            if(row.price_has_coupon || !row.price_id) {
                                hide = 'd-none';
                            }
                            return '<i class="fa fa-plus-square text-success '+hide+'" aria-hidden="true"></i>';
                        }
                    },
                    { data: 'name', name: 'acties.name', defaultContent: '' },
                    { data: 'code', name: 'vouchers.code', defaultContent: '' },
                    { data: 'coupon', name: 'coupons.coupon', defaultContent: '' },
                    { data: 'short', name: 'prices.short', defaultContent: '' },
                    { data: 'email', name: 'participants.email', defaultContent: '' },
                    { data: 'ipaddress', name: 'vouchers.ipaddress', defaultContent: '' },
                    { data: 'updated_at', name: 'vouchers.updated_at', defaultContent: '' }
                ]
            }).on( 'draw', function () {
                @if(isset($actie))
                    $('.table-data-info').html('<h5 class="font-weight-bold">Participants - {{ $actie->name }}</h5>');
                @else
                    $('.table-data-info').html('<h5 class="font-weight-bold">Participants - All</h5>');
                @endif
            });
            $('#participant-table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var tdi = tr.find("i.fa");
                var row = table.row(tr);
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    tdi.first().removeClass('fa-minus-square text-warning');
                    tdi.first().addClass('fa-plus-square text-success');
                } else {
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                    tdi.first().removeClass('fa-plus-square text-success');
                    tdi.first().addClass('fa-minus-square text-warning');
                }
            });
        });

        function format (d) {
            return '<strong>Data:</strong><br />'+
                d.naam+'<br>'+
                d.adres+' '+d.huisnummer+'<br>'+
                d.postcode+' '+d.woonplaats+'<br>';
        }
    </script>

@endsection
