@section('title')
    О нас
@endsection

@section('header')
    О нашей компании
@endsection

@section('content')
    <h1>Hello, {{ $name }}!</h1>


        <ul>
            @foreach($items as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

@endsection