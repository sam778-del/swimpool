@extends('layouts.app')

@section('page-title', __('Edit Map') )

@section('page-toolbar')
<div class="row mb-3 align-items-center">
    <div class="col">
       <ol class="breadcrumb bg-transparent mb-0">
          <li class="breadcrumb-item"><a class="text-secondary" href="{{ url("/home") }}">{{ __('Dashboard') }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ __('Edit Map') }}</li>
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
    <div class="card" style="background-color: #FFCC33; opacity: 0.8">
        <div class="card-body">
            <table id="table_list" style="width: 50%" class="table align-middle mb-0 card-table" cellspacing="0">
                <thead>
                    @php
                        $counter = 0;   
                    @endphp
                    @foreach($data['column'] as $key => $column)
                        <tr>
                            @foreach($data['row'] as $key => $row)
                                @php
                                    $counter++;   
                                    $sp = \App\Models\Specification::getSpec($counter);     
                                @endphp
                                
                                @if($sp->type == 'lettino')
                                    <td style="background:blue;">
                                        {!! Form::open(["route" => ["table-map.update", $sp->id], "method" => "PATCH"]) !!}
                                            <input  type=text style="background:blue;" name="nome" value="{{ $sp->spec_id }}" size=1 />
                                            <input type="hidden" name="item_id" value="{{ $sp->id }}"/>
                                            <select name="type"  type=text style="background:blue;" >
                                                <option value=lettino >L</option>
                                                <option value=ombrellone >O</option>
                                                <option value=-1 >-</option>
                                                <option value=gazebo >G</option>
                                                <option value=passerella >P</option>
                                                <option value="beach">B</option>
                                            </select>
                                            <input type=image src="{{ asset('images/ok.png') }}" />
                                        {!! Form::close() !!}
                                    </td>
                                @elseif($sp->type == 'ombrellone')
                                    <td style="background:#009966;">
                                        {!! Form::open(["route" => ["table-map.update", $sp->id], "method" => "PATCH"]) !!}
                                            <input  type=text style="background:#009966;" name="nome" value="{{ $sp->spec_id }}" size=1 />
                                            <input type="hidden" name="item_id" value="{{ $sp->id }}"/>
                                            <select name="type"  type=text style="background:#009966;" >
                                                <option value=lettino >L</option>
                                                <option value=ombrellone >O</option>
                                                <option value=-1 >-</option>
                                                <option value=gazebo >G</option>
                                                <option value=passerella >P</option>
                                                <option value="beach">B</option>
                                            </select>
                                            <input type=image src="{{ asset('images/ok.png') }}" />
                                        {!! Form::close() !!}
                                    </td>
                                @elseif($sp->type == '-1' || $sp->type == '-' || $sp->type == 'beach')
                                    <td style="background:#FFCC33;opacity:0.5">
                                        {!! Form::open(["route" => ["table-map.update", $sp->id], "method" => "PATCH"]) !!}
                                            <input  type=text style="background:#FFCC33;" name="nome" value="{{ $sp->spec_id }}" size=1 />
                                            <input type="hidden" name="item_id" value="{{ $sp->id }}"/>
                                            <select name="type"  type=text style="background:#FFCC33;" >
                                                <option value=lettino >L</option>
                                                <option value=ombrellone >O</option>
                                                <option value=-1 >-</option>
                                                <option value=gazebo >G</option>
                                                <option value=passerella >P</option>
                                                <option value="beach">B</option>
                                            </select>
                                            <input type=image src="{{ asset('images/ok.png') }}" />
                                        {!! Form::close() !!}
                                    </td>
                                @elseif($sp->type == 'gazebo')
                                    <td style="background:gray;">
                                        {!! Form::open(["route" => ["table-map.update", $sp->id], "method" => "PATCH"]) !!}
                                            <input  type=text style="background:gray;" name="nome" value="{{ $sp->spec_id }}" size=1 />
                                            <input type="hidden" name="item_id" value="{{ $sp->id }}"/>
                                            <select name="type"  type=text style="background:gray;" >
                                                <option value=lettino >L</option>
                                                <option value=ombrellone >O</option>
                                                <option value=-1 >-</option>
                                                <option value=gazebo >G</option>
                                                <option value=passerella >P</option>
                                                <option value="beach">B</option>
                                            </select>
                                            <input type=image src="{{ asset('images/ok.png') }}" />
                                        {!! Form::close() !!}
                                    </td>
                                @else
                                    <td style="background:brown;">
                                        {!! Form::open(["route" => ["table-map.update", $sp->id], "method" => "PATCH"]) !!}
                                            <input  type=text style="background:brown;" name="nome" value="{{ $sp->spec_id }}" size=1 />
                                            <input type="hidden" name="item_id" value="{{ $sp->id }}"/>
                                            <select name="type"  type=text style="background:brown;" >
                                                <option value=lettino >L</option>
                                                <option value=ombrellone >O</option>
                                                <option value=-1 >-</option>
                                                <option value=gazebo >G</option>
                                                <option value=passerella >P</option>
                                                <option value="beach">B</option>
                                            </select>
                                            <input type=image src="{{ asset('images/ok.png') }}" />
                                        {!! Form::close() !!}
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

