@extends('layouts.app')

@section('page-title', __('Dashboard') )

@section('page-content')
<div class="container-fluid">
    <div class="row row-cols-xxl-5 row-cols-xxl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3 mb-3 row-deck">
        <div class="col">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-dollar fa-lg"></i></div>
                    <div class="flex-fill ms-3 text-truncate">
                        <div class="small text-uppercase">Today Order</div>
                        <div><span class="h6 mb-0 fw-bold">&euro; {{ number_format($data['todayOrder'], 2) }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-dollar fa-lg"></i></div>
                    <div class="flex-fill ms-3 text-truncate">
                        <div class="small text-uppercase">This Month Order</div>
                        <div><span class="h6 mb-0 fw-bold">&euro; {{ number_format($data['monthOrder'], 2) }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-dollar fa-lg"></i></div>
                    <div class="flex-fill ms-3 text-truncate">
                        <div class="small text-uppercase">Total Order Amount</div>
                        <div><span class="h6 mb-0 fw-bold">&euro; {{ number_format($data['yearOrder'], 2) }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-address-book fa-lg"></i></div>
                    <div class="flex-fill ms-3 text-truncate">
                        <div class="small text-uppercase">Totale Cliente</div>
                        <div><span class="h6 mb-0 fw-bold">{{ $data['totalCustomer'] }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-user-plus fa-lg"></i></div>
                    <div class="flex-fill ms-3 text-truncate">
                        <div class="small text-uppercase">Totale Operator</div>
                        <div><span class="h6 mb-0 fw-bold">{{ count($data['totalOperator']) }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="analytics"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('bundles/apexcharts.bundle.js') }}"></script>
<script>
        var analytics = {
        series: [
            {
                name: 'Total',
                data: {!! json_encode($data['getOrderChart']['data']) !!}
            }
        ],
        colors: ['var(--chart-color1)'],
        chart: {
            type: 'bar',
            height: 480,
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '35%',
                //endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 1,
            colors: ['transparent']
        },
        xaxis: {
            categories: {!! json_encode($data['getOrderChart']['label']) !!},
        },
        legend: {
            position: 'bottom', // left, right, top, bottom
            horizontalAlign: 'left',  // left, right, top, bottom
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                return "&euro; " + val
                }
            }
        },
    };
    new ApexCharts(document.querySelector("#analytics"), analytics).render();
</script>
@endpush
