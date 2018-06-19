@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Komentari</div>

                <div class="panel-body">
                    @if(count($comments) > 0)
                    	@foreach($comments as $comment)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <h4 class="text-info">{{ $comment->title }}</h4>
                                    </div>
                                    <div class="col-md-5">
                                        <small class="text-info">{{ $comment->content }}</small>
                                    </div>
                                    <div class="col-md-3">
                                        @if(Auth::user()->id == $comment->user_id)
                                        <div class="btn-group btn-group-lg">
                                            <button type="button" cattitle="{{ $comment->title }}" catid="{{ $comment->id }}" class="btn btn-success izmenibtn">
                                                <a href="{{ url('/commentedit/'.$comment->id.'?_token='.csrf_token()) }}">
                                            		Izmeni
                                            	</a>
                                            </button>
                                            <button type="button" class="btn btn-danger obrisibtn">
                                                <a href="{{ url('/deletecomment/'.$comment->id.'?_token='.csrf_token()) }}">
                                                    Obriši
                                                </a>
                                            </button>  
                                        </div>
                                        @else
                                        	<p class="text-danger">
                                                Samo autor komentara moze menjati i brisati komentar.
                                            </p>
                                        @endif
                                    </div>                                   
                                </div>                         
                            </div><hr>
                        @endforeach                     
                    @else
                    	<h3>Nema Dodatih Komentara</h3>
                    @endif
                    {{ $comments->links() }}
                </div>
            </div>
        </div>    
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/comments.js') }}"></script>
<script type="text/javascript">
</script>
@endsection