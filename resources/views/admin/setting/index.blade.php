@extends('layouts.admin')

@section('content')

    <div class="container-fluid mt-4">
        <form method="POST" action="{{ route('setting.update', [$actie->id]) }}">
            @method('PUT')
            @csrf

            <div class="row justify-content-center mt-4">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header font-weight-bold">{{ $actie->name['test'] }}</div>
                        <div class="card-body">
                            <div class="form-group">

                                <label>Start action</label>
                                <input value="{{ $actie->start_at }}" name="start_at" type="date" class="form-control"  required>
                                <small class="form-text text-muted">
                                    Action starts at this date.
                                </small>

                            </div>
                            <div class="form-group">
                                <label>End action</label>
                                <input value="{{ $actie->end_at }}" name="end_at" type="date" class="form-control"  required>
                                <small class="form-text text-muted">
                                    Action ends after this date.
                                </small>
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header font-weight-bold">Daily prices</div>
                        <div class="card-body">
                            @foreach($actie->prices->where('type', 'day') AS $price)
                                <div class="form-group">
                                    <label>{{ $price->short }}</label>
                                    <input value="{{ $price->quantity }}" name="quantity[{{ $price->id }}]" min="{{ $min[$price->id] }}" type="number" class="form-control" required>
                                    <small>Minimum <strong>{{ $min[$price->id] }}</strong>. This price is won <strong>{{ $min[$price->id] }}</strong> times today</small>
                                </div>
                            @endforeach
                            <hr />
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header font-weight-bold">Other</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Chance ratio - X</label>
                                <input value="{{ $actie->ratio_win }}" name="ratio_win" min="1" type="number" class="form-control"  required>
                                <small class="form-text text-muted">
                                    Every <strong>X</strong>-th input has a chance to win a price as long as daily prices are available.
                                </small>
                            </div>
                            <div class="form-group">
                                <label>IP limiet aantal - A</label>
                                <input value="{{ $actie->ip_limit }}" name="ip_limit" min="1" type="number" class="form-control"  required>
                                <small class="form-text text-muted">
                                    No chance to win if IP address occurs <strong>A</strong> times within <strong>D</strong> hours.
                                </small>
                            </div>
                            <div class="form-group">
                                <label>IP limiet duur - D</label>
                                <input value="{{ $actie->ip_limit_duration }}" name="ip_limit_duration" min="1" type="number" class="form-control"  required>
                                <small class="form-text text-muted">
                                    No chance to win if IP address occurs <strong>A</strong> times within <strong>D</strong> hours.
                                </small>
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
