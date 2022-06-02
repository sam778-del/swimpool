@extends('layouts.app')

@section('page-title', __('Accesory') )

@section('page-toolbar')
<div class="row mb-3 align-items-center">
    <div class="col">
       <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ url("/home") }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Accessory') }}</li>
       </ol>
    </div>
</div>
 <!-- .row end -->
@endsection

@section('page-content')
<div class="row-title  card-body border-bottom">
    <div class="col col-3">
    </div>
    <div class="btn-group" role="group">
        @can('Create Accessories')
            <a href="{{ route("accessory.create") }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                {{ __('Crea Accesory') }}
            </a>
        @endcan
    </div>
</div>
<div class="col-12">
    <div class="card-body border-bottom">
        <div class="row align-items-center">
            {{-- Other Widget --}}
            <div class="col ml-n2">
            </div>
            {{-- End of other widget --}}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="table_list" class="table align-middle mb-0 card-table" cellspacing="0">
                <thead>
                    <tr>
                        <th>{{ __('Nome') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Type') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#table_list')
        .addClass( 'nowrap' )
        .dataTable( {
            responsive: true,
            ordering: false,
            processing: true,
            serverSide: true,
            aoColumnDefs: [
                {"aTargets": [0], "bSortable": true},
                {"aTargets": [2], "asSorting": ["asc"], "bSortable": true},
            ],
            "oLanguage": {
                "url": "{{ asset('js/italian.json') }}"
            },
            ajax: '{{ route('accessory.datatables') }}',
            columns: [
                { data: 'name', name: 'name' },
                { data: 'amount', name: 'amount' },
                { data: 'type', name: 'type' },
                { data: 'action', searchable: false, orderable: false }
            ],
            language : {
                processing: '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
            },
        });
    });
    function makeDefault(url)
    {
        Swal.fire({
            title: '{{ __("Vuoi salvare le modifiche?") }}',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: '{{ __("Continue") }}',
            denyButtonText: `{{ __("Cancel") }}`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: "PATCH",
                    data: {
                        _token: "{!! csrf_token() !!}"
                    },
                    success: function(data) {
                        var oTable = $('#table_list').dataTable();
                        oTable.fnDraw(false);
                        if(data.status == true){
                            toastr.success("{{__('Success') }}", data.msg, 'success');
                        }else{
                            toastr.error("{{__('Error') }}", data.msg, 'error');
                        }
                    },
                    error: function(error) {
                        Swal.fire('{{ __("L'azione non può essere completata") }}', '', 'error')
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('{{ __("Modifiche annullate") }}', '', 'info')
            }
        })
    }
    function deleteAction(url)
    {
        Swal.fire({
            title: '{{ __("Vuoi salvare le modifiche?") }}',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: '{{ __("Continue") }}',
            denyButtonText: `{{ __("Cancel") }}`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: "DELETE",
                    data: {
                        _token: "{!! csrf_token() !!}"
                    },
                    success: function(data) {
                        var oTable = $('#table_list').dataTable();
                        oTable.fnDraw(false);
                        if(data.status == true){
                            toastr.success("{{__('Success') }}", data.msg, 'success');
                        }else{
                            toastr.error("{{__('Error') }}", data.msg, 'error');
                        }
                    },
                    error: function(error) {
                        Swal.fire('{{ __("L\'azione non può essere completata") }}', '', 'error')
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('{{ __("Modifiche annullate") }}', '', 'info')
            }
        })
    }
</script>
@endpush
