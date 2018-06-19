@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            
                <div class="panel-heading">
                    <h3>Dobar dan korisnice. Ulogovani ste kao: {{ Auth::user()->name }}</h3>
                </div>

                <div class="panel-body">
                    Možete administrirati 
                    <a href="{{ url('/categories') }}">Kategorije</a>, 
                    <a href="{{ url('/posts') }}">Članke</a> ili 
                    <a href="{{ url('/comments') }}">Komentare</a>.
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
