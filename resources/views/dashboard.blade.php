<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-white tracking-tight">
                Dashboard
            </h2>

            <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xl">
                <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                <span class="text-sm text-gray-300">
                    System Active
                </span>
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#070B14] relative overflow-hidden">

        <!-- Background Glow -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-cyan-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-fuchsia-500/20 rounded-full blur-3xl"></div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 30px 30px;">
        </div>

        <div class="relative z-10 py-14 px-6">

            <div class="max-w-7xl mx-auto">

                <!-- Hero Card -->
                <div class="relative overflow-hidden rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl shadow-2xl">

                    <!-- Blur Accent -->
                    <div class="absolute -top-32 -right-32 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>

                    <div class="relative z-10 grid lg:grid-cols-2 gap-10 items-center p-8 md:p-14">

                        <!-- LEFT -->
                        <div>

                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-400/20 mb-6">
                                <div class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></div>

                                <span class="text-sm font-medium text-cyan-300">
                                    Premium Admin Dashboard
                                </span>
                            </div>

                            <h1 class="text-5xl md:text-6xl font-black leading-tight text-white tracking-tight">

                                Control Your
                                <span class="bg-gradient-to-r from-cyan-400 to-fuchsia-500 bg-clip-text text-transparent">
                                    Spin Wheel
                                </span>

                            </h1>

                            <p class="mt-6 text-lg leading-relaxed text-gray-300 max-w-xl">
                                Kelola hadiah, data peserta, history spin,
                                dan seluruh sistem aplikasi dalam satu dashboard modern.
                            </p>

                            <!-- Buttons -->
                            <div class="mt-10 flex flex-wrap gap-4">

                                <a href="{{ route('admin.index') }}"
                                    class="group relative inline-flex items-center gap-3 overflow-hidden rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 px-7 py-4 font-semibold text-white shadow-[0_0_30px_rgba(34,211,238,0.35)] transition-all duration-300 hover:scale-105 hover:shadow-[0_0_45px_rgba(34,211,238,0.55)]">

                                    <span class="relative z-10">
                                        Open Admin Panel
                                    </span>

                                    <span class="relative z-10 transition duration-300 group-hover:translate-x-1">
                                        →
                                    </span>

                                    <div class="absolute inset-0 bg-white/10 opacity-0 transition duration-300 group-hover:opacity-100"></div>
                                </a>

                                <button
                                    class="inline-flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-6 py-4 text-white backdrop-blur-xl transition duration-300 hover:bg-white/10">

                                    Live System
                                </button>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="relative flex justify-center">

                            <!-- Floating Card -->
                            <div class="relative w-full max-w-md">

                                <!-- Main Floating Box -->
                                <div class="relative overflow-hidden rounded-[28px] border border-white/10 bg-[#0F172A]/80 p-8 backdrop-blur-2xl shadow-[0_20px_80px_rgba(0,0,0,0.45)]">

                                    <!-- Top -->
                                    <div class="flex items-center justify-between">

                                        <div>
                                            <p class="text-sm text-gray-400">
                                                Active Users
                                            </p>

                                            <h2 class="mt-2 text-4xl font-black text-white">
                                                1,284
                                            </h2>
                                        </div>

                                        <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 shadow-lg">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-8 h-8 text-white"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor">

                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>

                                        </div>

                                    </div>

                                    <!-- Stats -->
                                    <div class="grid grid-cols-2 gap-4 mt-8">

                                        <div class="rounded-2xl bg-white/5 p-5 border border-white/5">
                                            <p class="text-sm text-gray-400">
                                                Total Prize
                                            </p>

                                            <h3 class="mt-2 text-2xl font-bold text-white">
                                                240
                                            </h3>
                                        </div>

                                        <div class="rounded-2xl bg-white/5 p-5 border border-white/5">
                                            <p class="text-sm text-gray-400">
                                                Spin Today
                                            </p>

                                            <h3 class="mt-2 text-2xl font-bold text-white">
                                                892
                                            </h3>
                                        </div>

                                    </div>

                                    <!-- Bottom -->
                                    <div class="mt-8 rounded-2xl bg-gradient-to-r from-cyan-500/10 to-fuchsia-500/10 border border-white/10 p-5">

                                        <div class="flex items-center justify-between">

                                            <div>
                                                <p class="text-sm text-gray-400">
                                                    Welcome Back
                                                </p>

                                                <h4 class="mt-1 text-lg font-semibold text-white">
                                                    {{ Auth::user()->name }}
                                                </h4>
                                            </div>

                                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600"></div>

                                        </div>

                                    </div>

                                </div>

                                <!-- Floating Effect -->
                                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-3xl bg-cyan-500/20 blur-2xl"></div>
                                <div class="absolute -bottom-6 -left-6 w-24 h-24 rounded-3xl bg-fuchsia-500/20 blur-2xl"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>