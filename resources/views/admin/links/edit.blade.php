@extends('layouts.app')

@section('title', 'Edit Link - Admin Dashboard')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 sm:space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 sm:p-6 rounded-2xl border-2 border-green-900 shadow-[4px_4px_0px_0px_#14532d]">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-green-950 flex items-center gap-2.5">
                <a href="{{ route('admin.links.index') }}" class="bg-lime-200 hover:bg-lime-300 p-1.5 rounded-lg border-2 border-green-900 shadow-[2px_2px_0px_0px_#14532d] transition-all">
                    <i data-lucide="arrow-left" class="w-5 h-5 stroke-[2.5] text-green-950"></i>
                </a>
                Edit Tautan
            </h1>
        </div>
    </div>

    <!-- Container Form Utama -->
    <div class="bg-white rounded-2xl border-2 border-green-900 shadow-[4px_4px_0px_0px_#14532d] p-6 sm:p-8">

        <form action="{{ route('admin.links.update', $link->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Field: Judul Tautan -->
            <div class="space-y-2">
                <label for="title" class="block text-sm font-extrabold text-green-950">Judul Tautan <span class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $link->title) }}" required
                       class="w-full px-4 py-3 bg-green-50 border-2 border-green-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-500/20 font-medium text-green-950">
                @error('title')
                    <p class="text-xs font-bold text-rose-600 flex items-center gap-1 mt-1"><i data-lucide="circle-alert" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Field: URL Tujuan -->
            <div class="space-y-2">
                <label for="url" class="block text-sm font-extrabold text-green-950">URL Tujuan <span class="text-rose-500">*</span></label>
                <input type="url" id="url" name="url" value="{{ old('url', $link->url) }}" required
                       class="w-full px-4 py-3 bg-green-50 border-2 border-green-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-500/20 font-medium text-green-950">
                @error('url')
                    <p class="text-xs font-bold text-rose-600 flex items-center gap-1 mt-1"><i data-lucide="circle-alert" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Field: Komponen Berkas Saat Ini & Dropzone Baru -->
            <div class="space-y-3">
                <label class="block text-sm font-extrabold text-green-950">Ikon / Logo <span class="text-green-700/60 font-medium">(Opsional)</span></label>

                <!-- Information Card: Gambar Aktif -->
                <div class="p-4 border-2 border-green-200 border-dashed rounded-xl bg-green-50">
                    <p class="text-[10px] font-black text-green-700/70 uppercase tracking-wider mb-2">Gambar Saat Ini:</p>
                    @if($link->image)
                        <img src="{{ asset('storage/' . $link->image) }}" class="h-16 w-16 object-cover border-2 border-green-900 rounded-xl shadow-[2px_2px_0px_0px_#14532d]" alt="Gambar Saat Ini">
                    @else
                        <span class="inline-block px-3 py-1.5 bg-white border-2 border-green-300 rounded-lg text-xs font-bold text-green-700/70">Belum Ada Gambar</span>
                    @endif
                </div>

                <!-- Dropzone Gambar Baru -->
                <div id="preview-wrapper" class="relative overflow-hidden rounded-2xl border-2 border-green-900 bg-green-50 transition-colors duration-200">
                    <div id="preview-empty" class="flex flex-col items-center justify-center gap-3 py-8 px-6 cursor-pointer hover:bg-green-100 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-lime-200 border-2 border-green-900 flex items-center justify-center shadow-[3px_3px_0px_0px_#14532d]">
                            <i data-lucide="image-plus" class="w-6 h-6 stroke-[2.5] text-green-950"></i>
                        </div>
                        <div>
                            <p class="text-sm font-extrabold text-green-950">Ganti Gambar Baru?</p>
                            <p class="text-[11px] font-semibold text-green-700/70 mt-1">Biarkan kosong jika tidak ingin mengubahnya.</p>
                        </div>
                    </div>

                    <div id="preview-filled" class="hidden">
                        <img id="preview-img" src="" class="w-full max-h-72 object-contain bg-green-100" alt="Pratinjau Gambar Baru">
                        <div class="flex justify-between items-center p-4 bg-white border-t-2 border-green-900">
                            <p id="preview-file-name" class="text-sm font-extrabold text-green-950 truncate">nama-file.png</p>
                            <button type="button" id="preview-remove" class="text-xs text-rose-700 bg-rose-100 font-extrabold px-3 py-1.5 rounded-lg border-2 border-green-900 shadow-[2px_2px_0px_0px_#14532d]">Batal Ganti</button>
                        </div>
                    </div>
                </div>

                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                @error('image')
                    <p class="text-xs font-bold text-rose-600 flex items-center gap-1 mt-1"><i data-lucide="circle-alert" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Field: Toggle Status Display -->
            <div class="pt-2">
                <label for="is_active" class="cursor-pointer select-none">
                    <div class="flex items-center justify-between gap-4 bg-green-50 border-2 border-green-900 rounded-2xl px-4 sm:px-5 py-3.5 shadow-[3px_3px_0px_0px_#14532d] transition-all hover:shadow-[5px_5px_0px_0px_#14532d]">
                        <div class="flex items-center gap-3">
                            <span class="bg-green-100 text-green-700 p-2 rounded-xl border border-green-200">
                                <i data-lucide="eye" class="w-5 h-5 stroke-[2.5]"></i>
                            </span>
                            <div class="flex flex-col">
                                <span class="text-sm font-extrabold text-green-950">Tampilkan Tautan Ini ke Publik</span>
                                <span id="is_active_hint" class="text-[11px] font-semibold text-green-700/70 mt-0.5">Tautan akan terlihat di halaman publik</span>
                            </div>
                        </div>

                        <input type="checkbox" id="is_active" name="is_active" class="sr-only peer" {{ old('is_active', $link->is_active) ? 'checked' : '' }}>
                        <span class="relative w-12 h-7 bg-green-200 peer-checked:bg-lime-400 rounded-full border-2 border-green-900 transition-colors duration-300 shrink-0 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:w-5 after:h-5 after:bg-white after:rounded-full after:border-2 after:border-green-900 after:transition-transform peer-checked:after:translate-x-5"></span>
                    </div>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 flex justify-end gap-3 border-t-2 border-dashed border-green-200">
                <a href="{{ route('admin.links.index') }}" class="bg-green-50 text-green-950 font-extrabold py-3 px-6 rounded-xl border-2 border-green-900 shadow-[3px_3px_0px_0px_#14532d]">Batal</a>
                <button type="submit" class="bg-lime-300 hover:bg-lime-200 text-green-950 font-extrabold py-3 px-8 rounded-xl border-2 border-green-900 shadow-[3px_3px_0px_0px_#14532d] flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-5 h-5 stroke-[2.5]"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/image-preview.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('is_active');
        const hint = document.getElementById('is_active_hint');

        if (toggle && hint) {
            const updateHint = () => {
                hint.textContent = toggle.checked
                    ? 'Tautan akan terlihat di halaman publik'
                    : 'Tautan disembunyikan dari halaman publik';
            };
            toggle.addEventListener('change', updateHint);
            updateHint();
        }
    });
</script>
@endsection
