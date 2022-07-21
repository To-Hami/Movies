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
                        <i class=" fa fa-list "><span class="mx-2" style="font-size: 20px">@lang('genres.genre')</span></i>
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
                        <i class=" fa fa-film "><span class="mx-2" style="font-size: 20px">@lang('movies.movie')</span></i>
                        <a href="{{route('admin.movies.index')}}">@lang('site.show_all')</a>
                    </div>
                    <div class="loader loader-sm mt-2"></div>
                    <p style="display: none" id="movies_count" ></p>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class=" fa fa-user-o "><span class="mx-2" style="font-size: 20px">@lang('actors.actor')</span></i>
                        <a href="{{route('admin.actors.index')}}">@lang('site.show_all')</a>
                    </div>
                    <div class="loader loader-sm mt-2"></div>

                    <p  style="display: none" id="actors_count"></p>
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

            moviesChart("{{ now()->year }}");

            $('#movies-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                moviesChart(year);

            });//end of on change

        });//end of document ready

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

        {{--function moviesChart(year) {--}}

        {{--    let loader = `--}}
        {{--            <div class="d-flex justify-content-center align-items-center">--}}
        {{--                <div class="loader loader-md"></div>--}}
        {{--            </div>--}}
        {{--        `;--}}

        {{--    $('#movies-chart-wrapper').empty().append(loader);--}}

        {{--    $.ajax({--}}
        {{--        url: "{{ route('admin.home.movies_chart') }}",--}}
        {{--        data: {--}}
        {{--            'year': year,--}}
        {{--        },--}}
        {{--        cache: false,--}}
        {{--        success: function (html) {--}}

        {{--            $('#movies-chart-wrapper').empty().append(html);--}}

        {{--        },--}}

        {{--    });//end of ajax call--}}

        {{--}--}}
    </script>
@endpush
