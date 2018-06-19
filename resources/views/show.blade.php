@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-md-12">

			<div class="row">
				<h1 class="text-center">{{ $post->title }}</h1>
				<h4>{{ $post->updated_at->diffForHumans() }}, Autor: {{ $post->user->name }}, {{ $post->category->title }}</h4>
				<p>{{ $post->content }}</p>
			</div>

			<div class="row">
				@if (Auth::guest())
				    <h4 class="text-center text-danger">
				    	Ako želite da ostavite komentar morate biti ulogovani.
				    </h4>
				@else
                    <hr>
                    {{-- forma za dodavanje komentara --}}
					<form class="form-horizontal formacomment" action="{{ url('/addcomment') }}" role="form" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="postid" value="{{ $post->id }}">
                        {{-- input za sadrzaj kometara --}}
                        <div class="commentinput form-group {{ $errors->has('commenttitle') ? ' has-error' : '' }}">
                            <label for="commenttitle" class="col-md-4 control-label">Naslov komentara</label>
                            <div class="col-md-6">
                                <input id="commenttitle" type="text" class="form-control" name="commenttitle" value="{{ old('commenttitle') }}">
                                @if ($errors->has('commenttitle'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('commenttitle') }}</strong>
                                    </span>
                                @endif
                            </div>     
                        </div>
                        {{-- textarea za text posta --}}
                        <div class="form-group {{ $errors->has('commenttext') ? ' has-error' : '' }}">
                            <label for="commenttext" class="col-md-4 control-label">Tekst Komentara</label>
                            <div class="col-md-6">
                                <textarea name="commenttext" id="commenttext" rows="4" class="form-control" placeholder="Ovde dodajte vaš komentar...">@if(old('commenttext')){{ old('commenttext') }}@endif</textarea>
                                @if ($errors->has('commenttext'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('commenttext') }}</strong>
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
                    <hr>
				@endif	
			</div>

            <div class="row">
                @if(count($post->comments) > 0)
                    <div class="col-md-7 col-md-offset-2">
                        <h3 class="text-info">Komentari</h3>
                        @foreach($comments as $comment)
                            <h5>
                                {{ $comment->title }} 
                                <span class="text-info">({{ $comment->user->name }}, {{ $comment->updated_at->diffForHumans() }})</span>
                            </h5>
                            <p>{{ $comment->content }}</p><hr>
                        @endforeach
                    </div>                 
                @else
                    <h4 class="text-center">Članak nema dodatih komentara.</h4>
                @endif
            </div>
			
		</div>
	</div>
@endsection



