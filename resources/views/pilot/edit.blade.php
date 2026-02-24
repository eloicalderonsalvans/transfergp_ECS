@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="mb-8">
        <h1 class="text-5xl font-black text-gray-900 uppercase italic tracking-tighter">
            Transfer <span class="text-red-600">GP</span>
        </h1>
        <div class="h-2 w-24 bg-red-600 mt-2"></div>
        <p class="mt-4 text-gray-500 font-bold uppercase text-xs tracking-widest">Editar Pilot</p>
    </div>

    <div class="bg-white overflow-hidden shadow-[20px_20px_0px_0px_rgba(229,231,235,0.5)] border-2 border-black p-8">
        <form action="{{ route('pilot.update', $pilot->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">Nom:</label>
                    <input type="text" name="Nom" value="{{ old('Nom', $pilot->Nom) }}" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none @error('Nom') border-red-600 @enderror" required>
                    @error('Nom') <span class="text-red-600 text-sm font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">Cognom:</label>
                    <input type="text" name="Cognom" value="{{ old('Cognom', $pilot->Cognom) }}" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none @error('Cognom') border-red-600 @enderror" required>
                    @error('Cognom') <span class="text-red-600 text-sm font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">Nacionalitat:</label>
                    <input type="text" name="Nacionalitat" value="{{ old('Nacionalitat', $pilot->Nacionalitat) }}" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">Data de Naixement:</label>
                    <input type="date" name="Data_neixament" value="{{ old('Data_neixament', $pilot->Data_neixament) }}" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">Dorsal (#):</label>
                    <input type="number" name="Numero" value="{{ old('Numero', $pilot->Numero) }}" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none @error('Numero') border-red-600 @enderror" required>
                    @error('Numero') <span class="text-red-600 text-sm font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">Mundials Guanyats:</label>
                    <input type="number" name="Mundials_guanyats" value="{{ old('Mundials_guanyats', $pilot->Mundials_guanyats) }}" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">URL de la Foto:</label>
                    <input type="url" name="Foto_url" value="{{ old('Foto_url', $pilot->Foto_url) }}" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">Equip Actual:</label>
                    <select name="ID_Equip" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none @error('ID_Equip') border-red-600 @enderror" required>
                        <option value="">Selecciona un equip...</option>
                        @foreach($equips as $equip)
                            <option value="{{ $equip->id }}" {{ old('ID_Equip', $pilot->ID_Equip) == $equip->id ? 'selected' : '' }}>{{ $equip->Nom }}</option>
                        @endforeach
                    </select>
                    @error('ID_Equip') <span class="text-red-600 text-sm font-bold">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-black uppercase text-gray-900 mb-2">Estat del Pilot:</label>
                    <select name="Estat_actiu" class="w-full px-4 py-3 border-2 border-gray-300 focus:border-red-600 focus:outline-none" required>
                        <option value="1" {{ old('Estat_actiu', $pilot->Estat_actiu) == 1 ? 'selected' : '' }}>Actiu</option>
                        <option value="0" {{ old('Estat_actiu', $pilot->Estat_actiu) == 0 ? 'selected' : '' }}>Inactiu</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-4 pt-6">
                <button type="submit" class="px-8 py-4 bg-red-600 text-white font-black uppercase italic tracking-widest hover:bg-black transition-all transform hover:-skew-x-12">
                    Guardar Canvis
                </button>
                <a href="{{ route('pilot.index') }}" class="px-8 py-4 bg-gray-300 text-gray-900 font-black uppercase italic tracking-widest hover:bg-gray-400 transition-all">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection