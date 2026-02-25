@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
        <div>
            <h1 class="text-6xl font-black text-gray-900 uppercase italic tracking-tighter leading-none">
                Transfer <span class="text-red-600">GP</span>
            </h1>
            <div class="h-1.5 w-32 bg-red-600 mt-3"></div>
            <p class="mt-4 text-gray-400 font-bold uppercase text-[10px] tracking-[0.4em]">Gestió de Pilots</p>
        </div>

        <div class="flex gap-4">
            <a href="{{ route('pilot.create') }}" 
               class="inline-flex items-center justify-center px-12 py-6 font-black text-white uppercase italic text-lg tracking-widest bg-red-600 transform -skew-x-12 transition-all duration-300 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[10px_10px_0px_0px_rgba(0,0,0,1)]">
                <span class="flex items-center skew-x-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 stroke-[4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Nou Pilot
                </span>
            </a>

            <button id="editBtn" onclick="editSelected()" 
                class="action-btn inline-flex items-center justify-center px-12 py-6 font-black text-gray-400 uppercase italic text-lg tracking-widest bg-gray-200 transform -skew-x-12 transition-all duration-300 cursor-not-allowed">   
                <span class="skew-x-12"> ✒️​ Editar</span>
            </button>

            <button id="deleteBtn" onclick="deleteSelected()" 
                class="action-btn inline-flex items-center justify-center px-12 py-6 font-black text-gray-400 uppercase italic text-lg tracking-widest bg-gray-200 transform -skew-x-12 transition-all duration-300 cursor-not-allowed">   
                <span class="skew-x-12">  🗑️​ Eliminar <span></span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div id="toast" class="fixed top-5 right-5 z-50 bg-black border-l-4 border-red-600 text-white px-6 py-4 italic font-bold uppercase text-xs tracking-widest shadow-2xl transition-opacity duration-500">
            {{ session('success') }}
        </div>
    @endif

    <form id="deleteForm" method="POST" action="" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <div class="bg-transparent overflow-x-auto">
        <table class="w-full border-separate border-spacing-y-3" id="pilotsTable">
            <thead>
                <tr class="text-gray-400 uppercase text-[10px] tracking-[0.3em] text-center">
                    <th class="px-6 py-2 font-black w-24">#</th>
                    <th class="px-6 py-2 font-black">Pilot</th>
                    <th class="px-6 py-2 font-black">Equip</th>
                    <th class="px-6 py-2 font-black">Nacionalitat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pilots as $pilot)
                <tr class="pilot-row bg-white transition-all duration-200 group cursor-pointer border-l-8 border-transparent" 
                    onclick="selectPilot({{ $pilot->id }}, this, event)">
                    <td class="px-6 py-8 text-center">
                        <span class="number-badge text-5xl font-black text-gray-200 italic transition-colors">{{ $pilot->Numero }}</span>
                    </td>
                    <td class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center">
                            <div class="text-2xl font-black text-gray-900 uppercase leading-none row-text">{{ $pilot->Nom }}</div>
                            <div class="text-[12px] mt-1 font-bold text-gray-400 uppercase tracking-widest row-subtext">{{ $pilot->Cognom }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-8 text-center">
                        <span class="badge-equip relative z-10 px-6 py-2.5 bg-white border-2 border-black text-[11px] font-black uppercase tracking-tighter text-gray-800 inline-block">
                            {{ $pilot->equip->Nom ?? 'Independent' }}
                        </span>
                    </td>
                    <td class="px-6 py-8 text-center font-black text-gray-600 uppercase italic text-lg row-text">
                        {{ $pilot->Nacionalitat }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Efectos hover y seleccionados de las filas de la tabla */
    .pilot-row:hover, .is-selected {
        background-color: #000 !important;
        border-left-color: #dc2626 !important;
        transform: scale(1.015) translateX(8px);
    }
    .pilot-row:hover td, .is-selected td { background-color: #000 !important; }
    .pilot-row:hover .row-text, .is-selected .row-text { color: #fff !important; }
    .pilot-row:hover .row-subtext, .is-selected .row-subtext { color: #9ca3af !important; }
    .pilot-row:hover .number-badge, .is-selected .number-badge { color: #dc2626 !important; }

    /* LÓGICA DE BOTONES ACTIVOS */
    
    /* Botón Editar Activo (Negro) */
    .active-edit {
        background-color: #000 !important;
        color: #fff !important;
        cursor: pointer !important;
    }
    .active-edit:hover {
        transform: translateY(-4px) -skewX(12deg) !important;
    }

    /* Botón Eliminar Activo (Rojo) */
    .active-delete {
        background-color: #dc2626 !important;
        color: #fff !important;
        cursor: pointer !important;
    }
    .active-delete:hover {
        transform: translateY(-4px) -skewX(12deg) !important;
    }

    .pilot-row { transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
</style>

<script>
let selectedId = null;

// Quitar el toast a los 3 segundos
setTimeout(() => {
    const toast = document.getElementById('toast');
    if(toast) toast.style.opacity = '0';
}, 3000);

function selectPilot(id, row, e) {
    e.stopPropagation();
    
    // Si haces clic en el que ya estaba seleccionado, se deselecciona
    if (selectedId === id) { deselectAll(); return; }
    
    selectedId = id;
    
    // Quitar selección a todos y dársela a la fila actual
    document.querySelectorAll('.pilot-row').forEach(tr => tr.classList.remove('is-selected'));
    row.classList.add('is-selected');
    
    // Activar los botones cambiando a sus clases de color
    document.getElementById('editBtn').classList.add('active-edit');
    document.getElementById('deleteBtn').classList.add('active-delete');
}

function deselectAll() {
    selectedId = null;
    
    // Quitar selección a la tabla
    document.querySelectorAll('.pilot-row').forEach(tr => tr.classList.remove('is-selected'));
    
    // Devolver botones a estado gris inactivo
    document.getElementById('editBtn').classList.remove('active-edit');
    document.getElementById('deleteBtn').classList.remove('active-delete');
}

function editSelected() {
    if (selectedId) window.location.href = `/pilot/${selectedId}/edit`;
}

function deleteSelected() {
    if (selectedId && confirm('Confirmes que vols eliminar aquest pilot de la graella?')) {
        const form = document.getElementById('deleteForm');
        form.action = `/pilot/${selectedId}`;
        form.submit();
    }
}

// Clic fuera para deseleccionar
document.addEventListener('click', (e) => {
    if (!e.target.closest('#pilotsTable') && !e.target.closest('.action-btn')) deselectAll();
});
</script>
@endsection