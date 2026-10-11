<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <!-- Brand Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 shadow-sm mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Jajal Medical
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Implant Case Management Portal
            </p>
        </div>

        <!-- Main White Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xl shadow-gray-100 p-8 space-y-6">

            <!-- 1. Two Quick Role Buttons (Admin & Viewer) -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                        Quick Role Login
                    </span>
                    <span class="text-[11px] text-gray-400">1-click demo access</span>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <!-- Admin Login Button -->
                    <button type="button"
                            onclick="quickFill('admin@jajalmedical.com', 'password123')"
                            class="group relative flex flex-col items-start p-3 text-left rounded-xl bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-200 hover:border-indigo-300 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <div class="flex items-center justify-between w-full">
                            <span class="p-1.5 rounded-lg bg-indigo-600 text-white group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </span>
                            <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-indigo-200/80 text-indigo-800">
                                Full Access
                            </span>
                        </div>
                        <div class="mt-2.5">
                            <p class="text-sm font-semibold text-gray-900 group-hover:text-indigo-900">Admin Login</p>
                            <p class="text-[11px] text-gray-500">Create, edit, delete</p>
                        </div>
                    </button>

                    <!-- Viewer Login Button -->
                    <button type="button"
                            onclick="quickFill('viewer@jajalmedical.com', 'password123')"
                            class="group relative flex flex-col items-start p-3 text-left rounded-xl bg-gray-50 hover:bg-gray-100 border border-gray-200 hover:border-gray-300 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-gray-400">
                        <div class="flex items-center justify-between w-full">
                            <span class="p-1.5 rounded-lg bg-gray-600 text-white group-hover:scale-105 transition-transform">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                            <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-gray-200 text-gray-700">
                                Read Only
                            </span>
                        </div>
                        <div class="mt-2.5">
                            <p class="text-sm font-semibold text-gray-900 group-hover:text-gray-950">Viewer Login</p>
                            <p class="text-[11px] text-gray-500">Browse cases only</p>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Divider -->
            <div class="relative flex items-center justify-center">
                <div class="w-full border-t border-gray-200"></div>
                <span class="px-3 text-xs uppercase tracking-wider text-gray-400 bg-white font-medium">
                    Or sign in with email
                </span>
                <div class="w-full border-t border-gray-200"></div>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- 2. Email & Password Login Form -->
            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1.5">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </div>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email', 'admin@jajalmedical.com') }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="doctor@jajalmedical.com"
                               class="block w-full pl-10 pr-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition @error('email') border-red-500 text-red-900 @enderror">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-700">
                            Password
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 hover:text-indigo-700 font-medium transition">
                                Forgot?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               value="password123"
                               required
                               autocomplete="current-password"
                               placeholder="••••••••••••"
                               class="block w-full pl-10 pr-3.5 py-2.5 bg-white border border-gray-300 rounded-xl text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition @error('password') border-red-500 text-red-900 @enderror">
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ms-2 text-xs text-gray-600">Remember this device</span>
                    </label>
                </div>

                <!-- Log In Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                            id="submitBtn"
                            class="w-full flex justify-center items-center py-3 px-4 rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 transition duration-150">
                        <span>Log In</span>
                        <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-400 text-center mt-6">
            Jajal Medical • Clinical Device Management Sandbox
        </p>
    </div>

    <!-- Script: Quick Role Autofill & Submit -->
    <script>
        function quickFill(email, password) {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('loginForm');

            emailInput.value = email;
            passwordInput.value = password;

            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span>Authenticating...</span>
            `;

            form.submit();
        }
    </script>
</x-guest-layout>
