@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt-4">

        <div class="row justify-content-center mt-4">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">Winners</span>
                        <small class="text-muted">Created</small>
                    </div>
                    <div class="list-group-flush">

                        @foreach ($global_acties as $key => $menu_actie)

                            @if($menu_actie->active == true && $menu_actie->start_at <= date('Y-m-d') && $menu_actie->end_at >= date('Y-m-d'))

                                @if (\Storage::exists('downloads/winners-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'))

                                    <a href="{{ route('download.download', ['winners-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'])}}" class="text-body list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span><i class="far fa-file-excel mr-2 text-success"></i> {{ $menu_actie->name }}</span>
                                        <small>
                                            {{ \Carbon\Carbon::createFromTimestamp(\Storage::lastModified('downloads/winners-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'))->format('d-m-Y H:i') }}
                                        </small>
                                    </a>

                                @endif

                            @endif

                        @endforeach


                        @foreach ($global_acties as $key => $menu_actie)

                            @if($menu_actie->active != true || $menu_actie->start_at > date('Y-m-d') || $menu_actie->end_at < date('Y-m-d'))

                                @if (\Storage::exists('downloads/winners-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'))

                                    <a href="{{ route('download.download', ['winners-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'])}}" class="text-body list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span><i class="far fa-file-excel mr-2 text-secondary"></i> {{ $menu_actie->name }}</span>
                                        <small>
                                            {{ \Carbon\Carbon::createFromTimestamp(\Storage::lastModified('downloads/winners-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'))->format('d-m-Y H:i') }}
                                        </small>
                                    </a>

                                @endif

                            @endif

                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">Participants</span>
                        <small class="text-muted">Created</small>
                    </div>
                    <div class="list-group-flush">

                        @foreach ($global_acties as $key => $menu_actie)

                            @if($menu_actie->active == true && $menu_actie->start_at <= date('Y-m-d') && $menu_actie->end_at >= date('Y-m-d'))

                                @if (\Storage::exists('downloads/participants-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'))

                                    <a href="{{ route('download.download', ['participants-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'])}}" class="text-body list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span><i class="far fa-file-excel mr-2 text-success"></i> {{ $menu_actie->name }}</span>
                                        <small>
                                            {{ \Carbon\Carbon::createFromTimestamp(\Storage::lastModified('downloads/participants-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'))->format('d-m-Y H:i') }}
                                        </small>
                                    </a>

                                @endif

                            @endif

                        @endforeach


                        @foreach ($global_acties as $key => $menu_actie)

                            @if($menu_actie->active != true || $menu_actie->start_at > date('Y-m-d') || $menu_actie->end_at < date('Y-m-d'))

                                @if (\Storage::exists('downloads/participants-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'))

                                    <a href="{{ route('download.download', ['participants-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'])}}" class="text-body list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span><i class="far fa-file-excel mr-2 text-secondary"></i> {{ $menu_actie->name }}</span>
                                        <small>
                                            {{ \Carbon\Carbon::createFromTimestamp(\Storage::lastModified('downloads/participants-'.str_replace(' ', '-', strtolower($menu_actie->name)).'.xlsx'))->format('d-m-Y H:i') }}
                                        </small>
                                    </a>

                                @endif

                            @endif

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
