@extends('caisse.layout')

@section('content')

<div class="row">
    <h1 class="text-center mb-4 text-success">Ajouter une transaction</h1>
    <form class="d-flex flex-column align-items-center justify-content-center was-validated" action="{{ route('caisse.store') }}" method="POST">
        @if($errors->any())
        <div class="alert alert-danger col-8">
            <strong>Whoops!!</strong> There were some problems in your input.<br/>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        @csrf
            <div class="mb-3 col-lg-4 col-md-6 col-8">
                <label for="exampleFormControlInput1 " class="ms-2 form-label fw-bold">Libelle</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre libelle..." name="libelle" required>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="mb-3 col-lg-4 col-md-6 col-8">
                <label for="exampleFormControlInput1" class="ms-2 form-label fw-bold">Date de transacrtion</label>
                <input type="date" class="form-control" id="exampleFormControlInput1" name="date" required>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="mb-3 col-lg-4 col-md-6 col-8">
                <label for="exampleFormControlInput1" class="ms-2 form-label fw-bold">Entrée caisse</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre entrée caisse..." name="recettes" required>
                <div class="invalid-feedback">Please fill out this field.</div>
           </div>
           <div class="mb-3 col-lg-4 col-md-6 col-8">
                <label for="exampleFormControlInput1" class="ms-2 form-label fw-bold">Sortie caisse</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre sortie caisse..." name="depenses" required>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="mb-3 col-lg-4 col-md-6 col-8">
                <label for="exampleFormControlInput1" class="ms-2 form-label fw-bold">Solde</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Votre solde..." name="solde" required>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="mb-3 col-lg-4 col-md-6 col-8 text-center">
                <button type="submit" class="btn btn-outline-success">Ajouter</button>
            </div>

    </form>
</div>
@endsection
