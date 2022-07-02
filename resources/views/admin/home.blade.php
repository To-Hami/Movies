@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('site.home')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
    </ul>


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

                    $('#top-statistics #genres-count').show().text(data.genres_count);
                    $('#top-statistics #movies-count').show().text(data.movies_count);
                    $('#top-statistics #actors-count').show().text(data.actors_count);

                },

            });//end of ajax call
        }

        function moviesChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#movies-chart-wrapper').empty().append(loader);

            $.ajax({
                url: "{{ route('admin.home.movies_chart') }}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#movies-chart-wrapper').empty().append(html);

                },

            });//end of ajax call

        }
    </script>
@endpush
