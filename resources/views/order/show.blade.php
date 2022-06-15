@extends('layouts.app')

@section('page-title', __('Ordina') )

@section('page-toolbar')
<div class="row mb-3 align-items-center">
    <div class="col">
       <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ url("/home") }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item" aria-current="page">{{ __('Ordina') }}</li>
          <li class="breadcrumb-item active" aria-current="page">{{ $order->order_id }}</li>
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
                                <th>ORDER ID</th>
                                <th>Nome</th>
                                <th>Booked Date</th>
                                <th class="text-center">Amount</th>
                                <th>Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_price = 0 ?>
                            @foreach ($data['maps'] as $item)
                                @php
                                    $map = \App\Models\Soccer::findorfail($item->map_id);   
                                    $priceType = $item->day;
                                    $price = $item->amount;
                                    $total_price += $price;
                                @endphp
                                
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center"> 
                                            <div class="ms-2">
                                                <div class="mb-0">{{ $map->name }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div><span class="fw-bold ms-1">{{ date('D-M-Y', strtotime($item->booked_date)) }}</span></div>
                                    </td>
                                    <td class="text-center">
                                        <div><span class="fw-bold ms-1">&euro;{{ $price }}</span></div>
                                    </td>
                                    <td class="project-actions">
                                        {{ $map->duration }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-center"><div>Total Amount: <span class="fw-bold ms-1">&euro;{{ $total_price }}</span></div></th>
                                <th class="text-center"></th>
                            </tr>
                        </tfoot>
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
  </script>
@endpush
