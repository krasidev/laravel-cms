@extends('layouts.backend')

@section('title', __('menu.backend.users.text') . ' - ' . __('menu.backend.users.index'))

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-transparent d-flex align-items-center" data-toggle="collapse" data-target="#usersTableFilters" aria-expanded="false" aria-controls="usersTableFilters">
        {{ __('menu.backend.users.index') }}
        <button type="button" class="btn d-flex flex-shrink-0 ml-auto p-0">
            <i class="fas fa-filter text-primary"></i>
        </button>
    </div>

    <div class="card-body">
        <div id="usersTableFilters" class="collapse">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <select name="trashed" class="form-control users-table-filters">
                            <option value="0">{{ __('content.backend.users.table.filters.trashed.options.all') }}</option>
                            <option value="1">{{ __('content.backend.users.table.filters.trashed.options.deleted') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table id="users-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('content.backend.users.table.headers.id') }}</th>
                    <th>{{ __('content.backend.users.table.headers.name') }}</th>
                    <th>{{ __('content.backend.users.table.headers.email') }}</th>
                    <th>{{ __('content.backend.users.table.headers.created_at') }}</th>
                    <th>{{ __('content.backend.users.table.headers.updated_at') }}</th>
                    <th>{{ __('content.backend.users.table.headers.deleted_at') }}</th>
                    <th>{{ __('content.backend.users.table.headers.actions') }}</th>
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
        var usersTableFilters = $('.users-table-filters');
        var usersTable = $('#users-table').DataTable({
            serverSide: true,
            processing: true,
            order: [[0, 'desc']],
            ajax: {
                url: '{!! route('backend.users.index') !!}',
                data: function (data) {
                    usersTableFilters.each(function(index, element) {
                        data[element.name] = element.value;
                    });

                    $('[data-dt-toggle="tooltip"]').tooltip('dispose');
                },
                complete: function (data) {
                    var trashed = parseInt(data.responseJSON.input.trashed);

                    usersTable.column(4).visible(!trashed);
                    usersTable.column(5).visible(trashed);

                    $('[data-dt-toggle="tooltip"]').tooltip();
                }
            },
            columns: [
                { data: 'id', name: 'id', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'deleted_at', name: 'deleted_at', visible: false },
                { data: 'actions', name: 'actions', searchable: false, orderable: false, className: 'py-2' }
            ]
        });

        usersTableFilters.on('change', function() {
            usersTable.draw();
        });
    });
</script>
@endsection
