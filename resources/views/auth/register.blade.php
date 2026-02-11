<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-white mb-2">Full Name</label>
            <input id="name" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name">
            @error('name')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-2">Email Address</label>
            <input id="email" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email">
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
            <input id="password" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password">
            @error('password')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Confirm Password</label>
            <input id="password_confirmation" class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-white/80 hover:text-white underline transition-colors duration-200" href="{{ route('login') }}">
                Already registered?
            </a>

            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300 transform hover:scale-105">
                Create Account
            </button>
        </div>
    </form>
</x-guest-layout>
