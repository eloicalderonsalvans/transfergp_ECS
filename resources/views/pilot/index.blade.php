@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <h1 class="text-5xl font-black text-gray-900 uppercase italic tracking-tighter">
                Transfer <span class="text-red-600">GP</span>
            </h1>
            <div class="h-2 w-24 bg-red-600 mt-2"></div>
            <p class="mt-4 text-gray-500 font-bold uppercase text-xs tracking-widest">Llistat de Pilots</p>
        </div>

        <a href="{{ route('pilot.create') }}" 
           class="group relative inline-flex items-center justify-center px-8 py-4 font-black text-white uppercase italic tracking-widest bg-red-600 transition-all duration-300 hover:bg-black overflow-hidden shadow-[8px_8px_0px_0px_rgba(0,0,0,0.2)] hover:shadow-none active:translate-x-1 active:translate-y-1">
            <span class="relative z-10 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 stroke-[3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Nou Pilot
            </span>
            <div class="absolute inset-0 -translate-x-full bg-black transition-transform duration-300 group-hover:translate-x-0"></div>
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-[20px_20px_0px_0px_rgba(229,231,235,0.5)] border-2 border-black">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="bg-black text-white">
                    <th class="px-6 py-5 text-sm font-black uppercase italic tracking-wider text-red-600">#</th>
                    <th class="px-6 py-5 text-sm font-black uppercase italic tracking-wider">Pilot</th>
                    <th class="px-6 py-5 text-sm font-black uppercase italic tracking-wider">Equip Oficial</th>
                    <th class="px-6 py-5 text-sm font-black uppercase italic tracking-wider">Nacionalitat</th>
                    <th class="px-6 py-5 text-sm font-black uppercase italic tracking-wider text-right">Gestió</th>
                </tr>
            </thead>
            <tbody class="divide-y-2 divide-gray-100">
                @foreach($pilots as $pilot)
                <tr class="hover:bg-red-50 transition-colors group">
                    <td class="px-6 py-6">
                        <span class="text-3xl font-black text-gray-800 italic group-hover:text-red-600 transition-colors">
                            {{ $pilot->Numero }}
                        </span>
                    </td>
                    
                    <td class="px-6 py-6">
                        <div class="flex items-center">
                            <div class="h-10 w-1 bg-red-600 mr-4"></div>
                            <div>
                                <div class="text-lg font-black text-gray-900 uppercase leading-none">{{ $pilot->Nom }}</div>
                                <div class="text-sm font-bold text-gray-400 uppercase tracking-tighter">{{ $pilot->Cognom }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-6">
                        <span class="px-3 py-1 bg-gray-100 text-xs font-black uppercase tracking-widest text-gray-700 border border-gray-300">
                            {{ $pilot->equip->Nom ?? 'Independent' }}
                        </span>
                    </td>

                    <td class="px-6 py-6 font-bold text-gray-600 uppercase italic">
                        {{ $pilot->Nacionalitat }}
                    </td>

                    <td class="px-6 py-6 text-right">
                        <a href="{{ route('pilot.edit', $pilot->id) }}" 
                           class="inline-block px-5 py-2 bg-black text-white text-xs font-black uppercase italic hover:bg-red-600 transition-all transform hover:-skew-x-12">
                            Editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection