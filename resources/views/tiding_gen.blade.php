@extends('layouts.main-layout')
@section('title', 'Новости')
@section('content')
<article id="main">
    <header>
        <h2>Новости</h2>
        <p>{{ $Info->title }}</p>
    </header>
    <section class="wrapper style5">
        <div class="inner">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach (json_decode($Info->image) as $key => $image)
                        <div class="carousel-item @if($key==0) active @endif">
                            <img class="d-block w-100" src="/uploads/{{ $image }}">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


            <h3>16.03.2018</h3>

            <p>{{ $Info->description_max }}</p>

            <hr />

        </div>
    </section>
</article>
@endsection
