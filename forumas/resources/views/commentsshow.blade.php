<head>
    <link href="{{ asset('css/komentaru.css') }}" rel="stylesheet">
</head>
@extends("layouts.app")

@section('content')
<div class="container">
    <div class="w-75 post">
    <h2 class="text-info">Tema</h2>


    <div class="panel">
        <div class="panel-heading bg-info p-2 pl-4 rounded text-white">{{$ThemeComments->title}}</div>
        <div class="panel-body table-info p-3 rounded shadow">
            <p class="float-right">Tema sukurta: {{$ThemeComments->created_at}}</p>
            <p>{{$ThemeComments->text}}</p>
            @if(!empty($ThemeComments->image))
                <img src="{{ asset('storage/' . $ThemeComments->image) }}" class="image2" alt="user profile image">
            @endif

        </div>
    </div>

        <hr>
<!--
    @foreach($ThemeComments->comments as $comment)

        <div class="panel-body table-info p-3 w-100 rounded shadow d-inline-block">
            <div class="float-left pr-4">
                <p>{{$comment->users->name}}</p>

                @if(!empty($comment->users->image))
            <img class="col-md-4 col-sm-4 w-20 rounded-circle img-responsive" src="{{ asset('storage/' . $comment->users->image) }}">
                @else
            <img class="col-md-4 col-sm-4 w-20 rounded-circle img-responsive" src="{{ asset('storage/profile.png') }}">
                @endif

            </div>

                {{$comment->text}}
                 <p class="float-right p-0">Komentaras paskelbtas: {{$comment->created_at}}</p>

        @guest
        @else
            @if(Auth::user()->admin == 1 or $comment->user_id == Auth::user()->id )
           <p> <form action="{{ route('komentarai.destroy', $comment->id) }}"
              method="POST">
            {{ csrf_field() }}
            <input class="btn btn-info float-right" type="submit" value="Ištrinti">
            </form></p>
        @endif
        @endguest

        </div>
        <div>
            <form class="float-right">
                <p class="text-info">{{ $comment->likes()->count() }} <i class="far fa-thumbs-up"> </i> </p>
            </form>
            @guest
            @else
                @if(Auth::user())
                    @if ($comment->isLiked)
                        <a class="float-right" href="{{ route('komentarai.like', $comment->id) }}">  Unlike   </a>
                    @else
                        <a class="float-right" href="{{ route('komentarai.like', $comment->id) }}">  Like    </a>
                    @endif

                @endif
            @endguest
        </div>
        <br>
        <hr>
        @endforeach
-->

@foreach($ThemeComments->comments as $comment)
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<div class="container ">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-white post panel-shadow table-info">
                <div class="post-heading">
                    <div class="pull-right">
                        @guest
                        @else
                            @if(Auth::user()->admin == 1 or $comment->user_id == Auth::user()->id )
                                <form action="{{ route('komentarai.destroy', $comment->id) }}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    <input class="btn btn-info float-right" type="submit" value="Ištrinti">
                                </form>
                            @endif
                        @endguest
                    </div>
                    <div class="pull-left image">
                        @if(!empty($comment->users->image))
                            <img src="{{ asset('storage/' . $comment->users->image) }}" class="img-circle avatar rounded-circle" alt="user profile image">
                        @else
                            <img src="{{ asset('storage/default1.jpg') }}" class="img-circle avatar rounded-circle" alt="user profile image">
                        @endif

                    </div>
                    <div class="pull-left meta">
                        <div class="title h5">
                            <b>{{$comment->users->name}}</b>
                        </div>
                        <h6 class="text-muted time">Komentaras paskelbtas: {{$comment->created_at}}</h6>
                    </div>
                </div>
                <div class="post-description">
                    <p>{{$comment->text}}</p>
                    @if(!empty($comment->image))
                        <img src="{{ asset('storage/' . $comment->image) }}" class=" image1" alt="user profile image">
                    @endif

                    <div class="stats">
                        <a href="#" class="btn btn-default stat-item">
                            <i class="fa fa-thumbs-up icon"></i>{{ $comment->likes()->count() }}
                        </a>
                        @guest
                        @else
                            @if(Auth::user())
                                @if ($comment->isLiked)
                                    <a class="btn btn-default stat-item" href="{{ route('komentarai.like', $comment->id) }}">Unlike </a>
                                @else
                                    <a class="btn btn-default stat-item" href="{{ route('komentarai.like', $comment->id) }}">Like </a>
                                @endif
                            @endif
                        @endguest

<!--<img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image"> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <hr>
@endforeach
        <br>

        @if ($errors->any() )
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        @endif

        @if(Auth::user())
        <form method="POST" enctype="multipart/form-data" action="{{ route('komentarai.store') }}">
            {{ csrf_field() }}

            <input type="file" name="image"
                   class="form-control" value="">
            <div class="input-group">
            <input name="text" type="text" class="form-control"
                value="{{ old('text') }}"
                placeholder="Rašyti komentarą..." aria-label="" aria-describedby="basic-addon1">

            <input type="hidden" name="theme_id" value="{{ $ThemeComments->id }}">
        <div class="input-group-append">
            <button class="btn btn-info" type="submit">Rašyti</button>
        </div>
            </div>
        </form>
        </div>
            <br>
        @endif

            <a href="{{ route('temos.show', $ThemeComments->category->id) }}">|| Grįžti į temas ||</a>
    </div>
    </div>

@endsection