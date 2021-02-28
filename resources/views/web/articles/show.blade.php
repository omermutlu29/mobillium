@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3>Article Show</h3>

                    <div class="card-header">Rate: {{($article->getAverageRatingAttribute())}}
                        <br>{{$article->author->name}}
                        <br>{{$article->title}} </div>

                    <div class="card-body">
                        {!! $article->body !!}

                        @auth
                            <h5>Rate this : </h5>
                            <select name="rate" id="rate">
                                @foreach($points as $point)
                                    <option value="{{$point->id}}">{{$point->point}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-success btn-sm" id="rate-button">Rate</button>
                        @endauth
                        @if($prev)
                            <a href="{{route('web.article.show',$prev->id)}}">Prev</a>
                        @endif
                        @if($next)
                            <a href="{{route('web.article.show',$next->id)}}">Next</a>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#rate-button').on('click', function () {
                let ratePoint = ($('#rate').val());
                $.ajax({
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "rate": ratePoint
                    },
                    url: "{{route('web.article.rate',$article->id)}}",
                }).done(function (msg) {
                    alert(msg.message);
                });
            })
        });
    </script>
@endsection
