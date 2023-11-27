{{--
    Partial for rendering array of Episode IDs to links.

    Input variables:

    @var int[] $entities
    @var string $routeName
--}}

@if(isset($entities) && isset($routeName))
    @php $links = []; @endphp
    @foreach($entities as $id)
        @php
            $links[] = '<a href="' . route($routeName, ['id' => $id]) . '">' . e($id) . '</a>'
        @endphp
    @endforeach
    {!! implode(', ', $links) !!}
@endif

