@extends('layout')
@section('page-title', 'Median number of viewers for all streams')
@section('menu-median-streams', 'active')
@section('content')
    <section class="py-1 text-center container">
        <div class="row py-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3>Median number of viewers for all streams</h3>
                <p class="text-muted">To see other information click on an appropriate menu item.</p>
            </div>
        </div>
    </section>
{{--    <div class="row">--}}
{{--        <div class="col">--}}
{{--            --}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text">Median number of viewers for all streams is {{$data}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
