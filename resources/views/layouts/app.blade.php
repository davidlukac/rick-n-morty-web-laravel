<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rick and Morty</title>
    <style>
        .header-bar {
            padding: 10px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            align-items: center;
        }

        .back-button {
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .content {
            padding: 20px;
        }

        .menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .menu li {
            display: inline;
            margin-right: 20px;
        }

        .menu li a {
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="header-bar">
    <button onclick="history.back()" class="back-button">
        ← Back
    </button>
    <ul class="menu">
        <li><a href="{{ route('characters.index') }}">Characters</a></li>
        <li><a href="{{ route('episodes.index') }}">Episodes</a></li>
        <li><a href="{{ route('locations.index') }}">Locations</a></li>
    </ul>
</div>

<div class="content">
    @yield('content')
</div>

<script type="text/javascript" src="{{ asset('js/filter.js') }}"></script>

</body>
</html>
