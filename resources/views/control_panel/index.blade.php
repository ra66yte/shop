@extends('layouts.app')

@section('aside')

@endesection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Control Panel') }}</div>

                <div class="card-body">

                    {{ __('You are in Control Panel!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection