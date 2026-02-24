@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
        <div>
            <h1 class="text-6xl font-black text-gray-900 uppercase italic tracking-tighter leading-none">
                Transfer <span class="text-red-600">GP</span>
            </h1>
            <div class="h-1.5 w-32 bg-red-600 mt-3"></div>
            <p class="mt-4 text-gray-400 font-bold uppercase text-xs tracking-[0.3em]">Gestió de Pilots</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('pilot.create') }}" 
               class="group relative inline-flex items-center justify-center px-10 py-4 font-black text-white uppercase italic tracking-widest bg-red-600 transform -skew-x-12 transition-all duration-300 hover:bg-black hover:-translate-y-1 shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <span class="relative z-10 flex items-center skew-x-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 stroke-[4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Nou Pilot
                </span>
                <div class="absolute inset-0 -translate-x-full bg-black transition-transform duration-300 group-hover:translate-x-0"></div>
            </a>

            <button id="editBtn" onclick="editSelected()" 
                class="group relative inline-flex items-center justify-center px-10 py-4 font-black text-white uppercase italic tracking-widest bg-black transform -skew-x-12 transition-all duration-300 hover:-translate-y-1 shadow-[5px_5px_0px_0px_rgba(220,38,38,0.3)] overflow-hidden opacity-30 cursor-not-allowed">   
                
                <div id="editBtnBg" class="absolute inset-0 -translate-x-full bg-red-600 transition-transform duration-300 group-hover:translate-x-0"></div>
                
                <span class="relative z-10 flex items-center skew-x-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 stroke-[3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Editar Pilot
                </span>
            </button>
        </div>
    </div>

    <div class="bg-transparent overflow-x-auto">
        <table class="w-full border-separate border-spacing-y-3" id="pilotsTable">
            <thead>
                <tr class="text-gray-400 uppercase text-xs tracking-widest text-center">
                    <th class="px-6 py-4 font-black w-24">#</th>
                    <th class="px-6 py-4 font-black">Pilot / Cognom</th>
                    <th class="px-6 py-4 font-black">Equip Oficial</th>
                    <th class="px-6 py-4 font-black">Nacionalitat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pilots as $pilot)
                <tr class="pilot-row bg-white transition-all duration-200 group cursor-pointer border-l-8 border-transparent" 
                    onclick="selectPilot({{ $pilot->id }}, this, event)">
                    
                    <td class="px-6 py-6 text-center">
                        <span class="number-badge text-4xl font-black text-gray-200 italic transition-colors duration-300">
                            {{ $pilot->Numero }}
                        </span>
                    </td>
                    
                    <td class="px-6 py-6 text-center">
                        <div class="flex flex-col items-center">
                            <div class="text-xl font-black text-gray-900 uppercase leading-none row-text">{{ $pilot->Nom }}</div>
                            <div class="text-sm font-bold text-gray-400 uppercase tracking-tighter row-subtext">{{ $pilot->Cognom }}</div>
                        </div>
                    </td>

                    <td class="px-6 py-6 text-center">
                        <span class="badge-equip relative z-10 px-4 py-1.5 bg-white border-2 border-black text-[10px] font-black uppercase tracking-[0.15em] text-gray-800 inline-block">
                            {{ $pilot->equip->Nom ?? 'Independent' }}
                        </span>
                    </td>

                    <td class="px-6 py-6 text-center font-black text-gray-500 uppercase italic tracking-tighter row-text">
                        {{ $pilot->Nacionalitat }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Efectos de Hover y Selección en Fila */
    .pilot-row:hover, .is-selected {
        background-color: #000 !important;
        border-left-color: #dc2626 !important;
        transform: scale(1.01) translateX(5px);
        z-index: 10;
    }

    .pilot-row:hover td, .is-selected td { background-color: #000 !important; }
    .pilot-row:hover .row-text, .is-selected .row-text { color: #fff !important; }
    .pilot-row:hover .row-subtext, .is-selected .row-subtext { color: #9ca3af !important; }
    .pilot-row:hover .number-badge, .is-selected .number-badge { color: #dc2626 !important; }
    .pilot-row:hover .badge-equip, .is-selected .badge-equip {
        background-color: #1a1a1a !important;
        border-color: #dc2626 !important;
        color: #fff !important;
    }

    /* Estado Activo del Botón Editar */
    .edit-active {
        opacity: 1 !important;
        cursor: pointer !important;
        box-shadow: 5px 5px 0px 0px rgba(0,0,0,1) !important;
    }

    .edit-active #editBtnBg {
        transform: translateX(0) !important;
    }

    .pilot-row { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
</style>

<script>
let selectedId = null;

function selectPilot(id, row, e) {
    e.stopPropagation();
    const btn = document.getElementById('editBtn');

    if (selectedId === id) {
        deselectAll();
        return;
    }

    selectedId = id;
    document.querySelectorAll('.pilot-row').forEach(tr => tr.classList.remove('is-selected'));
    row.classList.add('is-selected');
    btn.classList.add('edit-active');
}

function deselectAll() {
    selectedId = null;
    document.querySelectorAll('.pilot-row').forEach(tr => tr.classList.remove('is-selected'));
    document.getElementById('editBtn').classList.remove('edit-active');
}

function editSelected() {
    if (selectedId) window.location.href = `/pilot/${selectedId}/edit`;
}

// Deseleccionar al hacer clic fuera
document.addEventListener('click', (e) => {
    if (!e.target.closest('#pilotsTable') && !e.target.closest('#editBtn')) deselectAll();
});
</script>
@endsection