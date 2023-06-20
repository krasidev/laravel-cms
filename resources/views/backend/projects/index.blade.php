@extends('layouts.backend')

@section('title', __('menu.backend.projects.text') . ' - ' . __('menu.backend.projects.index'))

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent d-flex align-items-center" data-toggle="collapse" data-target="#projectsTableFilters" aria-expanded="false" aria-controls="projectsTableFilters">
        {{ __('menu.backend.projects.index') }}
        <button type="button" class="btn d-flex flex-shrink-0 ml-auto p-0">
            <i class="fas fa-filter text-primary"></i>
        </button>
    </div>

    <div class="card-body">
        <div id="projectsTableFilters" class="collapse">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <select name="trashed" class="form-control projects-table-filters">
                            <option value="0">{{ __('content.backend.projects.table.filters.trashed.options.all') }}</option>
                            <option value="1">{{ __('content.backend.projects.table.filters.trashed.options.deleted') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table id="projects-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('content.backend.projects.table.headers.id') }}</th>
                    <th>{{ __('content.backend.projects.table.headers.order') }}</th>
                    <th>{{ __('content.backend.projects.table.headers.name') }}</th>
                    <th>{{ __('content.backend.projects.table.headers.slug') }}</th>
                    <th>{{ __('content.backend.projects.table.headers.created_at') }}</th>
                    <th>{{ __('content.backend.projects.table.headers.updated_at') }}</th>
                    <th>{{ __('content.backend.projects.table.headers.deleted_at') }}</th>
                    <th>{{ __('content.backend.projects.table.headers.actions') }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('scripts')
@include('scripts.datatables')
<script>
    $(function() {
        var projectsTableFilters = $('.projects-table-filters');
        var projectsTable = $('#projects-table').DataTable({
            serverSide: true,
            processing: true,
            ordering: false,
            ajax: {
                url: '{!! route('backend.projects.index') !!}',
                data: function (data) {
                    projectsTableFilters.each(function(index, element) {
                        data[element.name] = element.value;
                    });

                    $('[data-dt-toggle="tooltip"]').tooltip('dispose');
                },
                complete: function (data) {
                    var trashed = parseInt(data.responseJSON.input.trashed);

                    projectsTable.column(5).visible(!trashed);
                    projectsTable.column(6).visible(trashed);

                    $('[data-dt-toggle="tooltip"]').tooltip();
                }
            },
            columns: [
                { data: 'id', name: 'id', searchable: false },
                { data: 'order', name: 'order', searchable: false, className: 'reorder py-2'},
                { data: 'name', name: 'name' },
                { data: 'slug', name: 'slug' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'deleted_at', name: 'deleted_at', visible: false },
                { data: 'actions', name: 'actions', searchable: false, orderable: false, className: 'py-2' }
            ],
            rowReorder: {
                dataSrc: 'id',
                selector: '.reorder'
            }
        });

        projectsTable.on('row-reorder', function(e, diff, edit) {
            var data = {};

            for (var i = 0, ien = diff.length; i < ien; i++) {
                data[diff[i].newData] = diff[i].oldData;
            }

            if (ien) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{!! route('backend.projects.reorder') !!}',
                    type: 'POST',
                    data: data,
                    dataType: 'json'
                });
            }
        });

        projectsTableFilters.on('change', function() {
            projectsTable.draw();
        });
    });
</script>
@endsection
