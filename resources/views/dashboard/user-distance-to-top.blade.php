@extends('layout')
@section('page-title', 'Distance of user to get into the top 1000')
@section('menu-user-distance-to-top', 'active')
@section('content')
    <section class="py-1 text-center container">
        <div class="row py-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3>Distance of user to get into the top 1000</h3>
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
                            <p class="card-text">How many viewers does the lowest viewer count stream that the logged in user is following need to gain in order to make it into the top 1000? <span style="font-weight: bold;">Answer: {{$data}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
