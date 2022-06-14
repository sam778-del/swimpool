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
  <div class="container">

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
