@if ($paginator->hasPages())
    <div class="w-full flex justify-between items-center mt-10 px-2 gap-4">
        
        <!-- Tombol Prev -->
        @if ($paginator->onFirstPage())
            <div class="p-3 bg-slate-200 text-slate-400 rounded-xl border-2 border-slate-400 cursor-not-allowed">
                <i data-lucide="arrow-left" class="w-5 h-5 stroke-[3]"></i>
            </div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="p-3 bg-white text-slate-900 rounded-xl border-2 border-slate-900 shadow-[3px_3px_0px_0px_#0f172a] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                <i data-lucide="arrow-left" class="w-5 h-5 stroke-[3]"></i>
            </a>
        @endif

        <!-- Indikator Halaman -->
        <span class="font-black text-slate-800 text-xs uppercase tracking-widest bg-white px-4 py-2 rounded-lg border-2 border-slate-900 shadow-[2px_2px_0px_0px_#0f172a]">
            Hal {{ $paginator->currentPage() }}
        </span>

        <!-- Tombol Next -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="p-3 bg-white text-slate-900 rounded-xl border-2 border-slate-900 shadow-[3px_3px_0px_0px_#0f172a] hover:translate-y-1 hover:translate-x-1 hover:shadow-none transition-all">
                <i data-lucide="arrow-right" class="w-5 h-5 stroke-[3]"></i>
            </a>
        @else
            <div class="p-3 bg-slate-200 text-slate-400 rounded-xl border-2 border-slate-400 cursor-not-allowed">
                <i data-lucide="arrow-right" class="w-5 h-5 stroke-[3]"></i>
            </div>
        @endif
        
    </div>
@endif