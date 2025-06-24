<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-4 overflow-hidden">
        <!-- Animated background elements -->
        <div class="fixed inset-0 overflow-hidden">
            <!-- Floating movie clapperboards -->
            <div class="absolute left-10 top-1/4 animate-float-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                </svg>
            </div>
            <div class="absolute right-20 top-1/3 animate-float-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-yellow-400 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                </svg>
            </div>
            
            <!-- Film strip border effect -->
            <div class="absolute inset-0 border-8 border-dashed border-gray-800 opacity-10 pointer-events-none"></div>
            
            <!-- Subtle moving light effect -->
            <div class="absolute -left-64 -top-64 w-96 h-96 bg-red-600 rounded-full mix-blend-screen opacity-5 animate-light-sweep"></div>
        </div>

        <!-- Main card with pop-in animation -->
        <div class="w-full max-w-md bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-gray-700 relative z-10 transform transition-all duration-500 hover:shadow-red-900/30 animate-pop-in">
            <!-- Marquee with "now showing" effect -->
            <div class="bg-gradient-to-r from-red-900 to-red-800 py-5 px-6 relative overflow-hidden">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="h-full w-full bg-black opacity-10"></div>
                    <div class="absolute h-full w-20 bg-gradient-to-r from-transparent via-white/10 to-transparent animate-marquee-light"></div>
                </div>
                
                <div class="flex items-center justify-center space-x-3 relative z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-300 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                    <h1 class="text-3xl font-bold text-yellow-300 font-cinema tracking-wider animate-text-glow">CINETIX</h1>
                </div>
                <p class="text-center text-red-100 mt-2 text-sm tracking-wider flex items-center justify-center">
                    <span class="inline-block w-2 h-2 bg-red-400 rounded-full mr-2 animate-pulse"></span>
                    NOW SHOWING: MEMBER LOGIN
                    <span class="inline-block w-2 h-2 bg-red-400 rounded-full ml-2 animate-pulse"></span>
                </p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Session Status with fade-in -->
                <x-auth-session-status class="mb-4 animate-fade-in" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email with focus animation -->
                    <div class="space-y-2 group">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-300 group-focus-within:text-yellow-300 transition-colors" />
                        <div class="relative">
                            <x-text-input id="email" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:ring-red-500 focus:border-red-500 transition duration-300 pl-10" 
                                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-yellow-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 animate-fade-in" />
                    </div>

                    <!-- Password with focus animation -->
                    <div class="space-y-2 group">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-300 group-focus-within:text-yellow-300 transition-colors" />
                        <div class="relative">
                            <x-text-input id="password" class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:ring-red-500 focus:border-red-500 transition duration-300 pl-10"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 group-focus-within:text-yellow-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 animate-fade-in" />
                    </div>

                    <!-- Remember Me with hover effect -->
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center group">
                            <div class="relative">
                                <input id="remember_me" type="checkbox" class="sr-only peer">
                                <div class="w-10 h-5 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-5 peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-red-600"></div>
                            </div>
                            <span class="ms-2 text-sm text-gray-300 group-hover:text-yellow-300 transition-colors">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-400 hover:text-yellow-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-colors animate-pulse-once" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit button with hover animation -->
                    <div class="mt-6 group">
                        <x-primary-button class="w-full flex justify-center py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all duration-300 shadow-lg shadow-red-900/20 hover:shadow-red-900/40 transform group-hover:scale-[1.02]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Footer with signup link and film strip effect -->
            <div class="px-6 py-4 bg-gray-700/50 text-center border-t border-gray-700 relative overflow-hidden">
                <div class="absolute left-0 top-0 h-full w-8 bg-repeat-y bg-contain bg-center bg-film-strip opacity-10"></div>
                <div class="absolute right-0 top-0 h-full w-8 bg-repeat-y bg-contain bg-center bg-film-strip opacity-10"></div>
                <p class="text-sm text-gray-400 relative z-10">
                    New to Cinetix? 
                    <a href="{{ route('register') }}" class="font-medium text-yellow-300 hover:text-yellow-200 transition-colors underline-offset-4 hover:underline animate-pulse-once">
                        Create your free account
                    </a>
                </p>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap');
        .font-cinema {
            font-family: 'Orbitron', sans-serif;
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.6);
        }
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #374151 inset !important;
            -webkit-text-fill-color: white !important;
        }
        .bg-film-strip {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Cpath fill='%23ffffff' d='M0 0h8v32H0zm12 0h8v32h-8zm24 0h-8v32h8z'/%3E%3C/svg%3E");
        }
        
        /* Animations */
        @keyframes float-1 {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        @keyframes float-2 {
            0%, 100% { transform: translateY(0) rotate(5deg); }
            50% { transform: translateY(20px) rotate(-5deg); }
        }
        @keyframes marquee-light {
            0% { transform: translateX(-100%) skewX(-20deg); }
            100% { transform: translateX(100vw) skewX(-20deg); }
        }
        @keyframes light-sweep {
            0% { transform: translate(0, 0); }
            50% { transform: translate(50vw, 50vh); }
            100% { transform: translate(0, 0); }
        }
        @keyframes text-glow {
            0%, 100% { text-shadow: 0 0 8px rgba(255, 215, 0, 0.6); }
            50% { text-shadow: 0 0 16px rgba(255, 215, 0, 0.8); }
        }
        @keyframes pop-in {
            0% { opacity: 0; transform: scale(0.9) translateY(20px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-once {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .animate-float-1 { animation: float-1 8s ease-in-out infinite; }
        .animate-float-2 { animation: float-2 10s ease-in-out infinite; }
        .animate-marquee-light { animation: marquee-light 8s linear infinite; }
        .animate-light-sweep { animation: light-sweep 30s linear infinite; }
        .animate-text-glow { animation: text-glow 3s ease-in-out infinite; }
        .animate-pop-in { animation: pop-in 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        .animate-fade-in { animation: fade-in 0.5s ease-out forwards; }
        .animate-pulse-once { animation: pulse-once 2s ease-in-out infinite; }
    </style>
</x-guest-layout>