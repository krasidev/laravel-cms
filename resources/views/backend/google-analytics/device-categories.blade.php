@extends('layouts.backend')

@section('title', __('menu.backend.google-analytics.text') . ' - ' . __('menu.backend.google-analytics.device-categories'))

@section('content')
<div class="card shadow-sm mb-3">
    <div class="card-header bg-transparent d-flex align-items-center">
        {{ __('menu.backend.google-analytics.device-categories') }}
        @can('manage_system')
            <a href="{{ route('backend.google-analytics.sync.device-categories') }}" class="btn d-flex flex-shrink-0 ml-auto p-0">
                <i class="fas fa-sync text-primary"></i>
            </a>
        @endcan
    </div>

    <div class="card-body">
        <div class="row" style="margin-bottom: -1rem;">
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <select name="name" class="form-control datatable-filters select2" data-placeholder="{{ __('content.backend.google-analytics.table.filters.options.device-category') }}">
                        <option value="">{{ __('content.backend.google-analytics.table.filters.options.device-category') }}</option>
                        @foreach ($deviceCategories as $deviceCategory)
                            <option value="{{ $deviceCategory->name }}">{{ $deviceCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @include('backend.google-analytics.filters.datepickers')
        </div>
    </div>
</div>

@include('backend.google-analytics.highchart.area-visitors-and-pageviews')

<div class="card shadow-sm">
    <div class="card-header bg-transparent">
        {{ __('content.backend.google-analytics.table.title') }}
    </div>

    <div class="card-body">
        <table id="device-categories-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('content.backend.google-analytics.table.headers.device-category') }}</th>
                    <th>{{ __('content.backend.google-analytics.table.headers.visitors') }}</th>
                    <th>{{ __('content.backend.google-analytics.table.headers.pageviews') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@include('backend.google-analytics.scripts.datepickers')
@include('backend.google-analytics.scripts.highcharts')
@include('scripts.datatables')
<script>
    $(function() {
        var dataTableFilters = $('.datatable-filters');
        var deviceCategoriesTable = $('#device-categories-table').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{!! route('backend.google-analytics.device-categories') !!}',
                data: function (data) {
                    dataTableFilters.each(function(index, element) {
                        data[element.name] = element.value;
                    });

                    $.ajax({
                        url: '{!! route('backend.google-analytics.device-categories', ['highcharts']) !!}',
                        data: data,
                        success: function (data) {
                            createChart(data);
                        }
                    });
                }
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'visitors', name: 'visitors' },
                { data: 'pageviews', name: 'pageviews' }
            ]
        });

        dataTableFilters.on('change', function() {
            deviceCategoriesTable.draw();
        });
    });
</script>
@endsection
