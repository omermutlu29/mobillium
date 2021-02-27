@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Makaleler</div>
                    <div class="card-body">
                        @foreach($articles as $article)
                            <div class="container" style="margin-top: 10px">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">Author : {{$article->author->name}} <br><a
                                                    href="{{route('web.article.show',$article->id)}}">{{$article->title}}</a>
                                            </div>
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            {{$articles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
