@extends('layouts.app')
@section('content')

    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    MÉTRICAS
                </h1>
            </div>
        </div>
    </section>
    <invoice-metric inline-template>
        <div>
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="invoiceBar" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="invoicePie" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="invoiceLine" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </invoice-metric>
@endsection
