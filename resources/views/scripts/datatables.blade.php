<script>
    $.extend(true, $.fn.dataTable.defaults, {
        responsive: true,
        classes: {
            sLength: 'dataTables_length form-group',
            sLengthSelect: 'form-control',
            sFilter: 'dataTables_filter form-group',
            sFilterInput: 'form-control'
        },
        language: {
            lengthMenu: '{{ __('datatables.lengthMenu') }}',
            search: '{{ __('datatables.search') }}',
            searchPlaceholder: '{{ __('datatables.searchPlaceholder') }}',
            loadingRecords: '{{ __('datatables.loadingRecords') }}',
            emptyTable: '{{ __('datatables.emptyTable') }}',
            zeroRecords: '{{ __('datatables.zeroRecords') }}',
            info: '{{ __('datatables.info') }}',
            infoEmpty: '{{ __('datatables.infoEmpty') }}',
            infoFiltered: '{{ __('datatables.infoFiltered') }}',
            processing: '<div class="spinner-border" role="status"><span class="sr-only"></span></div>',
            paginate: {
                first: '<i class="fas fa-angle-double-left"></i>',
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                last: '<i class="fas fa-angle-double-right"></i>'
            }
        }
    });

    $(document).on('click', '.dt-bt-delete', function(e) {
        var element = $(this);

        Swal.fire({
            icon: 'question',
            title: '{{ __('datatables.sweetalert2.delete.question.title') }}',
            text: '{{ __('datatables.sweetalert2.delete.question.text') }}',
            confirmButtonText: '{{ __('datatables.sweetalert2.delete.question.confirm-button-text') }}',
            cancelButtonText: '{{ __('datatables.sweetalert2.cancel-button-text') }}',
            showCancelButton: true,
            buttonsStyling: false,
            customClass: {
                confirmButton: 'swal2-styled btn btn-danger m-1',
                cancelButton: 'swal2-styled btn btn-primary m-1'
            }
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: element.attr('href'),
                    type: 'DELETE',
                    success: function(data) {
                        element.closest('table').DataTable().row(element.parents('tr')).remove().draw();
                    }
                });
            }
        });

        e.preventDefault();
    });

    $(document).on('click', '.dt-bt-restore', function(e) {
        var element = $(this);

        Swal.fire({
            icon: 'question',
            title: '{{ __('datatables.sweetalert2.restore.question.title') }}',
            text: '{{ __('datatables.sweetalert2.restore.question.text') }}',
            confirmButtonText: '{{ __('datatables.sweetalert2.restore.question.confirm-button-text') }}',
            cancelButtonText: '{{ __('datatables.sweetalert2.cancel-button-text') }}',
            showCancelButton: true,
            buttonsStyling: false,
            customClass: {
                confirmButton: 'swal2-styled btn btn-success m-1',
                cancelButton: 'swal2-styled btn btn-primary m-1'
            }
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: element.attr('href'),
                    type: 'PATCH',
                    success: function(data) {
                        element.closest('table').DataTable().row(element.parents('tr')).remove().draw();
                    }
                });
            }
        });

        e.preventDefault();
    });
</script>
