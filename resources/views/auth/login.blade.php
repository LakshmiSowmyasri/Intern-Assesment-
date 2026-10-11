<x-guest-layout>
    <div class="w-full max-w-sm mx-auto text-center space-y-8">
        <!-- Logo / Title -->
        <div class="flex flex-col items-center">
            <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-50 border border-indigo-100 shadow-sm mb-3 text-indigo-600">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Jajal Medical
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Implant Case Management
            </p>
        </div>

        <!-- Two Buttons Only -->
        <div class="space-y-4">
            <!-- 1. Admin Login Button -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="email" value="admin@jajalmedical.com">
                <input type="hidden" name="password" value="password123">
                <button type="submit"
                        class="w-full group flex items-center justify-between p-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-semibold text-base shadow-sm hover:shadow-md transition-all duration-150">
                    <div class="flex items-center gap-3">
                        <span class="p-2 rounded-lg bg-white/20 text-white">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </span>
                        <div class="text-left">
                            <div class="font-semibold text-white">Admin Login</div>
                            <div class="text-xs text-indigo-100 font-normal">Full CRUD Access</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-indigo-200 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </form>

            <!-- 2. Viewer Login Button -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="email" value="viewer@jajalmedical.com">
                <input type="hidden" name="password" value="password123">
                <button type="submit"
                        class="w-full group flex items-center justify-between p-4 rounded-xl bg-white hover:bg-gray-50 active:bg-gray-100 text-gray-800 font-semibold text-base border-2 border-gray-200 hover:border-gray-300 shadow-sm hover:shadow transition-all duration-150">
                    <div class="flex items-center gap-3">
                        <span class="p-2 rounded-lg bg-gray-100 text-gray-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                        <div class="text-left">
                            <div class="font-semibold text-gray-900">Viewer Login</div>
                            <div class="text-xs text-gray-500 font-normal">Read-Only Access</div>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
