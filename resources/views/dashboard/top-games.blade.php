@extends('layout')
@section('page-title', 'Top Games')
@section('menu-top-games', 'active')
@section('content')
    <section class="py-1 text-center container">
        <div class="row py-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3>Top games by viewer count for each game</h3>
                <p class="text-muted">To see other information click on an appropriate menu item.</p>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">Game Thumbnail</th>
                        <th scope="col">Game Name</th>
                        <th scope="col">Number of viewers</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td><img loading="lazy" src="{{$row['thumbnail_url']}}" class="thumbnail-img" /></td>
                            <td>{{$row['game_name']}}</td>
                            <td>{{number_format($row['viewer_count'], 0, '.', ' ')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$data->links()}}
        </div>
    </div>
@endsection
