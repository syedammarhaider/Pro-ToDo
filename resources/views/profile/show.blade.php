<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">{{ __('Profile Information') }}</h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("View your account's profile information and email address.") }}
                        </p>
                    </header>

                    <div class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <div class="mt-1 block w-full text-gray-900">{{ $user->name }}</div>
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <div class="mt-1 block w-full text-gray-900">{{ $user->email }}</div>

                            @if ($user->email_verified_at)
                                <div>
                                    <p class="text-sm text-gray-600 mt-2">
                                        {{ __('Your email address is verified.') }}
                                    </p>
                                </div>
                            @else
                                <div>
                                    <p class="text-sm text-gray-600 mt-2">
                                        {{ __('Your email address is unverified.') }}
                                    </p>

                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf

                                        <div class="mt-2">
                                            <x-primary-button>
                                                {{ __('Resend Verification Email') }}
                                            </x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Edit Profile') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
