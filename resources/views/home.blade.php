@extends('layouts.admin')
@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Purchase Price', 'Price', 'Profit'],
                @php
                    foreach($chart_data as $d) {
                        echo "['".$d->date->format('d')."', ".$d->purchase_price.", " . $d->price ."," . $d->profit."],";
                    }
                @endphp
            ]);

            var options = {
                title: 'Profit',
                curveType: 'function',
                legend: {position: 'bottom'}
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>

                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4 col-4">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>${{ number_format($total_purchase_price,2) }}</h3>
                                            <p>MTD Purchase Price</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>${{ number_format($total_sale_price,2) }}</h3>
                                            <p>MTD Sale Price</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h3>${{ number_format($total_profit,2) }}</h3>
                                            <p>MTD Profit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div id="curve_chart" style="width: 1100px; height: 600px"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

@endsection
