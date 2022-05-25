@extends('caisse.layout')
<?php $solde_total = 0 ?>
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h1 class="text-center">Les transactions de la caisse</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-primary mb-4" href="{{ route('caisse.create') }}"> Ajouter une transacrtion</a>
            </div>
        </div>
    </div>
  
    <div class="my-2">
        <form action="{{ url('filter') }}" method="GET">
            <div class="input-group mb-3">
                <input type="date" class="form-control" name="start_date" value="<?php $timestamp = strtotime($caisse['start_date']);print date('Y-m-d', $timestamp );?>">
                <input type="date" class="form-control" name="end_date" value="<?php $timestamp = strtotime($caisse['end_date']);print date('Y-m-d', $timestamp );?>">
                <button class="btn btn-outline-secondary" type="submit">filtrer</button>
            </div>
        </form>
    </div>

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
        @foreach ($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td><?php
                $timestamp = strtotime($transaction->date);  
                print date('d/m/Y', $timestamp );
            ?></td>
            
            <td >{{ $transaction->libelle }}</td>
            <td class="text-success fw-bold">{{ $transaction->recettes }}</td>
            <td class="text-success fw-bold">{{ $transaction->depenses }}</td>
            <td class="text-success fw-bold">{{ $transaction->solde }}</td>

            <td>
                <form action="{{ route('caisse.destroy',$transaction->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('caisse.edit',$transaction->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
     <?php $solde_total += $transaction->solde ?>
        @endforeach

    </table>

    <h3>Total des solde : {{ $solde_total }}</h3>
    
@endsection