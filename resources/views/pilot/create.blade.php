@extends('layouts.app')

@section('content')
<h1>Afegir Nou Pilot</h1>

<form action="{{ route('pilot.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Nom:</label>
        <input type="text" name="Nom" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Cognom:</label>
        <input type="text" name="Cognom" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Nacionalitat:</label>
        <input type="text" name="Nacionalitat" class="form-control">
    </div>

    <div class="form-group">
        <label>Data de Naixement:</label>
        <input type="date" name="Data_neixament" class="form-control">
    </div>

    <div class="form-group">
        <label>Dorsal (#):</label>
        <input type="number" name="Numero" class="form-control" required>
    </div>

    <div class="form-group">
        <label>URL de la Foto:</label>
        <input type="url" name="Foto_url" class="form-control">
    </div>

    <div class="form-group">
        <label>Mundials Guanyats:</label>
        <input type="number" name="Mundials_guanyats" class="form-control" value="0">
    </div>

    <div class="form-group">
        <label>Equip Actual:</label>
        <select name="ID_Equip" class="form-control" required>
            <option value="">Selecciona un equip...</option>
            @foreach($equips as $equip)
                <option value="{{ $equip->id }}">{{ $equip->Nom }}</option>
            @endforeach
        </select>
    </div>

   <div class="form-group">
    <label for="Estat_actiu">Estat del Pilot:</label>
    <select name="Estat_actiu" id="Estat_actiu" class="form-control" required>
        <option value="1" {{ old('Estat_actiu') == '1' ? 'selected' : '' }}>Actiu</option>
        <option value="0" {{ old('Estat_actiu') == '0' ? 'selected' : '' }}>Inactiu</option>
    </select>
   </div>

    <button type="submit" class="btn btn-primary">Guardar Pilot</button>
</form>
@endsection