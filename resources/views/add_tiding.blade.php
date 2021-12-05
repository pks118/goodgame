@extends('layouts.main-layout')
@section('title', 'Добавление данных')
@section('content')

    <div class="container_logo">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form action="/addtiding" method="post" enctype="multipart/form-data">
                        <center>{{ __('Редактирование Новостей') }}</center>
                        @if(Session::get('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Оглавление</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Оглавление" value="{{old('title')}}">
                            <span style="color: red;">@error('title'){{$message}} @enderror</span>

                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Описание</label>
                            <textarea type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="Описание" value="{{old('description')}}"></textarea>
                            <span style="color: red;">@error('description'){{$message}} @enderror</span>
                        </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Полное описание</label>
                                <textarea type="text" name="description_max" class="form-control" id="exampleInputPassword1" placeholder="Полное описание" value="{{old('description_max')}}"></textarea>
                                <span style="color: red;">@error('description_max'){{$message}} @enderror</span>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Картинка</label>
                                <input type="file" class="form-control" name="images[]" multiple>
                                <span style="color: red;">@error('image'){{$message}} @enderror</span>
                            </div>

                            <!--<div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Картинка</label>
                                <input type="file" class="form-control" name="images">
                                <span style="color: red;">error('images'){$message}} enderror</span>
                            </div>-->
                        <button type="submit" class="button_add_tiding">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover" style="margin-top: 30px;">
        <thead>
        <th>Оглавление</th>
        <th>Описание</th>
        <th>Полное описание</th>

        <th>Действия</th>
        </thead>
        <tbody>
        @foreach($show as $productitem)
            <tr>
                <td>{{$productitem->title}}</td>
                <td>{{$productitem->description}}</td>
                <td>{{$productitem->description_max}}</td>

                <td>
                    <div class="btn-group">
                        <a href="/deletetiding/{{$productitem->id}}" class="btn btn-danger btn-xs">Удалить</a>
                        <a href="/edittiding/{{$productitem->id}}" class="btn btn-primary  btn-xs">Обновить</a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        <nav aria-label="Page navigation example">
            {{$show->links("pagination::bootstrap-4")}}
        </nav>
    </div>


@endsection
