@extends('caisse.layout')
<?php $solde_total = 0 ?>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2 class="text-center">Les transactions de la caisse</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-primary mb-4" href="{{ route('caisse.create') }}"> Ajouter une transacrtion</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>DATE</th>
            <th>LIBELLE</th>
            <th>RECETTES</th>
            <th>DEPENSES</th>
            <th>SOLDE</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><?php
                $timestamp = strtotime($product->date);  
                print date('d/m/Y', $timestamp );
            ?></td>
            
            <td >{{ $product->libelle }}</td>
            <td class="text-success fw-bold">{{ $product->recettes }}</td>
            <td class="text-success fw-bold">{{ $product->depenses }}</td>
            <td class="text-success fw-bold">{{ $product->solde }}</td>

            <td>
                <form action="{{ route('caisse.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('caisse.edit',$product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
     <?php $solde_total += $product->solde ?>
        @endforeach

    </table>

    <h1>Total des solde : {{ $solde_total }}</h1>
@endsection