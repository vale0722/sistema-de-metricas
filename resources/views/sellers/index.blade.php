@extends('layouts.app')
@section('content')

    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    VENDEDORES
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
                    <th scope="col">Nombre</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sellers as $seller)
                    <tr>
                        <th scope="row">{{$seller->id}}</th>
                        <td>{{$seller->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="flex justify-content-center">
        {{ $sellers->links() }}
    </div>
@endsection
