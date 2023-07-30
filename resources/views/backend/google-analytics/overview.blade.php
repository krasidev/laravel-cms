@extends('layouts.backend')

@section('title', __('menu.backend.google-analytics.text') . ' - ' . __('menu.backend.google-analytics.overview'))

@section('content')
<div class="card shadow-sm mb-3">
    <div class="card-header bg-transparent d-flex align-items-center">
        {{ __('menu.backend.google-analytics.overview') }}
        @can('manage_system')
            <a href="{{ route('backend.google-analytics.sync.overview') }}" class="btn d-flex flex-shrink-0 ml-auto p-0">
                <i class="fas fa-sync text-primary"></i>
            </a>
        @endcan
    </div>

    <div class="card-body">
        <div class="row mb-n3">
            @include('backend.google-analytics.filters.datepickers')
        </div>
    </div>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-header bg-transparent d-flex align-items-center">
        {{ __('content.backend.google-analytics.sunburstchart.title') }}
    </div>

    <div class="card-body">
        <div class="row mb-n3">
            <div class="col-12 col-lg-6 pb-3">
                <div class="w-100 position-relative" style="padding-top: 100%">
                    <div class="position-absolute inset-0">
                        <svg id="chart-sunburst-visitors"></svg>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 pb-3">
                <div class="w-100 position-relative" style="padding-top: 100%">
                    <div class="position-absolute inset-0">
                        <svg id="chart-sunburst-pageviews"></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-n3">
    @include('backend.google-analytics.highchart.area-visitors-and-pageviews')
</div>
@endsection

@section('scripts')
@include('backend.google-analytics.scripts.datepickers')
@include('backend.google-analytics.scripts.sunburstchart')
@include('backend.google-analytics.scripts.highcharts')
<script>
    $(function() {
        var dataTableFilters = $('.datatable-filters');

        dataTableFilters.on('change', function() {
            var data = {};

            dataTableFilters.each(function(index, element) {
                data[element.name] = element.value;
            });

            $.ajax({
                url: '{!! route('backend.google-analytics.overview') !!}',
                data: data,
                success: function (data) {
                    sunburstChart('#chart-sunburst-visitors', JSON.parse(data.visitors));
                    sunburstChart('#chart-sunburst-pageviews', JSON.parse(data.pageviews));
                }
            });

            $.ajax({
                url: '{!! route('backend.google-analytics.overview', ['highcharts']) !!}',
                data: data,
                success: function (data) {
                    createChart(data);
                }
            });
        });

        $(dataTableFilters[0]).change();
    });
</script>
@endsection
