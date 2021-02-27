@extends('layouts.panel')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Article</h1>
    <form action="{{route('panel.article.update',$article->id)}}" method="POST" class="form">
        @csrf
        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <input type="text" name="title" class="form-control form-control-user" id="title" value="{{$article->title}}"
                       placeholder="Title">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <textarea type="text" name="body" rows="10" cols="50" class="form-control form-control-user" id="exampleFirstName"
                          placeholder="Your article here">{{$article->body}}</textarea>
            </div>
        </div>
        <div class="form-group row align-content-center">
            <div class="col-sm-12 mb-3 mb-sm-0 align-content-center" >
                <input class="btn-primary btn btn-lg " type="submit" value="SAVE">
            </div>
        </div>
    </form>
@endsection
