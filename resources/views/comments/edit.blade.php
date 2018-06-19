@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">Izmeni komentar</div>

                <div class="panel-body">
                    <form class="form-horizontal formapost" action="{{ url('/editcomment') }}" role="form" method="POST">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="commentid" value="{{ $comment->id }}">
                        <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                        {{-- input za ime posta --}}
                        <div class="postinput form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Naslov Koemntara</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="@if(!old('title')){{$comment->title}}@endif {{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>     
                        </div>
                        {{-- textarea za text posta --}}
                        <div class="postinput form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Tekst Komentara</label>
                            <div class="col-md-6">
                                <textarea name="content" id="content" rows="15" class="form-control" placeholder="Ovde dodajte vaš tekst...">@if(!old('content')){{ $comment->content }}@endif{{ old('content') }}
                                </textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>          
                        </div>
                        {{-- submit btn --}}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button id="submitformamodel" type="submit" class="btn btn-primary">
                                        Sačuvaj
                                    </button>
                                    <span id="extrabtn"></span>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection