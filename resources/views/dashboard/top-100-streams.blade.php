@extends('layout')
@section('page-title', 'Top 100 Streams')
@section('menu-top-100-streams', 'active')
@section('content')
    <section class="py-1 text-center container">
        <div class="row py-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3>List of top 100 streams by viewer count that can be sorted asc & desc</h3>
                <p class="text-muted">To see other information click on an appropriate menu item.</p>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">N</th>
                        <th scope="col">Game Thumbnail</th>
                        <th scope="col">Game Name</th>
                        <th scope="col">Number of viewers
                            @if(isset($_GET['orderby']) && $_GET['orderby']=='asc')
                                <a title="Descending Order" href="{{ route("top100-streams", ['orderby=desc']) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
                                        <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
                                        <path fill-rule="evenodd" d="M10.082 12.629 9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
                                        <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                    </svg>
                                </a>
                            @elseif((isset($_GET['orderby']) && $_GET['orderby']=='desc') || !isset($_GET['orderby']))
                                <a title="Ascending Order" href="{{ route("top100-streams", ['orderby=asc']) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
                                        <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
                                    </svg>
                                </a>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index=>$row)
                        <tr>
                            <td>{{++$index}}.</td>
                            <td><img loading="lazy" src="{{$row['thumbnail_url']}}" class="thumbnail-img" /></td>
                            <td>{{$row['game_name']}}</td>
                            <td>{{number_format($row['viewer_count'], 0, '.', ' ')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
