@extends("layouts.app")

@section('content')
<div class="container">


    <table class="table table-hover" id="dev-table">
        <tr class="bg-info">
            <th class="text-white">Tema</th>
            <th class="text-white">Tekstas</th>
            <th class="text-white">Komentarų skaičius</th>
            <th class="text-white">Paskutinį kartą komentuota</th>
            @guest
            @else
                @if(Auth::user()->admin == 1)
            <th class="text-white">Trinti</th>
                @endif
            @endguest

        </tr>
@foreach($categoryThemes->themes as $theme)
        <tr>
            <td>
                <h4>
            <a href="{{ route('komentarai.show', $theme->id) }}">{{$theme->title}}</a>
                </h4>
            </td>
            <td>
                <p class="text-info">{{$theme->text}}</p>
            </td>
            <td>
                <p class="text-info">{{$theme->comments->count() }}</p>
            </td>
            <td>
                @if(($theme->comments->count() )>0)
                    <p class="text-info">{{$theme->comments->last()->created_at}}</p>
                @else
                    <p class="text-info">Kolkas komentarų nėra</p>
                @endif
            </td>
            @guest
            @else
                @if(Auth::user()->admin == 1)
            <td>
            <form action="{{ route('temos.destroy', $theme->id, $theme->category->id) }}"
                  method="POST">
                {{ csrf_field() }}
                <input class="btn btn-danger" type="submit" value="x">
            </form>
            </td>
                @endif
            @endguest
        </tr>
@endforeach

    </table>
    @guest
    @else
    @if(Auth::user())
    <a class="btn btn-info bg-info" href="{{ route('temos.create', $categoryThemes->id) }}">Pridėti naują temą</a>
    @endif
    @endguest
    <hr>
    <a href="{{ route('kategorijos.index') }}">|| Grįžti į visas kategorijas ||</a>
</div>
@endsection
