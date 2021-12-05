@extends('layouts.main-layout')
@section('title', 'Добавление данных')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
    <form action="/addmessage "method="post" >
        @if(Session::get('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::get('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Адрес</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Адрес" value="{{old('title')}}">
            <span style="color: red;">@error('title'){{$message}} @enderror</span>

        </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Уик</label>
                <input type="text" name="uik" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Уик" value="{{old('uik')}}">
                <span style="color: red;">@error('uik'){{$message}} @enderror</span>

            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Индекс</label>
                <input type="text" name="index" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Индекс" value="{{old('index')}}">
                <span style="color: red;">@error('index'){{$message}} @enderror</span>

            </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Описание</label>
            <input type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="Описание" value="{{old('description')}}">
            <span style="color: red;">@error('description'){{$message}} @enderror</span>
        </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Картинка</label>
                <textarea  class="form-control" name="image" id="exampleInputPassword1" placeholder="Картинка"></textarea>
                <span style="color: red;">@error('image '){{$message}} @enderror</span>
            </div>

            <div class="mb-3">
                <input type="hidden" name="status" class="form-control" id="exampleInputPassword1" value="Обработка">
                <span style="color: red;">@error('status'){{$message}} @enderror</span>
            </div>

        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
        </div>
    </div>

@endsection
