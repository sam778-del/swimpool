@extends('layouts.layout')

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    td {
        border-collapse: separate;
        border-spacing: 10px;
    }

    /* @media (min-width: 768px) {
        div.container {
            overflow:hidden;
            overflow-x: scroll;
            display:block;
            height:auto;
            width: 100%;
        }

        table, td{
            width:100%;
            table-layout: fixed;
            overflow-wrap: break-word;
        }
    } */
    
</style>
@endpush

@section('content')
<section class="section shadow-md px-5">
  <div class="card">
    <div class="card-header">
        <h3>
            @if($data['type'] == 'tennis')
                Tennis
            @elseif($data['type'] == 'soccer1')
                Soccer camp 1 
            @else 
                Soccer camp 2
            @endif
            - {{ date('d/m/Y', strtotime($data['arrivo'])) }}
            <span id="add"></span>
        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('stripe.payment') }}" method="POST">
            @csrf
            <div class="row">
                <input type="hidden" id="itemID" name="item_id" />
                <input type="hidden" name="arrivo" value="{{ $data['arrivo'] }}" />
                <input type="hidden" name="day" value="{{ $data['giorbata'] }}" />
                @foreach ($data['map'] as $item)
                    <div class="{{ $data['type'] == 'tennis' ? 'col-md-6' : 'col-md-6'}}">
                        <button  data-id="{{ $item->duration }}" data-val="{{ $item->id }}" class="btn btn-outline-primary btn-block my-4 myDiv" type="button">{{ $item->duration }}</button>
                    </div>
                @endforeach
                @if(!empty($data['booked']))
                    @foreach ($data['booked'] as $item)
                        <div class="{{ $data['type'] == 'tennis' ? 'col-md-6' : 'col-md-6'}}">
                            <button  data-id="{{ $item->duration }}" data-val="{{ $item->id }}" class="btn btn-danger btn-block my-4" type="button">{{ $item->duration }}</button>
                        </div>
                    @endforeach
                @endif
                @if($data['type'] == 'tennis')
                    <div class="col-md-6">
                        <label class='control-label'>No Of Player</label>
                        <select class="form-control" name="player" required>
                            <option value="2">2</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ url('/') }}">Change Date</a>
                </div>
                <div class="col-md-6">
                    <button id="submit" class="btn btn-primary">Proceed</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</section>
<!-- Refer & Earn end -->
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.myDiv').click(function() { // when a .myDiv is clicked
                $('.myDiv').not(this).removeClass('btn-danger')
                $(this).toggleClass('btn-danger')
                $('#add').html($(this).attr('data-id'));
                $('#itemID').val($(this).attr('data-val'));
            })
        });
    </script>
@endpush
