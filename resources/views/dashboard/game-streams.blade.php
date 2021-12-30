@extends('layout')
@section('page-title', 'Game Streams')
@section('content')
    <section class="py-1 text-center container">
        <div class="row py-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3>Total number of streams for each game</h3>
                <p class="text-muted">To see other information click on an appropriate menu item.</p>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Game Name</th>
                        <th scope="col">Number of streams</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td>{{$row['game_name']}}</td>
                            <td>{{$row['total']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$data->links()}}
        </div>
    </div>
@endsection
