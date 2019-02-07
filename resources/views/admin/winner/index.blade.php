@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col">
                <table class="table table-bordered" id="winner-table">
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
                            <th></th>
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
            var table = $('#winner-table').DataTable({
                processing: true,
                serverSide: true,
                @if(isset($actie))
                    ajax: '{!! route('winner.data_actie', [$actie->id]) !!}',
                @else
                    ajax: '{!! route('winner.data') !!}',
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
                            if(row.price_has_coupon) {
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
                    { data: 'updated_at', name: 'vouchers.updated_at', defaultContent: '' },
                    {
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        data: null,
                        defaultContent: '',
                        render: function (data, type, row, meta) {
                            return '<a href="javascript:void(0);" data-voucher="'+row.id+'" data-code="'+row.code+'" class="voucher-mail btn btn-sm btn-primary"><i class="fal fa-envelope-open" aria-hidden="true"></i></a>';
                        }
                    }
                ]
            }).on( 'draw', function () {
                @if(isset($actie))
                    $('.table-data-info').html('<h5 class="font-weight-bold">Winners - {{ $actie->name }}</h5>');
                @else
                    $('.table-data-info').html('<h5 class="font-weight-bold">Winners - All</h5>');
                @endif
            });
            $('#winner-table tbody').on('click', 'td.details-control .fa', function () {
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
            $('#winner-table tbody').on('click', '.voucher-mail', function() {
                if(confirm('Bevestig (her)verzenden mail voor voucher '+$(this).data('code'))) {
                    $.get('/admin/mail/'+$(this).data('voucher'), function( data ) {
                        alert('Mail is verzonden');
                    });
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
