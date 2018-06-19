@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Članci</div>
                <div class="panel-body">
                    <div class="row">
                        <h3 class="text-info text-center naslovforme">Dodaj Članak</h3>
                        <form class="form-horizontal formapost" action="{{ url('/addpost') }}" role="form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                            {{-- select za kategoriju --}}
                            <div class="posttitleinput postinput form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Kategorija</label>
                                <div class="col-md-6">
                                    <select id="category" name="category" class="form-control">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach 
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>     
                            </div>
                            {{-- input za ime posta --}}
                            <div class="postinput form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Naslov</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>     
                            </div>
                            {{-- textarea za text posta --}}
                            <div class="postinput form-group {{ $errors->has('tekst') ? ' has-error' : '' }}">
                                <label for="tekst" class="col-md-4 control-label">Tekst</label>
                                <div class="col-md-6">
                                    <textarea name="tekst" id="tekst" rows="15" class="form-control" placeholder="Ovde dodajte vaš tekst...">@if(old('tekst')){{ old('tekst') }}@endif</textarea>
                                    @if ($errors->has('tekst'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tekst') }}</strong>
                                        </span>
                                    @endif
                                </div>          
                            </div>
                            {{-- submit btn --}}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="submitbtn" type="submit" class="btn btn-primary">
                                        Sačuvaj
                                    </button>
                                    <span id="extrabtn"></span>
                                </div>
                            </div>
                        </form>
                    </div><hr>
                    <h2 class="text-info">Do Sada Dodati Članci</h2><hr>
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <h4 class="text-success">{{ $post->title }}</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 class="text-success">{{ $post->updated_at->diffForHumans() }}</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 class="text-success">{{ $post->category->title }}</h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 class="text-success">{{ $post->user->name }}</h5>
                                    </div>
                                    <div class="col-md-3">
                                        @if(Auth::user()->id == $post->user_id)
                                            <div class="btn-group btn-group-lg">
                                                <button type="button" postid="{{ $post->id }}" class="btn btn-primary izmenibtn">Izmeni</button>
                                                <button type="button" class="btn btn-danger obrisibtn">
                                                    <a href="{{ url('/deletepost/'.$post->id.'?_token='.csrf_token()) }}">
                                                        Obriši
                                                    </a>
                                                </button>  
                                            </div>
                                        @else
                                            <p class="text-danger">
                                                Samo autor članka moze menjati i brisati članak.
                                            </p>
                                        @endif
                                    </div>                                   
                                </div>                         
                            </div><hr>
                        @endforeach
                        {{ $posts->links() }}
                    @else
                        <h3>Nema Dodatih Članaka</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="{{ asset('js/posts.js') }}"></script>
<script type="text/javascript">
    var homeurl = '{{ url('/') }}';
    var token = '{{ Session::token() }}';
    var postdataurl = '{{ url('/postdata') }}';
    var oldpostid = '{{ old('postid') }}';
</script>

@endsection
