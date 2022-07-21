@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('movies.movies')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.movies.index') }}">@lang('movies.movies')</a></li>
        <li class="breadcrumb-item">@lang('site.show')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row">
                    <div class="col-md-2">
                        <img src="{{$movie->poster_path}}" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-10">
                        <h3>{{$movie->title}}</h3>


                        @foreach($movie->genres as $genre)
                            <span class=" btn btn-primary btn-sm">{{$genre->name}}</span>
                        @endforeach


                        <p style="font-size: 20px">{{$movie->description}}</p>

                        <div class="d-flex">
                            <i class="fa fa-star text-warning" style="font-size: 30px"></i>
                            <h3 class="mx-2">{{$movie->vote}}</h3>
                            <p class="align-self-center"
                               style="margin-bottom: 0">@lang('movies.by') {{$movie->vote_Count}}</p>
                        </div>

                        <p><span style="font-weight: bold">@lang('movies.language') :  </span>En</p>
                        <p><span
                                style="font-weight: bold">@lang('movies.release_date') :  </span>{{$movie->release_date ->format('D-M-Y')}}
                        </p>

                        <hr>

                        <span class=" btn btn-primary btn-sm">Images</span>

                        <div class="row image_path">

                            @foreach($movie->images as $image)

                                <div class="col-md-3">
                                    <a href="{{$image->image_path}}">
                                        <img src="{{$image->image_path}}" class="img-fluid my-2 img-thumbnail">

                                    </a>
                                </div>

                            @endforeach
                        </div>
                        <hr>
                        <span class=" btn btn-primary btn-sm">Actors</span>

                        <div class="row image_path">
                            @foreach($movie->actors as $actor)

                                <div class="col-md-3">
                                    @if($actor ->image)
                                        <a href="{{$actor->image_path }}">
                                            <img src="{{$actor->image_path  }}" class="img-fluid my-2 img-thumbnail">

                                        </a>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')
    <script>
        $(function () {
            $('.image_path').each(function () { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled: true
                    }
                });
            });
        });


    </script>


@endpush
