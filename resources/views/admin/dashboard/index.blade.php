@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt-4">
        <div class="row">

            @foreach ($acties as $actie)

                @if (isset($today_vouchers[$actie->id]))

                    @php
                        $active = false;
                        if ($actie->active == true && $actie->start_at <= date('Y-m-d') && $actie->end_at >= date('Y-m-d')) {
                            $active = true;
                        }
                    @endphp

                    @if ($active)
                        <div class="col-lg-4">
                    @else
                        <div class="col-lg-4 text-muted">
                    @endif

                        <table class="table table-bordered mb-4">
                            <thead class="thead-light">
                                @if ($active)
                                    <tr class="card-header">
                                @else
                                    <tr class="bg-danger text-white">
                                @endif
                                    <th colspan="4" class="text-center">
                                        {{ $actie->name }}
                                    </th>
                                </tr>
                            </thead>
                            <thead>
                                <tr class="card-header">
                                    <th>Prices</th>
                                    <th class="text-center">Quota</th>
                                    <th class="text-center">Today</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($actie->prices AS $price)
                                @if ($price->type == 'day')
                                    <tr>
                                        <td>{{ $price->short }}</td>
                                        <td class="text-center">{{ $price->quantity}}</td>
                                        <td class="text-center">{{ $today_wins[$price->id] }}</td>
                                        <td class="text-center">{{ $price->vouchers->count()}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                            <thead>
                                <tr class="card-header">
                                    <th colspan="2">Participants</th>
                                    <th class="text-center">Today</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-center">
                                        <a href="{{ route('participant.index_actie', [$actie->id]) }}">
                                            {{ $today_vouchers[$actie->id] }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('participant.index_actie', [$actie->id]) }}">
                                            {{ $total_vouchers[$actie->id] }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr class="card-header">
                                    <th colspan="2">Settings</th>
                                    <th class="text-center">Win ratio</th>
                                    <th class="text-center">IP limit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <small>
                                            {{ date('d-m-y', strtotime($actie->start_at)) }} - {{ date('d-m-y', strtotime($actie->end_at)) }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('setting.index', [$actie->id]) }}">{{ $actie->ratio_win }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('setting.index', [$actie->id]) }}">{{ $actie->ip_limit }}/{{ $actie->ip_limit_duration }} uur</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                @endif

            @endforeach

            </div>
        </div>
    </div>

@endsection
