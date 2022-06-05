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
                                <th class="text-center">Numbero Di Personne</th>
                                <th>Accessory</th>
                                <th>Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_price = 0 ?>
                            @foreach ($data['maps'] as $item)
                                @php
                                    $map = \App\Models\Map::findorfail($item->map_id);   
                                    $accessory = \App\Models\Accesory::find($item->accessory_id);
                                    $ConverDate = date("l", strtotime($item->booked_date));
                                    $ConverDateTomatch = strtolower($ConverDate);
                                    $priceType = $item->day;
                                    if($accessory)
                                    {
                                        $accessoryAmount = $accessory->amount;
                                    }else{
                                        $accessoryAmount = 0;
                                    }
                                    if($ConverDateTomatch == "saturday")
                                    {
                                        $price = $map->maps->saturday_price  + $accessoryAmount;
                                    }elseif($ConverDateTomatch == "sunday"){
                                        $price = $map->maps->sunday_price  + $accessoryAmount;
                                    }else{
                                        if($priceType == 1)
                                        {
                                            $price = $map->maps->full_day_price + $accessoryAmount;
                                        }
                                        else if($priceType == 2){
                                            $price = $map->maps->morning_price + $accessoryAmount;
                                        }
                                        else if($priceType == 3){
                                            $price = $map->maps->afternoon_price + $accessoryAmount;
                                        }
                                    } 
                                    $total_price += $price;
                                @endphp
                                
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center"> <img src="{{ asset('images/ico-lettino.png') }}" class="rounded-circle avatar" alt="">
                                            <div class="ms-2">
                                                <div class="mb-0">{{ $map->type.' '.$map->lettini_number }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div><span class="fw-bold ms-1">{{ date('D-M-Y', strtotime($item->booked_date)) }}</span></div>
                                    </td>
                                    <td class="text-center">
                                        <div><span class="fw-bold ms-1">&euro;{{ $price }}</span></div>
                                    </td>
                                    <td class="text-center">
                                        {{ $item->persons }}
                                    </td>
                                    <td class="text-center"><span class="badge bg-success">{{ !empty($accessory->name) ? 'Con '.$accessory->name  : '' }}</span></td>
                                    <td class="project-actions">
                                        @if($item->day == 1)
                                            GIORNATA INTERA 9:00-18:00
                                        @elseif($item->day == 2)
                                            MATTINA 9:00-13:00
                                        @else
                                            POMERIGGIO 13:30-18:00
                                        @endif
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
                                <th></th>
                                <th></th>
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
