<head>
    <link href="{{ asset('css/komentaru.css') }}" rel="stylesheet">
</head>

@extends("layouts.app")

@section('content')
<div class="container">

<div class="col-sm-4 post ">
    <h1>Paskyros atnaujinimas </h1>

    @if ($errors->any() )
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    @if(!empty($user->image))
        <img src="{{ asset('storage/' . $user->image) }}" class="image1 img-circle avatar rounded-circle" alt="user profile image">
    @else
        <img src="{{ asset('storage/default1.jpg') }}" class="img-circle avatar rounded-circle" alt="user profile image">
    @endif

    <br>

    <form method="POST" action="{{ route('profilis.update', $user->id ) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        Vartotojo vardas:
        <input name="name"
                class="form-control" value="{{ $user->name }}">

        Vartotojo nuotrauka:
        <input type="file" name="image"
                class="form-control">

        <hr>
        <input type="submit" class="btn btn-info" value="Išsaugoti pakeitimus">
    </form>
</div>
</div>

@endsection