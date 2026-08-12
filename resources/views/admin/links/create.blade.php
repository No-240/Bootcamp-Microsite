@extends('layouts.app')

@section('title', 'Tambah Link - Admin Dashboard')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 sm:space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 sm:p-6 rounded-2xl border-2 border-green-900 shadow-[4px_4px_0px_0px_#14532d]">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-green-950 flex items-center gap-2.5">
                <a href="{{ route('admin.links.index') }}" class="bg-lime-200 hover:bg-lime-300 p-1.5 rounded-lg border-2 border-green-900 shadow-[2px_2px_0px_0px_#14532d] transition-all">
                    <i data-lucide="arrow-left" class="w-5 h-5 stroke-[2.5] text-green-950"></i>
                </a>
                Tambah Link Baru
            </h1>
        </div>
    </div>

    <!-- Container Form Utama -->
    <div class="bg-white rounded-2xl border-2 border-green-900 shadow-[4px_4px_0px_0px_#14532d] p-6 sm:p-8">

        <form action="{{ route('admin.links.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Field: Judul Tautan -->
            <div class="space-y-2">
                <label for="title" class="block text-sm font-extrabold text-green-950">Judul Tautan <span class="text-rose-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       placeholder="Masukkan judul link..."
                       class="w-full px-4 py-3 bg-green-50 border-2 border-green-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-500/20 font-medium text-green-950">
                @error('title')
                    <p class="text-xs font-bold text-rose-600 flex items-center gap-1 mt-1"><i data-lucide="circle-alert" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Field: URL Tujuan -->
            <div class="space-y-2">
                <label for="url" class="block text-sm font-extrabold text-green-950">URL Tujuan <span class="text-rose-500">*</span></label>
                <input type="url" id="url" name="url" value="{{ old('url') }}" required
                       placeholder="https://example.com"
                       class="w-full px-4 py-3 bg-green-50 border-2 border-green-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-500/20 font-medium text-green-950">
                @error('url')
                    <p class="text-xs font-bold text-rose-600 flex items-center gap-1 mt-1"><i data-lucide="circle-alert" class="w-3.5 h-3.5"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Field: Dropzone Gambar -->
            <div class="space-y-3">
                <label class="block text-sm font-extrabold text-green-950">Ikon / Logo <span class="text-green-700/60 font-medium">(Opsional)</span></label>

                <div id="drop-zone" class="relative overflow-hidden rounded-2xl border-2 border-green-900 bg-green-50 transition-colors duration-200 cursor-pointer hover:bg-green-100">
                    <input type="file"
                           name="image"
                           id="image"
                           accept="image/*"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                    <div id="preview-container" class="flex flex-col items-center justify-center gap-3 py-8 px-6 text-center">
                        <div class="w-12 h-12 rounded-2xl bg-lime-200 border-2 border-green-900 flex items-center justify-center shadow-[3px_3px_0px_0px_#14532d]">
                            <i data-lucide="upload" class="w-6 h-6 stroke-[2.5] text-green-950"></i>
                        </div>
                        <div>
                            <p class="text-sm font-extrabold text-green-950">Klik atau drag & drop gambar di sini</p>
                            <p class="text-[11px] font-semibold text-green-700/70 mt-1">Maksimal 2MB (JPG, PNG, GIF)</p>
                        </div>
                    </div>

                    <div id="image-preview" class="hidden">
                        <img id="preview-img" src="#" alt="Preview" class="w-full max-h-72 object-contain bg-green-100">
                        <div class="relative z-20 flex justify-between items-center p-4 bg-white border-t-2 border-green-900">
                            <p class="text-sm font-extrabold text-green-950">Gambar dipilih</p>
                            <button type="button" id="remove-image" class="text-xs text-rose-700 bg-rose-100 font-extrabold px-3 py-1.5 rounded-lg border-2 border-green-900 shadow-[2px_2px_0px_0px_#14532d]">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>

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
                                <span class="text-[11px] font-semibold text-green-700/70 mt-0.5">Jika dicentang, link akan tampil di halaman publik</span>
                            </div>
                        </div>

                        <input type="checkbox" id="is_active" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                        <span class="relative w-12 h-7 bg-green-200 peer-checked:bg-lime-400 rounded-full border-2 border-green-900 transition-colors duration-300 shrink-0 after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:w-5 after:h-5 after:bg-white after:rounded-full after:border-2 after:border-green-900 after:transition-transform peer-checked:after:translate-x-5"></span>
                    </div>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="pt-6 flex justify-end gap-3 border-t-2 border-dashed border-green-200">
                <a href="{{ route('admin.links.index') }}" class="bg-green-50 text-green-950 font-extrabold py-3 px-6 rounded-xl border-2 border-green-900 shadow-[3px_3px_0px_0px_#14532d]">Batal</a>
                <button type="submit" class="bg-lime-300 hover:bg-lime-200 text-green-950 font-extrabold py-3 px-8 rounded-xl border-2 border-green-900 shadow-[3px_3px_0px_0px_#14532d] flex items-center gap-2">
                    <i data-lucide="save" class="w-5 h-5 stroke-[2.5]"></i> Simpan Link
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('image');
        const previewContainer = document.getElementById('preview-container');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        const removeBtn = document.getElementById('remove-image');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) previewFile(file);
        });

        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('bg-green-100');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('bg-green-100');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('bg-green-100');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                previewFile(files[0]);
            }
        });

        function previewFile(file) {
            if (!file.type.startsWith('image/')) {
                alert('File harus berupa gambar!');
                fileInput.value = '';
                return;
            }
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal 2MB!');
                fileInput.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.add('hidden');
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        removeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            fileInput.value = '';
            previewImg.src = '#';
            imagePreview.classList.add('hidden');
            previewContainer.classList.remove('hidden');
        });

        lucide.createIcons();
    });
</script>
@endpush
@endsection
