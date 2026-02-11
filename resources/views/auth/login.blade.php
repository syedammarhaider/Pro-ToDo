<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-2">Email Address</label>
            <input id="email" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email">
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
            <input id="password" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-4 h-4 bg-white/10 border-white/20 rounded text-purple-600 focus:ring-purple-500 focus:ring-2" name="remember">
            <label for="remember_me" class="ml-2 block text-sm text-white/80">Remember me</label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-white/80 hover:text-white underline transition-colors duration-200" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif

            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 transform hover:scale-105">
                Log in
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-white/80">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-purple-400 hover:text-purple-300 underline transition-colors duration-200">
                    Create an account
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
