@extends('layouts.app')
@section('content')

    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    FACTURAS
                </h1>
            </div>
        </div>
    </section>
    <div class="card">
        <div class="card-content">
            <table class="table is-hoverable is-fullwidth">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Vendedor</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                    <th scope="row">{{$invoice->id}}</th>
                        <td>
                        @switch($invoice->status)
                            @case(\App\Constants\Statuses::PAID)
                                <span class="tag is-success">
                            @break
                            @case(\App\Constants\Statuses::OVERDUE)
                                <span class="tag is-danger">
                            @break
                            @default
                                <span class="tag is-info">
                        @endswitch
                            {{$invoice->status}}</span>
                        </td>
                        <td>{{$invoice->seller->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="flex justify-content-center">
        {{ $invoices->links() }}
    </div>
@endsection
