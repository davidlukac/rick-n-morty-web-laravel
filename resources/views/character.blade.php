{{--
    Character Detail.

    Input variables:

    @var Character $character
    @var bool $isFavourite
--}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Character Details</h1>
        <div class="character-details">
            <h2>{{ $character->name }}</h2>
            <div class="character-image">
                <img src="{{ $character->image }}" alt="{{ $character->name }}" width="200">
            </div>
            <div class="character-info">
                <p><strong>My favourite: </strong> {{ ($isFavourite ?? false) ? 'true' : 'false' }}</p>
                <p><strong>ID:</strong> {{ $character->id }}</p>
                <p><strong>Status:</strong> {{ $character->status }}</p>
                <p><strong>Species:</strong> {{ $character->species }}</p>
                <p><strong>Type:</strong> {{ $character->type }}</p>
                <p><strong>Gender:</strong> {{ $character->gender }}</p>
                <p><strong>Origin:</strong>
                    @if($character->origin->getId())
                        <a href="{{ route('locations.detail', ['id' => $character->origin->getId()]) }}">
                            {{ $character->origin->name }}
                        </a>
                    @else
                        {{ $character->origin->name }}
                    @endif
                </p>
                <p><strong>Location:</strong>
                    @if($character->location->getId())
                        <a href="{{ route('locations.detail', ['id' => $character->location->getid()]) }}">
                            {{ $character->location->name }}
                        </a>
                    @else
                        {{ $character->location->name }}
                    @endif
                </p>
                <p><strong>Created:</strong> {{ $character->created }}</p>
                <p><strong>Episodes:</strong></p>
                <div class="episodes-list">
                    @include('partials.entity_link_list',
                        [
                            'entities' => $character->episode,
                            'routeName' => 'episodes.detail'
                        ]
                    )
                </div>
            </div>
        </div>
        <a href="{{ route('characters.exp.pdf', ['id' => $character->id]) }}">Download PDF</a>
    </div>
@endsection
