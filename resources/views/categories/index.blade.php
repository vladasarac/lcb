@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>

                <div class="panel-body">
                    <div class="row">
                        <h3 class="text-info text-center naslovforme">Dodaj Kategoriju</h3>
                        <form class="form-horizontal formakategorija" action="{{ url('/addcategory') }}" role="form" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            {{-- input za ime kategorije --}}
                            <div class="cattitleinput form-group {{ $errors->has('kategorija') ? ' has-error' : '' }}">
                                <label for="kategorija" class="col-md-4 control-label">Ime</label>
                                <div class="col-md-6">
                                    <input id="kategorija" type="text" class="form-control" name="kategorija" value="{{ old('kategorija') }}">
                                    @if ($errors->has('kategorija'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('kategorija') }}</strong>
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
                    </div><hr>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        <h4 class="text-info">{{  $category->title  }}</h4>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="btn-group btn-group-lg">
                                            <button type="button" cattitle="{{ $category->title }}" catid="{{ $category->id }}" class="btn btn-primary izmenibtn">Izmeni</button>
                                            <button type="button" class="btn btn-danger obrisibtn">
                                                <a href="{{ url('/deletecategory/'.$category->id.'?_token='.csrf_token()) }}">
                                                    Obriši
                                                </a>
                                            </button>  
                                        </div>
                                    </div>                                   
                                </div>                         
                            </div><br>
                        @endforeach
                    @else
                        <h3>Nema Dodatih Kategorija</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/categories.js') }}"></script>
<script type="text/javascript">
    var homeurl = '{{ url('/') }}';
    var token = '{{ Session::token() }}';
</script>

@endsection