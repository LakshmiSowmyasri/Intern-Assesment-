<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Brand Header -->
        <div class="flex flex-col items-center text-center">
            <div class="relative flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 to-blue-500 shadow-xl shadow-indigo-500/25 ring-1 ring-white/20 mb-4">
                <svg class="w-9 h-9 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5" stroke-dasharray="3 3" />
                </svg>
                <span class="absolute -top-1 -right-1 flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-teal-500"></span>
                </span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                Jajal Medical
            </h1>
            <p class="mt-1 text-sm text-slate-400">
                Implant Case Management System
            </p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-slate-900/80 backdrop-blur-xl py-8 px-6 shadow-2xl rounded-2xl sm:px-10 border border-slate-800/80 ring-1 ring-white/5 space-y-6">

            <!-- Quick Demo Login Buttons (Admin & Viewer) -->
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                        </svg>
                        Quick Demo Login
                    </span>
                    <span class="text-[11px] text-slate-500">Click to autofill & submit</span>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <!-- Admin Login Button -->
                    <button type="button"
                            onclick="quickLogin('admin@jajalmedical.com', 'password123')"
                            class="group relative flex flex-col items-start p-3 text-left rounded-xl bg-gradient-to-b from-indigo-500/10 to-indigo-500/5 hover:from-indigo-500/20 hover:to-indigo-500/10 border border-indigo-500/30 hover:border-indigo-400/60 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <div class="flex items-center justify-between w-full">
                            <span class="inline-flex items-center justify-center p-1.5 rounded-lg bg-indigo-500/20 text-indigo-300 group-hover:scale-110 transition-transform">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </span>
                            <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-indigo-500/30 text-indigo-200">
                                Full Access
                            </span>
                        </div>
                        <div class="mt-2.5">
                            <p class="text-sm font-semibold text-white group-hover:text-indigo-200 transition-colors">Admin Login</p>
                            <p class="text-[11px] text-slate-400">Create, edit, delete</p>
                        </div>
                    </button>

                    <!-- Viewer Login Button -->
                    <button type="button"
                            onclick="quickLogin('viewer@jajalmedical.com', 'password123')"
                            class="group relative flex flex-col items-start p-3 text-left rounded-xl bg-gradient-to-b from-slate-800/60 to-slate-800/30 hover:from-slate-800 hover:to-slate-800/60 border border-slate-700/60 hover:border-slate-500 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-slate-400">
                        <div class="flex items-center justify-between w-full">
                            <span class="inline-flex items-center justify-center p-1.5 rounded-lg bg-slate-700/50 text-slate-300 group-hover:scale-110 transition-transform">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                            <span class="text-[10px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-slate-700/50 text-slate-300">
                                Read Only
                            </span>
                        </div>
                        <div class="mt-2.5">
                            <p class="text-sm font-semibold text-white group-hover:text-slate-200 transition-colors">Viewer Login</p>
                            <p class="text-[11px] text-slate-400">Browse & inspect</p>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Divider -->
            <div class="relative flex items-center justify-center">
                <div class="w-full border-t border-slate-800"></div>
                <span class="px-3 text-xs uppercase tracking-wider text-slate-500 bg-slate-900/80 font-medium">
                    Or sign in with email
                </span>
                <div class="w-full border-t border-slate-800"></div>
            </div>

            <!-- Flash Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-medium text-slate-300 mb-1">
                        Work Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </div>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="doctor@jajalmedical.com"
                               class="block w-full pl-10 pr-3.5 py-2.5 bg-slate-800/70 border border-slate-700/80 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition @error('email') border-red-500/80 text-red-200 @enderror">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-xs font-medium text-slate-300">
                            Password
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-indigo-400 hover:text-indigo-300 transition">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               placeholder="••••••••••••"
                               class="block w-full pl-10 pr-3.5 py-2.5 bg-slate-800/70 border border-slate-700/80 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition @error('password') border-red-500/80 text-red-200 @enderror">
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
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
                               class="rounded bg-slate-800 border-slate-700 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-900">
                        <span class="ms-2 text-xs text-slate-400">Remember this device</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                            id="submitBtn"
                            class="w-full flex justify-center items-center py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-600 hover:from-indigo-500 hover:to-blue-500 shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-indigo-500 transition duration-150">
                        <span>Sign In</span>
                        <svg class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Bottom Disclaimer -->
            <div class="pt-2 text-center border-t border-slate-800/80">
                <p class="text-[11px] text-slate-500">
                    Clinical Device Portal • HIPAA dummy sandbox mode
                </p>
            </div>
        </div>
    </div>

    <!-- Script for 1-Click Role Login -->
    <script>
        function quickLogin(email, password) {
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
                <span>Logging in...</span>
            `;

            form.submit();
        }
    </script>
</x-guest-layout>
