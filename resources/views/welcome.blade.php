@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="text-center">Najnoviji Članci</h3>
                </div>

                <div class="panel-body">
                    @if(count($posts) > 0)
                        @foreach($posts as $post)
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ url('/show/'.$post->id) }}">
                                        <h4 class="text-info">{{ $post->title }}</h4>
                                    </a>                                    
                                    <h5>{{ $post->updated_at->diffForHumans() }}, Autor: <span class="text-warning">{{ $post->user->name }}</span></h5>
                                    <p>{{ str_limit($post->content, $limit = 320, $end = '...') }}</p>
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
@endsection
