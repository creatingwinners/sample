@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col">
                <table class="table table-bordered" id="coupon-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Type</th>
                            <th>Coupon</th>
                            <th>Voucher</th>
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
            $('#coupon-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('coupon.data') !!}',
                order: [[ 4, "desc" ]],
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
                    { data: 'type', name: 'coupons.type', defaultContent: '' },
                    { data: 'coupon', name: 'coupons.coupon', defaultContent: '' },
                    { data: 'code', name: 'vouchers.code', defaultContent: '' },
                    { data: 'updated_at', name: 'vouchers.updated_at', defaultContent: '' }
                ]
            }).on( 'draw', function () {
                $('.table-data-info').html('<h5 class="font-weight-bold">Coupons</h5>');
            });
        });
    </script>

@endsection
