{{--
    Input variables:

    @var CharactersResponse $charactersResponse
    @var int $page
--}}

@extends('layouts.paginated')

@section('top-section')
    <h1>Characters</h1>
@endsection

@section('filters')
    <form id="filter-form" action={{ route('characters.index') }}>
        @csrf
        <input type="hidden" name="page" value=1/>
        <label for="name">Name</label><input type="text" id="name" name="name" value="{{ $filters['name'] ?? '' }}">
        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="" {{ ($filters['status'] ?? '') == '' ? 'selected' : '' }}>any</option>
            <option disabled selected value> -- select an option --</option>
            <option value="alive" {{ ($filters['status'] ?? '') == 'alive' ? 'selected' : '' }}>alive</option>
            <option value="dead" {{ ($filters['status'] ?? '') == 'dead' ? 'selected' : '' }}>dead</option>
            <option value="unknown" {{ ($filters['status'] ?? '') == 'unknown' ? 'selected' : '' }}>unknown</option>
        </select>
        <label for="species">Species</label>
        <input type="text" id="species" name="species" value="{{ $filters['species'] ?? '' }}">
        <label for="type">Type</label><input type="text" id="type" name="type" value="{{ $filters['type'] ?? ''}}">
        <label for="gender">Gender</label>
        <select id="gender" name="gender">
            <option value="" {{ ($filters['gender'] ?? '') == '' ? 'selected' : '' }}>any</option>
            <option disabled selected value> -- select an option --</option>
            <option value="female" {{ ($filters['gender'] ?? '') == 'female' ? 'selected' : '' }}>female</option>
            <option value="male" {{ ($filters['gender'] ?? '') == 'male' ? 'selected' : '' }}>male</option>
            <option value="genderless" {{ ($filters['gender'] ?? '') == 'genderless' ? 'selected' : '' }}>genderless</option>
            <option value="unknown" {{ ($filters['gender'] ?? '') == 'unknown' ? 'selected' : '' }}>unknown</option>
        </select>
        <input type="submit" value="Search">
    </form>
@endsection

@section('table-content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Species</th>
                <th>Type</th>
                <th>Gender</th>
                <th>Origin</th>
                <th>Location</th>
                <th>Episodes</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pagedResponse->results as $character)
                <tr>
                    <td>
                        <a href="{{ route('characters.detail', ['id' => $character->id]) }}">
                            <img src="{{ $character->image }}" alt="{{ $character->name }}" width="50"><br/>
                            {{ $character->name }}
                        </a>
                    </td>
                    <td>{{ $character->status }}</td>
                    <td>{{ $character->species }}</td>
                    <td>{{ $character->type }}</td>
                    <td>{{ $character->gender }}</td>
                    <td>
                        @if($character->origin->getId())
                            <a href="{{ route('locations.detail',  ['id' => $character->origin->getId()]) }}">{{ $character->origin->name }}</a>
                        @else
                            {{ $character->origin->name }}
                        @endif
                    </td>
                    <td>
                        @if($character->location->getId())
                            <a href="{{ route('locations.detail',  ['id' => $character->location->getId()]) }}">{{ $character->location->name }}</a>
                        @else
                            {{ $character->location->name }}
                        @endif
                    </td>
                    <td>
                        @include('partials.entity_link_list',
                            [
                                'entities' => $character->episode,
                                'routeName' => 'episodes.detail',
                            ]
                        )
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
