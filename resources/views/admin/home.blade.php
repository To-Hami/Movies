@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('site.home')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
    </ul>

    <div class="col-md-12" id="top-statistics">
        <div class="row">

            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <i class=" fa fa-list "><span class="mx-2"
                                                          style="font-size: 20px">@lang('genres.genre')</span></i>
                            <a href="{{route('admin.genres.index')}}">@lang('site.show_all')</a>
                        </div>
                        <div class="loader loader-sm mt-2"></div>
                        <p style="display: none" id="genres_count"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <i class=" fa fa-film "><span class="mx-2"
                                                          style="font-size: 20px">@lang('movies.movie')</span></i>
                            <a href="{{route('admin.movies.index')}}">@lang('site.show_all')</a>
                        </div>
                        <div class="loader loader-sm mt-2"></div>
                        <p style="display: none" id="movies_count"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <i class=" fa fa-user-o "><span class="mx-2"
                                                            style="font-size: 20px">@lang('actors.actor')</span></i>
                            <a href="{{route('admin.actors.index')}}">@lang('site.show_all')</a>
                        </div>
                        <div class="loader loader-sm mt-2"></div>

                        <p style="display: none" id="actors_count"></p>
                    </div>
                </div>
            </div>


        </div>


        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">


                        <div class="d-flex justify-content-between">
                            <h3>@lang('movies.movies_chart')</h3>
                            <select style="width: 100px" id="movies-chart-year">
                                @for($i=6 ; $i >= 0 ; $i--)
                                    <option
                                        value="{{now()->subYears($i)->year}}" {{now()->subYears($i)->year  ==  now()->year  ? 'selected' : ''}}>
                                        {{now()->subYears($i)->year}}</option>
                                @endfor
                            </select>
                        </div>


                        <div id="movies-chart-wrapper">

                            {{--                            @include('admin._movies_chart')--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>@lang('movies.popular')
                            <a href="{{route('admin.movies.index')}}">@lang('site.show_all')</a>
                        </h3>
                        <table class=" table table-hover">
                            <tr>
                                <td>#id</td>
                                <td width = 30% >@lang('movies.title')</td>
                                <td>@lang('movies.vote')</td>
                                <td>@lang('movies.vote_count')</td>
                                <td>@lang('movies.release_date')</td>
                            </tr>
                            @foreach($popularMovies as $index => $movie)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>
                                        <a href="{{route('admin.movies.show',$movie->id)}}">
                                            {{$movie->title}}
                                        </a>

                                    </td>
                                    <td><i class="fa fa-star text-warning"></i> {{$movie->vote}}</td>
                                    <td>{{$movie->vote_Count}}</td>
                                    <td>{{$movie->release_date}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

{{--        End of populars movies --}}



        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>@lang('movies.upcoming')
                            <a href="{{route('admin.movies.index',['type' => 'upcoming'])}}">@lang('site.show_all')</a>

                        </h3>
                        <table class=" table table-hover">
                            <tr>
                                <td>#id</td>
                                <td width="30%">@lang('movies.title')</td>
                                <td>@lang('movies.vote')</td>
                                <td>@lang('movies.vote_count')</td>
                                <td>@lang('movies.release_date')</td>
                            </tr>
                            @foreach($upcomingMovies as $index => $movie)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>
                                        <a href="{{route('admin.movies.show',$movie->id)}}">
                                            {{$movie->title}}
                                        </a>

                                    </td>
                                    <td><i class="fa fa-star text-warning"></i> {{$movie->vote}}</td>
                                    <td>{{$movie->vote_Count}}</td>
                                    <td>{{$movie->release_date}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        {{--        End of upcoming movies --}}




        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>@lang('movies.now_playing')
                            <a href="{{route('admin.movies.index',['type' => 'now_playing'])}}">@lang('site.show_all')</a>
                        </h3>

                        <table class=" table table-hover">
                            <tr>
                                <td>#id</td>
                                <td width="30%">@lang('movies.title')</td>
                                <td>@lang('movies.vote')</td>
                                <td>@lang('movies.vote_count')</td>
                                <td>@lang('movies.release_date')</td>
                            </tr>
                            @foreach($now_playingMovies as $index => $movie)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>
                                        <a href="{{route('admin.movies.show',$movie->id)}}">
                                            {{$movie->title}}
                                        </a>

                                    </td>                                    <td><i class="fa fa-star text-warning"></i> {{$movie->vote}}</td>
                                    <td>{{$movie->vote_Count}}</td>
                                    <td>{{$movie->release_date}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection







@push('scripts')

    <script>

        $(function () {

            topStatistics();
            moviesChart("{{now()->year}}");


            // on change year of chart

            $("#movies-chart-year").on('change', function () {

                let year = $(this).find(':selected').val();

                moviesChart(year);

            });


        });

        function topStatistics() {
            $.ajax({
                url: "{{ route('admin.home.top_statistics') }}",
                cache: false,
                success: function (data) {

                    $('#top-statistics .loader-sm').hide();

                    $(' #genres_count').show().text(data.genres_count);
                    $(' #movies_count').show().text(data.movies_count);
                    $(' #actors_count').show().text(data.actors_count);

                },

            });//end of ajax call
        }


        //  to get chart
        function moviesChart(year) {

            let loader = `

                    <div class="d-flex justify-content-center">
                          <div class=" loader loader-md "></div>
                    </div>


                         `;

            $('#movies-chart-wrapper').empty().append(loader);

            $.ajax({

                url: "{{route('admin.home.movies_chart')}}",


                data: {
                    'year': year,
                },

                cache: false,

                success: function (html) {
                    $('#movies-chart-wrapper').empty().append(html);
                },


            })
        }


    </script>
@endpush
