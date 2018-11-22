@extends("layouts.app")

@section('content')
<div class="container">

    <div class="col-sm-4">
        <h1>Nauja tema</h1>

    @if ($errors->any() )
       <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ route('temos.store') }}">
            {{ csrf_field() }}

          Temos pavadinimas:
    <input name="title1"
           value="{{ old('title1') }}"
        required class="form-control">
            Temos tekstas:
    <input name="text"
           value="{{ old('text') }}"
        required class="form-control">
            Nuotrauka:
    <input type="file" name="image"
           class="form-control" value="">

    <input type="hidden" name="category_id" value="{{ $themeID }}">
        <hr>

   <input type="submit" class="btn btn-info" value="Pridėti temą">

    </form>
    </div>
</div>
@endsection