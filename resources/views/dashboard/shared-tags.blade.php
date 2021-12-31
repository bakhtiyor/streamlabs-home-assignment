@extends('layout')
@section('page-title', 'Shared Tags')
@section('menu-shared-tags', 'active')
@section('content')
    <section class="py-1 text-center container">
        <div class="row py-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h3>Shared tags between the user followed streams and the top 1000 streams</h3>
                <p class="text-muted">To see other information click on an appropriate menu item.</p>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col">
            <ul class="list-group">
                @foreach($data as $row)
                    @if(isset($row->tag) && isset($row->tag->localization_names))
                        @php $tagName=json_decode($row->tag->localization_names, true); @endphp
                        <li class="list-group-item">{{$tagName['en-us']}}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endsection
