{{--
    Episode Detail.

    Input variables:

    @var Episode $episode
    @var bool $isFavourite
    @var string $myReview
    @var float $myRating
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Episode {{ $episode->episode }} - {{ $episode->name }}</h1>
        <div class="episode-details">
            <h2>{{ $episode->name }}</h2>
            <div class="episode-info">
                <p><strong>My favourite: </strong> {{ ($isFavourite ?? false) ? 'true' : 'false' }}</p>
                @isset($myReview)
                    <p><strong>My review: </strong> {{ $myReview }}</p>
                @endisset
                @isset($myRating)
                    <p><strong>My rating: </strong> {{ $myRating }}</p>
                @endisset
                <p><strong>ID:</strong> {{ $episode->id }}</p>
                <p><strong>Air Date:</strong> {{ $episode->air_date }}</p>
                <p><strong>Created:</strong> {{ $episode->created }}</p>
                <p><strong>Residents:</strong></p>
                <div>
                    @include('partials.entity_link_list',
                            [
                                'entities' => $episode->characters,
                                'routeName' => 'characters.detail',
                            ]
                        )
                </div>
            </div>
        </div>
    </div>
@endsection
