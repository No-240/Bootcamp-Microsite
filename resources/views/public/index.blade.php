<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bio-Link | {{ $profile->name ?? 'Profile' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        .bg-grid-pattern {
            background: linear-gradient(135deg, #14532d 0%, #22c55e 35%, #f0fdf4 75%, #ffffff 100%);
            background-attachment: fixed;
            min-height: 100vh;
        }

        .btn-neo {
            box-shadow: 4px 4px 0px 0px #052e16;
            border: 2px solid #052e16;
            transition: all 0.15s ease;
        }
        .btn-neo:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px 0px #052e16;
        }

        .card-neo {
            box-shadow: 6px 6px 0px 0px #052e16, 0 0 0 1px rgba(255,255,255,0.6);
            border: 2px solid #052e16;
        }

        .link-card {
            transition: all 0.15s ease;
        }
        .link-card:hover {
            transform: translate(-2px, -2px);
        }
        .link-card:active {
            transform: translate(4px, 4px);
        }
        .link-card > .absolute {
            background: #052e16 !important;
        }
        .link-card > .relative {
            box-shadow: 0 0 0 1px rgba(255,255,255,0.6);
        }
    </style>
</head>

<body class="bg-grid-pattern min-h-screen font-sans antialiased text-green-950">

    <main class="max-w-lg mx-auto px-4 py-8 md:py-12">

        {{-- ============================================= --}}
        {{-- HEADER PROFIL PERUSAHAAN --}}
        {{-- ============================================= --}}
        <div class="text-center mb-8">

            {{-- Avatar --}}
            <div class="relative inline-block mb-4">
                <div class="w-28 h-28 rounded-full border-4 border-green-900 overflow-hidden card-neo bg-white mx-auto">
                    @if($profile && $profile->photo)
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/pfpcomp.png') }}"
                             alt="{{ $profile->name }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="absolute -bottom-1 -right-1 bg-green-600 text-white text-[10px] font-black px-3 py-1 rounded-full border-2 border-green-900 btn-neo">
                    ✔ Verified
                </div>
            </div>

            {{-- Nama Perusahaan --}}
            <h1 class="text-2xl md:text-3xl font-black tracking-tight">
                {{ $profile->name ?? 'CV JAYAGIRY' }}
            </h1>

            {{-- Deskripsi --}}
            <p class="text-sm font-bold text-green-800 mt-1 max-w-xs mx-auto">
                {{ $profile->bio ?? 'CV. JAYAGIRY Merupakan Perusahaan yang Bergerak Dibidang Pengadaan Peralatan Kesehatan' }}
            </p>
            @if($profile && $profile->sub_bio)
                <p class="text-xs font-semibold text-green-700/80 mt-1 max-w-xs mx-auto">
                    {{ $profile->sub_bio }}
                </p>
            @endif
        </div>

        {{-- ============================================= --}}
        {{-- SOSIAL MEDIA --}}
        {{-- ============================================= --}}
        @php
            $socials = [
                'instagram' => 'instagram',
                'github'    => 'github',
                'linkedin'  => 'linkedin',
                'youtube'   => 'youtube',
                'twitter'   => 'twitter',
                'facebook'  => 'facebook',
            ];
        @endphp

        <div class="flex flex-wrap items-center justify-center gap-3 mb-6">
            @foreach($socials as $key => $icon)
                @if($profile && $profile->$key)
                    <a href="{{ $profile->$key }}" target="_blank" rel="noopener"
                       class="p-2.5 bg-white rounded-full border-2 border-green-900 btn-neo hover:bg-green-100 transition-all duration-200 hover:-translate-y-1">
                        <i data-lucide="{{ $icon }}" class="w-5 h-5 text-green-900"></i>
                    </a>
                @endif
            @endforeach

            @if($profile && $profile->email)
                <a href="mailto:{{ $profile->email }}"
                   class="p-2.5 bg-white rounded-full border-2 border-green-900 btn-neo hover:bg-green-100 transition-all duration-200 hover:-translate-y-1">
                    <i data-lucide="mail" class="w-5 h-5 text-green-900"></i>
                </a>
            @endif
        </div>

        {{-- ============================================= --}}
        {{-- INFO PERUSAHAAN (ALAMAT & JAM OPERASIONAL) --}}
        {{-- ============================================= --}}
        @if($profile && ($profile->address || $profile->working_hours))
            <div class="bg-white border-2 border-green-900 rounded-2xl p-5 mb-8 card-neo space-y-3">
                @if($profile->address)
                    <div class="flex items-start gap-3">
                        <div class="p-2 bg-green-100 border-2 border-green-900 rounded-xl mt-0.5 shrink-0">
                            <i data-lucide="map-pin" class="w-4 h-4 text-green-900"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-green-700 uppercase tracking-wide">Alamat</p>
                            <p class="font-bold text-sm text-green-950">{{ $profile->address }}</p>
                        </div>
                    </div>
                @endif

                @if($profile->working_hours)
                    <div class="flex items-start gap-3 {{ $profile->address ? 'border-t-2 border-dashed border-green-200 pt-3' : '' }}">
                        <div class="p-2 bg-green-100 border-2 border-green-900 rounded-xl mt-0.5 shrink-0">
                            <i data-lucide="clock" class="w-4 h-4 text-green-900"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-green-700 uppercase tracking-wide">Jam Operasional</p>
                            <p class="font-bold text-sm text-green-950">{{ $profile->working_hours }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        {{-- ============================================= --}}
        {{-- DAFTAR LINK --}}
        {{-- ============================================= --}}
        <div class="space-y-4">

            {{-- Tombol Contact Details --}}
            <button onclick="openModal()"
                    class="w-full relative group bg-green-900 border-2 border-green-900 rounded-2xl p-4 btn-neo hover:bg-green-800 transition-all duration-200 flex items-center justify-center gap-2">
                <i data-lucide="phone" class="w-5 h-5 text-white"></i>
                <span class="font-black text-white">Contact Details</span>
                <i data-lucide="chevron-right" class="w-4 h-4 text-green-300 ml-1"></i>
            </button>

            {{-- Looping Links dengan Tracking --}}
            @forelse($links as $link)
                <a href="{{ route('public.redirect', $link->id) }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="w-full block relative group link-card">

                    {{-- Shadow effect --}}
                    <div class="absolute inset-0 bg-green-900 rounded-2xl translate-y-1.5 translate-x-1.5"></div>
                    
                    {{-- Card content --}}
                    <div class="relative w-full bg-white border-2 border-green-900 rounded-2xl p-4 flex items-center transition-all duration-150">

                        @if($link->image)
                            <img src="{{ asset('storage/' . $link->image) }}"
                                 alt="{{ $link->title }}"
                                 class="w-10 h-10 object-cover rounded-xl border-2 border-green-900 absolute left-4 bg-green-50">
                        @else
                            <div class="w-10 h-10 bg-green-100 border-2 border-green-900 rounded-xl flex items-center justify-center absolute left-4 shadow-[2px_2px_0px_0px_#14532d]">
                                <i data-lucide="link" class="w-5 h-5 text-green-900 stroke-[3]"></i>
                            </div>
                        @endif

                        <span class="w-full text-center font-black text-green-950 text-base px-12 truncate">
                            {{ $link->title }}
                        </span>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-green-700 absolute right-4"></i>
                    </div>
                </a>
            @empty
                <div class="w-full bg-white border-2 border-green-900 rounded-2xl p-8 text-center card-neo">
                    <i data-lucide="inbox" class="w-12 h-12 text-green-200 mx-auto mb-3"></i>
                    <p class="font-bold text-green-800">Belum ada link tersedia</p>
                    <p class="text-xs text-green-600 mt-1">Silakan tambahkan link melalui dashboard admin</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $links->links('vendor.pagination.custom-public') }}
        </div>

        {{-- Footer --}}
        <div class="text-center mt-12">
            <p class="text-[10px] font-bold text-green-700/70">
                © {{ date('Y') }} {{ $profile->name ?? 'Company' }}. All rights reserved.
            </p>
        </div>

    </main>

    {{-- ============================================= --}}
    {{-- MODAL CONTACT DETAILS --}}
    {{-- ============================================= --}}
    <div id="contact-modal" class="fixed inset-0 z-50 hidden opacity-0 transition-opacity duration-300">

        <div class="absolute inset-0 bg-green-950/50 backdrop-blur-sm" onclick="closeModal()"></div>

        <div id="modal-content"
             class="absolute bottom-0 left-0 right-0 bg-white border-t-4 border-green-900 rounded-t-[2rem] p-6 max-w-lg mx-auto max-h-[90vh] overflow-y-auto translate-y-full transition-transform duration-300 shadow-[0px_-8px_0px_0px_rgba(20,83,45,0.15)]">

            <div class="w-12 h-1.5 bg-green-200 rounded-full mx-auto mb-6 shrink-0"></div>

            <div class="text-center mb-6">
                <span class="text-[10px] font-extrabold text-green-600 uppercase tracking-widest">Contact Details</span>
                <h3 class="text-2xl font-black text-green-950 mt-1">{{ $profile->name ?? 'CV Jaya Giry' }}</h3>
                <p class="text-xs font-bold text-green-700">{{ $profile->bio ?? 'Pengadaan Peralatan Kesehatan' }}</p>
            </div>

            <div class="bg-green-50 border-2 border-green-900 rounded-2xl p-5 mb-6 space-y-4 card-neo">

                <div class="flex items-center gap-3 border-b-2 border-dashed border-green-200 pb-4">
                    <div class="p-2 bg-white border-2 border-green-900 rounded-xl"><i data-lucide="mail" class="w-4 h-4 text-green-900"></i></div>
                    <div>
                        <p class="text-[10px] font-bold text-green-600 uppercase">Email</p>
                        <p class="font-extrabold text-sm text-green-950">info@jayagiry.com</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 border-b-2 border-dashed border-green-200 pb-4">
                    <div class="p-2 bg-white border-2 border-green-900 rounded-xl"><i data-lucide="phone" class="w-4 h-4 text-green-900"></i></div>
                    <div>
                        <p class="text-[10px] font-bold text-green-600 uppercase">Telepon</p>
                        <p class="font-extrabold text-sm text-green-950">0812-3456-7890</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 border-b-2 border-dashed border-green-200 pb-4">
                    <div class="p-2 bg-white border-2 border-green-900 rounded-xl mt-0.5"><i data-lucide="map-pin" class="w-4 h-4 text-green-900"></i></div>
                    <div>
                        <p class="text-[10px] font-bold text-green-600 uppercase">Alamat</p>
                        <p class="font-extrabold text-sm text-green-950">Jl. Raya Cisaat No. 123, Kec. Cisaat, Kab. Sukabumi, Jawa Barat</p>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <div class="p-2 bg-white border-2 border-green-900 rounded-xl mt-0.5"><i data-lucide="clock" class="w-4 h-4 text-green-900"></i></div>
                    <div>
                        <p class="text-[10px] font-bold text-green-600 uppercase">Jam Kerja</p>
                        <p class="font-extrabold text-sm text-green-950">Senin - Jumat, 08.00 - 17.00 WIB</p>
                    </div>
                </div>

            </div>

            <div class="bg-lime-50 border-2 border-green-900 p-4 rounded-xl flex gap-3 mb-6 card-neo">
                <i data-lucide="info" class="w-5 h-5 shrink-0 mt-0.5 text-green-900"></i>
                <p class="text-[11px] font-bold text-green-800 leading-relaxed">
                    Browser Anda mungkin tidak mendukung download VCF otomatis. Silakan salin nomor secara manual.
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('public.download.vcf') }}"
                   class="flex-1 bg-green-900 text-white font-black py-4 rounded-xl hover:bg-green-800 transition-colors border-2 border-green-900 text-center btn-neo">
                    📇 Download VCF
                </a>
                <button onclick="closeModal()"
                        class="w-14 h-14 shrink-0 bg-red-200 border-2 border-green-900 rounded-xl flex items-center justify-center btn-neo hover:bg-red-300 transition-colors">
                    <i data-lucide="x" class="w-6 h-6 stroke-[3] text-green-950"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const modal = document.getElementById('contact-modal');
        const modalContent = document.getElementById('modal-content');

        function openModal() {
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('translate-y-full');
            });
            document.body.style.overflow = 'hidden';
            setTimeout(() => lucide.createIcons(), 150);
        }

        function closeModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.add('translate-y-full');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    </script>

</body>
</html>
