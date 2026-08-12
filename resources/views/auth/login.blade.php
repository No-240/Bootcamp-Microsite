<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Area - BioLink Admin</title>

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
<body class="bg-grid-pattern min-h-screen font-sans antialiased flex flex-col justify-center py-12 sm:px-6 lg:px-8">

    <div class="sm:mx-auto sm:w-full sm:max-w-md px-4">

        <!-- Header Brand -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-amber-200 border-4 border-slate-900 rounded-2xl flex items-center justify-center shadow-[4px_4px_0px_0px_#0f172a] mx-auto mb-4">
                <i data-lucide="lock" class="w-8 h-8 text-slate-900 stroke-[2.5]"></i>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Login Admin</h1>
            <p class="text-sm font-bold text-slate-600 mt-2">Masuk untuk mengelola ekosistem Bio-Link</p>
        </div>

        <!-- Form Container Card -->
        <div class="bg-white border-4 border-slate-900 rounded-3xl p-6 sm:p-8 shadow-[8px_8px_0px_0px_#0f172a]">

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Display Alert Error -->
                @if($errors->any())
                    <div class="bg-rose-200 border-2 border-slate-900 p-4 rounded-xl flex items-start gap-3 shadow-[2px_2px_0px_0px_#0f172a]">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-800 shrink-0 mt-0.5"></i>
                        <p class="text-sm font-bold text-rose-900">{{ $errors->first() }}</p>
                    </div>
                @endif

                <!-- Input Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-extrabold text-slate-900">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-900 transition-all placeholder:text-slate-400">
                </div>

                <!-- Input Password -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-extrabold text-slate-900">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-900 rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 font-medium text-slate-900 transition-all placeholder:text-slate-400">
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-blue-400 hover:bg-blue-300 text-slate-950 font-extrabold py-3.5 rounded-xl border-2 border-slate-900 shadow-[4px_4px_0px_0px_#0f172a] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-2">
                        Masuk Dashboard <i data-lucide="arrow-right" class="w-5 h-5 stroke-[2.5]"></i>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>