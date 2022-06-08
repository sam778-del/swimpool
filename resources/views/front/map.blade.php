@extends('layouts.layout')

@push('stylesheets')
    
@endpush

@section('content')
<section class="section shadow-md px-5">
  <div class="container">
    <center>
        <h3 style=color:#000099; >
           Lettini liberi per il periodo selezionato:<br><br>
           Mattina: {{ count($data['mattina']) }} Lettini liberi<br>
           Pomeriggio: {{ count($data['pomeriggio']) }} Lettini liberi<br>
           Giornata intera: {{ count($data['giornata']) }} Lettini liberi<br>
        </h3>
        <H1 style=color:#270099; ><img src=./images/logo.png style=width:100px; />&nbsp;&nbsp;SOLARIUM PIANO SUPERIORE</H1>
    </center>
    <form method=post action="{{ url('aggiungiprenotazione1bisdaombrellonecliente') }}">
        @csrf
        <input type=hidden name="arrivo" class="mac" readonly value="{{ $data['arrivo'] }}"  >
         <input type=hidden name="partenza" class="mac" readonly value="{{ $data['partenza'] }}" >
        @php
            $counter = 0;   
        @endphp
        @foreach($data['column'] as $key => $column)
            <table>
                @foreach($data['row'] as $key => $row)
                    @php
                        $counter++;   
                        $sp = \App\Models\Specification::getOuterSpec($counter, $data['data']);     
                    @endphp
                    @if(!empty($sp))
                        @if($sp->type == 'lettino')
                            <td style="">
                                {{-- {{ json_encode($data['data']) }} --}}
                                <div class="featured-box style-4" onclick="setColor({{ $sp->id }})">
                                    <div class="featured-box-icon btn btn-light text-primary round-circle" id="color{{ $sp->id }}"> 
                                        <span id="map{{ $sp->id }}"></span>
                                        <span class="w-100 text-12 font-weight-500">
                                            <img style="background:transparent;" src="images/ico-lettino.png" width="25px" height="25px" title="" onclick="">
                                        </span> 
                                    </div>
                                </div>
                            </td>
                            @elseif($sp->type == 'ombrellone')

                            @elseif($sp->type == '-')
                                <td style="background-color: #f1f1f1">
                                    <div class="featured-box style-4">
                                        <div class="featured-box-icon" style="background-color: transaprent;"> 
                                        </div>
                                    </div>
                                </td>
                            @elseif($sp->type == '-1')
                                <td>
                                    <div class="featured-box style-4 shadow-md">
                                        <div class="featured-box-icon btn btn-light text-primary rounded-square" style="background-color: transparent;"> 
                                        </div>
                                    </div>
                                </td>
                            @elseif($sp->type == 'gazebo')
                                <td style="">
                                    {{-- {{ json_encode($data['data']) }} --}}
                                    <div class="featured-box style-4" onclick="setGazeboColor({{ $sp->id }})">
                                        <div class="featured-box-icon btn btn-success text-primary round-circle" id="color{{ $sp->id }}"> 
                                            <span id="map{{ $sp->id }}"></span>
                                            <span class="w-100 text-12 font-weight-500">
                                                <img style="background:transparent;" src="images/ico-lettino.png" width="25px" height="25px" title="" onclick="">
                                            </span> 
                                        </div>
                                    </div>
                                </td>
                        @else
                            <td style="background-color: brown">
                                <div class="featured-box style-4">
                                    <div class="featured-box-icon" style="background-color: brown;"> 
                                    </div>
                                </div>
                            </td>
                        @endif
                    @else
                        <td>
                            <div class="featured-box style-4">
                                <div class="featured-box-icon btn btn-light text-primary rounded-circle" style="background-color: red"> 
                                    <span class="w-100 text-12 font-weight-500">
                                        <img style="background:transparent;" src="images/ico-lettino.png" width="25px" height="25px" title="" onclick="">
                                    </span> 
                                </div>
                            </div>
                        </td>
                    @endif
                @endforeach
            </table>
        @endforeach
        <input type=hidden name="price_type" value="{{ $data['giorbata'] }}" />
        <div class="text-center pt-4"> <button type="submit" class="btn btn-primary">PRENOTA</button> </div>
    </form>
  </div>
</section>
<!-- Refer & Earn end --> 
@endsection

@push('scripts')
    <script>
        function setColor(e) {
            if($('#color'+e).hasClass('btn-light')){
                $('#map'+e).html('<input type="hidden" name="map_id[]" value=" ' + e +' "/>');
                $('#color'+e).removeClass('btn-light');
                $('#color'+e).addClass('btn-danger');
            }else{
                $('#map'+e).remove();
                $('#color'+e).removeClass('btn-danger');
                $('#color'+e).addClass('btn-light');
            }
        }

        function setGazeboColor(e) {
            if($('#color'+e).hasClass('btn-success')){
                $('#map'+e).html('<input type="hidden" name="map_id[]" value=" ' + e +' "/>');
                $('#color'+e).removeClass('btn-success');
                $('#color'+e).addClass('btn-danger');
            }else{
                $('#map'+e).remove();
                $('#color'+e).removeClass('btn-danger');
                $('#color'+e).addClass('btn-success');
            }
        }
    </script>
@endpush