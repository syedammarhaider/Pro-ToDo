@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Profile Settings</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Update your account information and manage your profile settings.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Update Profile Information -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Profile Information</h2>
                    </div>
                    
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Name
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', Auth::user()->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                required
                                autocomplete="name"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Email Address
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email', Auth::user()->email) }}"
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            
                            @if (Auth::user()->hasVerifiedEmail())
                                <p class="mt-2 text-sm text-green-600 dark:text-green-400 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Verified
                                </p>
                            @else
                                <p class="mt-2 text-sm text-yellow-600 dark:text-yellow-400">
                                    Your email is not verified.
                                    <button type="button" class="text-indigo-600 dark:text-indigo-400 hover:underline ml-1" onclick="document.getElementById('send-verification').submit();">
                                        Send verification email
                                    </button>
                                </p>
                                <form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="hidden">
                                    @csrf
                                </form>
                            @endif
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Save Changes
                            </button>
                            
                            @if (session('status') === 'profile-updated')
                                <p class="text-sm text-green-600 dark:text-green-400 animate-pulse">
                                    ✓ Saved
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900/50 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Update Password</h2>
                    </div>
                    
                    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Current Password
                            </label>
                            <input 
                                type="password" 
                                name="current_password" 
                                id="current_password" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                required
                                autocomplete="current-password"
                            >
                            @error('current_password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                New Password
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                required
                                autocomplete="new-password"
                            >
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Confirm New Password
                            </label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                required
                                autocomplete="new-password"
                            >
                        </div>
                        
                        <!-- Password Requirements -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password requirements:</p>
                            <ul class="text-xs text-gray-600 dark:text-gray-400 space-y-1">
                                <li class="flex items-center gap-2">
                                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                                    At least 8 characters long
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                                    Contains at least one uppercase letter
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                                    Contains at least one number
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-6 py-2.5 bg-yellow-600 hover:bg-yellow-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                Update Password
                            </button>
                            
                            @if (session('status') === 'password-updated')
                                <p class="text-sm text-green-600 dark:text-green-400 animate-pulse">
                                    ✓ Password updated
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar - Account Summary & Danger Zone -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Account Summary -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/50 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Account Summary</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Member since</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ Auth::user()->created_at->format('M d, Y') }}
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Account status</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400">
                                Active
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Email verified</span>
                            @if (Auth::user()->hasVerifiedEmail())
                                <span class="text-green-600 dark:text-green-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            @else
                                <span class="text-yellow-600 dark:text-yellow-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Danger Zone - Delete Account -->
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 border-2 border-red-200 dark:border-red-900/50">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-red-100 dark:bg-red-900/50 rounded-lg">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">Danger Zone</h3>
                    </div>
                    
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Once you delete your account, all of your data including todos, tasks, and settings will be permanently deleted. This action cannot be undone.
                    </p>
                    
                    <button 
                        type="button" 
                        onclick="document.getElementById('confirm-user-deletion').classList.remove('hidden')"
                        class="w-full px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                    >
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div id="confirm-user-deletion" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-900/75 transition-opacity" aria-hidden="true" onclick="document.getElementById('confirm-user-deletion').classList.add('hidden')"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/50 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            Delete Account
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Are you sure you want to delete your account? This will permanently remove your account and all associated data. This action cannot be undone.
                            </p>
                        </div>
                        
                        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4">
                            @csrf
                            @method('DELETE')
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Please enter your password to confirm
                                </label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="delete_password" 
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                >
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                                <button 
                                    type="submit" 
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm"
                                >
                                    Delete Account
                                </button>
                                <button 
                                    type="button" 
                                    onclick="document.getElementById('confirm-user-deletion').classList.add('hidden')"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm"
                                >
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('confirm-user-deletion').classList.add('hidden');
        }
    });

    // Auto-hide success messages after 3 seconds
    setTimeout(() => {
        document.querySelectorAll('.animate-pulse').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 3000);
</script>
@endpush
@endsection
