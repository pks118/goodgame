@extends('layouts.main-layout')
@section('title', 'Добавление данных')
@section('content')
    <div class="row">
    <div class="col-md-8 offset-md-2">
        <h1>{{ $Title }}</h1>
        @if(Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
        <form action="/updatetiding" method="post">
            @csrf
            <input type="text" name="id_tiding" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $Info->id }}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Оглавление</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Оглавление" value="{{ $Info->title }}">
                <span style="color: red;">@error('title'){{$message}} @enderror</span>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Описание</label>
                    <textarea type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="Описание" >{{ $Info->description }}</textarea>
                    <span style="color: red;">@error('description'){{$message}} @enderror</span>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Полное описание</label>
                    <textarea type="text" name="description_max" class="form-control" id="exampleInputPassword1" placeholder="Полное описание" >{{ $Info->description_max }}</textarea>
                    <span style="color: red;">@error('description_max'){{$message}} @enderror</span>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Картинка</label>
                    <input type="text" name="image" class="form-control" id="exampleInputPassword1" placeholder="Картинка" value="{{ $Info->image }}">
                    <span style="color: red;">@error('image'){{$message}} @enderror</span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
    </div>
@endsection

