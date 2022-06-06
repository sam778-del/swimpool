@extends('layouts.app')

@section('page-title', __('Ordina') )

@section('page-toolbar')
<div class="row mb-3 align-items-center">
    <div class="col">
       <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ url("/home") }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{'Price' }}</li>
       </ol>
    </div>
</div>
 <!-- .row end -->
@endsection

@section('page-content')
<div class="col-12">
    <div class="row g-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table myDataTable table-hover align-middle mb-0 card-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Morning Price</th>
                                <th>Afternoon Price</th>
                                <th>Fullday Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                <tr>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->morning_amount }}</td>
                                    <td>{{ $item->afternoon_amount }}</td>
                                    <td>{{ $item->fullday_amount }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('price.edit', $item->id) }}" class="btn btn-link btn-sm color-400"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/bundle/dataTables.bundle.js') }}"></script>
<script>
    $('.myDataTable').addClass('nowrap').dataTable({
      responsive: true,
    });

        function addButton()
        {
            $(document).ready(function() {
                $(".item-row:last").after('<div class="row item-row">                        <div class="col-6">                            <label class="form-label text-primary">{{ __('Options Name') }}</label>                            <input type="text" name="option_name[]" class="form-control form-control-lg" placeholder="{{ __('Options Name') }}">                        </div>                        <div class="col-3">                            <label class="form-label text-primary">{{ __('Image') }}</label>                            <div class="col-md-12 col-sm-12">                                <div class="image-input avatar xxl rounded-4" style="background-image: url({{ asset('images/company-logo.png') }})">                                    <div class="avatar-wrapper rounded-4" style="background-image: url({{ asset('images/company-logo.png') }})"></div>                                    <div class="file-input">                                        <input type="file" class="form-control" name="image[]" id="file-input">                                        <label for="file-input" class="fa fa-pencil shadow text-muted"></label>                                    </div>                                </div>                            </div>                        </div>                        <div class="col-3">                            <button href="javascript:void(0);" type="button"  onclick="addButton();" class="btn btn-link btn-lg color-400"><i class="fa fa-plus-circle"></i></button>                            <button href="javascript:void(0);" type="button" onclick="removeButton(this)" class="btn btn-link btn-lg color-400"><i class="fa fa-minus-circle"></i></button>                        </div>                    </div>'); //add input box
            });
        }
        function removeButton(ele)
        {
            $(document).ready(function() {
                $(ele).parents('.item-row').remove();
            })
        }
  </script>
@endpush
