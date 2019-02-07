@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt-4">
        <div class="row mt-4">
            <div class="col">
                <table class="table table-bordered" id="maandprijzen">
                    <thead>
                        <tr>
                            <th colspan="3"></th>
                            <th class="text-center" colspan="2">Period</th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Mail</th>
                            <th>Voucher</th>
                            <th>Actions</th>
                            <th class="text-center">From</th>
                            <th class="text-center">Till</th>
                            <th class="text-center">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prices as $price)

                            <tr>
                                <td>{{ $price->voucher->participant->email }}</td>
                                <td>{{ $price->voucher->code }}</td>
                                <td>
                                    @php
                                        $acties = $price->acties->sortBy('name');
                                    @endphp
                                    @foreach ($acties AS $actie)

                                        {{ $actie->name }}<br />

                                    @endforeach
                                </td>
                                <td class="text-center">{{ $price->start }}</td>
                                <td class="text-center">{{ $price->end }}</td>
                                <td class="text-center">{{ $price->created_at }}</td>
                            </tr>


                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            if(t = loadTable()) {
                $('.table-data-info').html('<h5 class="font-weight-bold">Monthprices</h5>');
            }
        });
        function loadTable()
        {
            return table = $('#maandprijzen').DataTable({
                order: [[ 5, "desc" ]],
                dom: '<"row d-flex justify-content-between"<"col align-self-center table-data-info"><"col"f>><"row"<"col"tr>><"row d-flex justify-content-between"<"col align-self-center"l><"col align-self-center"i><"col"p>>',
            });
        }
    </script>

@endsection
