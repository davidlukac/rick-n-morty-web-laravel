{{--
    Input variables:

    @var Location $location
    @var bool $isFavourite
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Location Details</h1>
        <div class="location-details">
            <h2>{{ $location->name }}</h2>
            <div class="location-info">
                <p><strong>My favourite: </strong> {{ ($isFavourite ?? false) ? 'true' : 'false' }}</p>
                <p><strong>ID:</strong> {{ $location->id }}</p>
                <p><strong>Type:</strong> {{ $location->type }}</p>
                <p><strong>Dimension:</strong> {{ $location->dimension }}</p>
                <p><strong>Created:</strong> {{ $location->created }}</p>
                <p><strong>Residents:</strong></p>
                <div class="location-list">
                    @include('partials.entity_link_list',
                        [
                            'entities' => $location->residents,
                            'routeName' => 'characters.detail',
                        ]
                    )
                </div>
            </div>
        </div>
    </div>
@endsection
