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
                        <div class="col-md-4">
                    @else
                        <div class="col-md-4 text-muted">
                    @endif

                        <table class="table table-bordered">
                            <thead>
                                @if ($active)
                                    <tr class="bg-success text-white">
                                @else
                                    <tr class="bg-danger text-white">
                                @endif
                                    <th colspan="4" class="text-center">
                                        <span class="float-left">{{ $actie->name }}</span>
                                        <span class="font-weight-normal float-right">
                                            <small>
                                                @if ($active)
                                                    actief
                                                @else
                                                    inactief
                                                @endif
                                            </small>
                                        </span>
                                        <span class="font-weight-normal">
                                            <small>
                                                looptijd: {{ date('d-m-Y', strtotime($actie->start_at)) }} t/m {{ date('d-m-Y', strtotime($actie->end_at)) }}
                                            </small>
                                        </span>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Prijzen</th>
                                    <th class="text-center">Quota</th>
                                    <th class="text-center">Vandaag</th>
                                    <th class="text-center">Totaal</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($actie->prices AS $price)

                                <tr>
                                    <td>{{ $price->short }}</td>
                                    <td class="text-center">{{ $price->quantity}}</td>
                                    <td class="text-center">{{ $today_wins[$price->id] }}</td>
                                    <td class="text-center">{{ $price->vouchers->count()}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="4">Deelnames</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Vandaag</td>
                                    <td colspan="3">
                                        <a href="{{ route('participant.index', [$actie->id]) }}">
                                            {{ $today_vouchers[$actie->id] }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Totaal</td>
                                    <td colspan="3">
                                        <a href="{{ route('participant.index', [$actie->id]) }}">
                                            {{ $total_vouchers[$actie->id] }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th colspan="4">Instellingen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Win ratio</td>
                                    <td colspan="3">
                                        {{ $actie->ratio_win }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>IP limiet</td>
                                    <td colspan="3">{{ $actie->ip_limit }} / {{ $actie->ip_limit_duration }} uur</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <a href="{{ route('setting.index', [$actie->id]) }}" class="btn btn-secondary btn-block">Manage</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>



                    </div>

                @endif

            @endforeach


{{--
                <br />Settings

                <br />Top IP adressen

                <br />Top mail adressen

                <br />Grafiek deelnemers --}}

            </div>
        </div>
    </div>

@endsection
