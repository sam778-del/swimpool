@extends('layouts.app')

@section('page-title', __('Ordina') )

@section('page-toolbar')
<div class="row mb-3 align-items-center">
    <div class="col">
       <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ url("/home") }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item"><a class="text-secondary">{{ $client->first_name.' '.$client->last_name }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Ordina') }}</li>
       </ol>
    </div>
</div>
 <!-- .row end -->
@endsection

@section('page-content')
<div class="col-12">
    <div class="card-body border-bottom">
        <div class="row align-items-center">
            {{-- Other Widget --}}
            <div class="col ml-n2">
                <p>Il cliente  {{ $client->first_name.' '.$client->last_name }} ha effettuato {{ count($order) }} prenotazioni in totale</p>
            </div>
            {{-- End of other widget --}}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table myDataTable table-hover align-middle mb-0 card-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>{{ __('ORDER ID') }}</th>
                        <th>Payment Method</th>
                        <th class="text-center">{{ __('Total Amount') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $key => $item)
                        @php
                            if(!empty($order->card_number) && !empty($order->card_exp_month) && !empty($order->card_exp_year))
                            {
                                $method = '<p class="text-center">' . 'Card'. '</p>';
                            }else{
                                $method = '<p class="text-center">' . 'Cash'. '</p>';
                            }    
                        @endphp

                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>
                                @if(!empty($item->card_number) && !empty($item->card_exp_month) && !empty($item->card_exp_year))
                                    <p class="text-center">Card</p>
                                @else
                                    <p class="text-center">Cash</p>
                                @endif
                            </td>
                            <td class="text-center">&euro; {{ number_format($item->amount, 2) }}</td>
                            <td>
                                <a href="{{ route('order.show', $item->id) }}" class="btn btn-link bg-light"><i class="fa fa-eye"></i></a>
                                <a onclick="document.getElementById('status-form-{{ $item->id }}').submit();" title="Delete Reservation" class="btn btn-link bg-dark"><i class="fa fa-trash"></i></a>
                            </td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['order.destroy', $item->id], 'id' => 'status-form-' . $item->id]) !!}
                            {!! Form::close() !!}
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
