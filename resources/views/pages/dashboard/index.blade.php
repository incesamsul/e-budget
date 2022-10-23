@extends('layouts.v_template')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">

    <div class="small-box bg-info">
    <div class="inner">
    <h3>0</h3>
    <p>Antrian</p>
    </div>
    <div class="icon">
    <i class="ion ion-bag"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-3 col-6">

    <div class="small-box bg-success">
    <div class="inner">
    <h3>5<sup style="font-size: 20px">%</sup></h3>
    <p>Proses</p>
    </div>
    <div class="icon">
    <i class="ion ion-stats-bars"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
    <div class="inner">
    <h3>44</h3>
    <p>Diterima</p>
    </div>
    <div class="icon">
    <i class="ion ion-person-add"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    <div class="col-lg-3 col-6">

    <div class="small-box bg-danger">
    <div class="inner">
    <h3>65</h3>
    <p>Ditolak</p>
    </div>
    <div class="icon">
    <i class="ion ion-pie-graph"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
    </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Chart data pengajuan
                </div>
                <div class="card-body">
                    <canvas id="myChart2" width="1700" height="700"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Chart pengajuan
                </div>
                <div class="card-body">
                    <canvas id="myChart3" width="1700" height="700"></canvas>
                    <canvas id="chart7hariterakhir" width="1700" height="700"></canvas>
                </div>
            </div>
        </div>
    </div>



    <?php
    $label = [];
    ?>
    @foreach (getAllPengajuan() as $row)
        <?php

        $label[] = json_encode($row->created_at);

        ?>
    @endforeach





@endsection

@section('script')
<script>

var ctx = document.getElementById('myChart2');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: ['antri','acc bendahara','accc ketua','dcc bendahara','dcc ketua'],
    datasets: [
        {
        label: 'Jumlah data',
        data: [
            '{{ count(getJumlahPerStatus('0')) }}',
            '{{ count(getJumlahPerStatus('1')) }}',
            '{{ count(getJumlahPerStatus('2')) }}',
            '{{ count(getJumlahPerStatus('3')) }}',
            '{{ count(getJumlahPerStatus('4')) }}'
        ],
        fill: false,
        borderColor: '#34c',
        backgroundColor: '#aae0a8',
        }
    ]
    },
    options: {
        responsive: true,
        scales: {
        x: {
            display: true,
            title: {
            display: true,
            text: 'Month',
            color: '#911',
            font: {
                family: 'Comic Sans MS',
                size: 20,
                weight: 'bold',
                lineHeight: 1.2,
            },
            padding: {top: 20, left: 0, right: 0, bottom: 0}
            }
        },
        y: {
            display: true,
            title: {
            display: true,
            text: 'Value',
            color: '#191',
            font: {
                family: 'Times',
                size: 20,
                style: 'normal',
                lineHeight: 1.2
            },
            padding: {top: 30, left: 0, right: 0, bottom: 0}
            }
        }
        }
    },
    });

var ctx = document.getElementById('myChart3');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: ['30,12,2022'],
    datasets: [
        {
        label: 'Jumlah data',
        data: [
            100
        ],
        fill: false,
        borderColor: '#34c',
        backgroundColor: '#aae0a8',
        }
    ]
    },
    options: {
        responsive: true,
        scales: {
        x: {
            display: true,
            title: {
            display: true,
            text: 'Month',
            color: '#911',
            font: {
                family: 'Comic Sans MS',
                size: 20,
                weight: 'bold',
                lineHeight: 1.2,
            },
            padding: {top: 20, left: 0, right: 0, bottom: 0}
            }
        },
        y: {
            display: true,
            title: {
            display: true,
            text: 'Value',
            color: '#191',
            font: {
                family: 'Times',
                size: 20,
                style: 'normal',
                lineHeight: 1.2
            },
            padding: {top: 30, left: 0, right: 0, bottom: 0}
            }
        }
        }
    },

    });



    var date = new Date();

            let hari1YangLalu = date.setDate(date.getDate() - 1);
            let hari2YangLalu = date.setDate(date.getDate() - 1);
            let hari3YangLalu = date.setDate(date.getDate() - 1);
            let hari4YangLalu = date.setDate(date.getDate() - 1);
            let hari5YangLalu = date.setDate(date.getDate() - 1);
            let hari6YangLalu = date.setDate(date.getDate() - 1);
            let hari7YangLalu = date.setDate(date.getDate() - 1);
            const datapengajuan = {
            labels: [new Date(hari7YangLalu).toISOString().slice(0, 10),new Date(hari6YangLalu).toISOString().slice(0, 10),new Date(hari5YangLalu).toISOString().slice(0, 10),new Date(hari4YangLalu).toISOString().slice(0, 10),new Date(hari3YangLalu).toISOString().slice(0, 10),new Date(hari2YangLalu).toISOString().slice(0, 10),new Date(hari1YangLalu).toISOString().slice(0, 10), new Date().toISOString().slice(0, 10) ],
            datasets: [
            {
            label: 'jumlah pengajuan masuk perhari',
            data: [{{ $pengajuan7HariYangLalu }}, {{ $pengajuan6HariYangLalu }}, {{ $pengajuan5HariYangLalu }}, {{ $pengajuan4HariYangLalu }}, {{ $pengajuan3HariYangLalu }}, {{ $pengajuan2HariYangLalu }}, {{ $pengajuan1HariYangLalu }}, {{ $pengajuanHariIni }}],
            fill: false,
            borderColor: '#44c',
            backgroundColor: '#2C56E1',
            }
            ]
            };
            var ctx = document.getElementById('chart7hariterakhir');
            var myChart = new Chart(ctx, {
            type: 'line',
            data: datapengajuan,
            options: {
            responsive: true,
            scales: {
            x: {
                display: true,
                title: {
                display: true,
                // text: 'Month',
                color: '#911',
                font: {
                    family: 'Comic Sans MS',
                    size: 20,
                    weight: 'bold',
                    lineHeight: 1.2,
                },
                padding: {top: 20, left: 0, right: 0, bottom: 0}
                }
            },
            y: {
                display: true,
                title: {
                display: true,
                text: 'Value',
                color: '#191',
                font: {
                    family: 'Times',
                    size: 20,
                    style: 'normal',
                    lineHeight: 1.2
                },
                padding: {top: 30, left: 0, right: 0, bottom: 0}
                }
            }
            }
            },
            });





    $('#liDashboard').addClass('active');

</script>
@endsection
