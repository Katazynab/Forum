@extends("layouts.app")

@section('content')
<div class="container">

    <!--sekmingos temos sukurimo sesijos pranesimas-->
    <div class="col-md-12">
        @if (Session::has('status'))
            <div class="alert alert-info">{{ Session::get('status') }}</div>
        @endif
    </div>

    <div class="panel-heading">
		<h3 class="panel-title text-info">Forumo kategorijos</h3>
	</div>
    <hr class="bg-info">
    <table class="table table-hover" id="dev-table">
        <tr class="bg-info">
            <th class="text-white">Kategorija</th>
            <th class="text-white">Statistika</th>
            <th class="text-white">Paskutinė sukurta tema</th>
        </tr>

@foreach($categories as $categoryItem)
<tr>
    <td>
    <h3 >
        <img class="width: 20" src="storage/{{$categoryItem->image}}" class="rounded-circle float-left">
        <a href="{{ route('temos.show', $categoryItem->id) }}">{{$categoryItem->title}}</a>
    </h3>
    </td>
    <td>
       <p class="text-info"> Temų: {{ $categoryItem->themes->count() }}</p>


    </td>
    <td>
        @if(($categoryItem->themes->count() )>0)
            <p class="text-info">{{$categoryItem->themes->last()->title}}</p>
            <p class="text-info">Tema paskelbta: {{$categoryItem->themes->last()->created_at}}</p>
        @else
            <p class="text-info">Kolkas temų nėra</p>
        @endif
    </td>
</tr>

 @endforeach

</table>
</div>
@endsection
