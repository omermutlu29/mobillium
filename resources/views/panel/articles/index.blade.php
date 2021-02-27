@extends('layouts.panel')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">All Articles</h1>
    @if (\Session::has('error'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <td>id</td>
            <td>title</td>
            <td>body</td>
            <td>published</td>
            <td>actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->body}}</td>
                <td>{{$article->published ? 'Published' : 'Unpublished'}}</td>
                <td><a href="{{route('panel.article.delete',$article->id)}}" class="btn btn-sm btn-danger">DELETE</a><a href="{{route('panel.article.edit',$article->id)}}" style="margin-left: 5px" class="btn btn-sm btn-primary">EDİT</a></td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
