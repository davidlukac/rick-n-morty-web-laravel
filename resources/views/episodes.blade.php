{{--
    Input variables:

    @var EpisodesResponse $episodesResponse
    @var int $page
--}}

@extends('layouts.paginated')

@section('top-section')
    <h1>Episodes</h1>
@endsection

@section('filters')
    <form action={{ route('episodes.index') }}>
        @csrf
        <input type="hidden" name="page" value=1/>
        <label for="name">Name</label><input type="text" id="name" name="name" value="{{ $filters['name'] ?? '' }}">
        <label for="episode">Episode</label>
        <input type="text" id="episode" name="episode" value="{{ $filters['episode'] ?? '' }}">
        <input type="submit" value="Search">
    </form>
@endsection

@section('table-content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Episode</th>
                <th>Name</th>
                <th>Air Date</th>
                <th>Characters</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pagedResponse->results as $episode)
                <tr>
                    <td><a href="{{ route('episodes.detail', ['id' => $episode->id]) }}">{{ $episode->id }}</a></td>
                    <td><a href="{{ route('episodes.detail', ['id' => $episode->id]) }}">{{ $episode->episode }}</a>
                    </td>
                    <td><a href="{{ route('episodes.detail', ['id' => $episode->id]) }}">{{ $episode->name }}</a></td>
                    <td>{{ $episode->air_date }}</td>
                    {{--                    <td>{{ implode(', ', $episode->characters) }}</td>--}}
                    <td>
                        @include('partials.entity_link_list',
                            [
                                'entities' => $episode->characters,
                                'routeName' => 'characters.detail',
                            ]
                        )
                    </td>
                    <td>{{ $episode->created }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
