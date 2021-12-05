@extends('layouts.main-layout')
@section('title', 'За Чистые Выборы')
@section('content')




        <div class="container_admin">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Redactor') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf






                            <ul class="redactor_admin">
                                <li><a href="/add_tiding" class="button">Новости</a></li>
                                <li><a href="" class="button">Сообщения</a></li>
                            </ul>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



