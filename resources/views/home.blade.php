@extends('layouts.main-layout')
@section('title', 'За Чистые Выборы')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Вы уже вошли!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
