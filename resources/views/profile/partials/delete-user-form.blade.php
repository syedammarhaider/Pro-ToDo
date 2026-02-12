<!-- Delete Account Form -->
<form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
    @csrf
    @method('DELETE')

    <div>
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mt-6 flex justify-end">
        <x-danger-button>{{ __('Delete Account') }}</x-danger-button>
    </div>
</form>
