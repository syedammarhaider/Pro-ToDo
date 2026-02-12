<!-- Update Profile Information Form -->
<form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('PATCH')

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email', $user->email)" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

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
        <x-primary-button>{{ __('Save') }}</x-primary-button>

        <action-message class="me-3" on="profile-updated">
            {{ __('Saved.') }}
        </action-message>
    </div>
</form>
