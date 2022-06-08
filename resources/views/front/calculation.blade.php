@extends('layouts.layout')

<?php $final_amount = 0 ?>

@section('content')
<section class="page-header page-header-text-light bg-secondary">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-8">
            <h1>Conferma i dettagli di pagamento</h1>
         </div>
      </div>
   </div>
</section>
<!-- Page Header end -->
<div id="content">
    <form action="{{ route('stripe.payment') }}" method="POST">
        @csrf
        <input type="hidden" name="accesory_id" value="{{ implode(",",$data['accesory_id']) }}">
        <input type="hidden" name="numerodipersone" value="{{ $data['numerodipersone'] }}">
        <input type="hidden" name="price_type" value="{{ $data['price_type'] }}">
        <input type="hidden" name="map_id" value="{{ json_encode($data['map_id']) }}">
        <input type="hidden" name="from" value="{{ $data['start_date'] }}">
        <input type="hidden" name="to" value="{{ $data['end_date'] }}">
        <section class="container">
            @php
            $total_price = 0;
            $begin = new \DateTime( date('Y-m-d', strtotime($data['start_date']) ));
            $end = new DateTime( date('Y-m-d', strtotime($data['end_date'])) );
            $end = $end->modify( '+1 day' );
            $interval = new \DateInterval('P1D');
            $daterange = new \DatePeriod($begin, $interval ,$end);
            @endphp
            @foreach($daterange as $date)
            @php
                $ConverDate = date("l", strtotime($date->format('Y-m-d')));
                $ConverDateTomatch = strtolower($ConverDate);
                if(($ConverDateTomatch == "saturday" )|| ($ConverDateTomatch == "sunday")){
                $weekend = true;
                } else {
                $weekend = false;
                }
            @endphp
            <?php
                $total_amount = 0;
                ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-white shadow-md rounded p-3 p-sm-4 confirm-details">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center trip-title">
                                <div class="col-6 col-sm col-md-auto text-3 date">{!! \App\Models\Specification::getDay($date->format('d.m.Y'), $data['price_type'], $ConverDate) !!}</div>
                            </div>
                        </div>
                        @foreach ($data['map'] as $key => $item)
                        @php
                        $accessory = \App\Models\Accesory::find($data['accesory_id'][$key]);
                        if($accessory)
                        {
                        $accessoryAmount = $accessory->amount;
                        }else{
                        $accessoryAmount = 0;
                        }
                        $price = \App\Models\Specification::getPrice($item->type, $date->format('Y-m-d'), $data['price_type']);
                        $final_amount += $price + $accessoryAmount;
                        @endphp
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-sm-center flex-row">
                                <div class="col-12 col-sm-3 mb-3 mb-sm-0"> 
                                    <span class="text-3 text-dark operator-name"><img src="{{ asset('images/ico-lettino.png') }}" style=width:30px; /> {{ $item->type }} {{ $item->spec_id }} {{ !empty($accessory->name) ? 'Con '.$accessory->name  : '' }}</span> 
                                    <span class="text-muted d-block">&euro; {{ $price + $accessoryAmount }}</span> 
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-lg-12">
                    <div class="bg-white shadow-md rounded p-3 p-sm-4 confirm-details">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-dark bg-light-4 text-4 font-weight-600 p-3"> Total Amount <span class="float-right text-6">&euro;{{ $final_amount }}</span> </div>
                        </div>
                        <input type="hidden" name="final_amount" value="{{ $final_amount }}">
                        <div class="card-footer">
                            @if($final_amount > 0.0)
                                <button class="btn btn-primary btn-block"  type="submit">Procedere al pagamento</button>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>
<!-- Content end -->
@endsection