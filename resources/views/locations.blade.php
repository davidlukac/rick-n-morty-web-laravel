{{--
    Input variables:

    @var LocationsResponse $locationsResponse
    @var int $page
--}}

@extends('layouts.paginated')

@section('top-section')
    <h1>Locations</h1>
@endsection

@section('filters')
    <form action={{ route('locations.index') }}>
        @csrf
        <input type="hidden" name="page" value=1/>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $filters['name'] ?? '' }}">

        <label for="type">Type</label>
        <input type="text" id="type" name="type" value="{{ $filters['type'] ?? '' }}">

        <label for="dimension">Dimension</label>
        <input type="text" id="dimension" name="dimension" value="{{ $filters['dimension'] ?? '' }}">

        <input type="submit" value="Search">
    </form>
@endsection

@section('table-content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Dimension</th>
                <th>Residents</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pagedResponse->results as $location)
                <tr>
                    <td>
                        <a href="{{ route('locations.detail', ['id' => $location->id]) }}">{{ $location->id }}</a>
                    </td>
                    <td>
                        <a href="{{ route('locations.detail', ['id' => $location->id]) }}">{{ $location->name }}</a>
                    </td>
                    <td>{{ $location->type }}</td>
                    <td>{{ $location->dimension }}</td>
                    <td>
                    @include('partials.entity_link_list',
                        [
                            'entities' => $location->residents,
                            'routeName' => 'characters.detail',
                        ]
                    )
                    <td>{{ $location->created }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
