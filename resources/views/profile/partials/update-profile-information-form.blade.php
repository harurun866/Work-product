<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="introduction" :value="__('introduction')" />
            <textarea id="introduction" class="block mt-1 w-full"

                name="introduction">{{old('introduction', $user->introduction)}}</textarea>

            <x-input-error :messages="$errors->get('introduction')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="genre" :value="__('genre')" />
            <x-text-input id="genre" name="genre" type="text" class="mt-1 block w-full" :value="old('genre', $user->genre)" />
            <x-input-error class="mt-2" :messages="$errors->get('genre')" />
        </div>

        <div>
            <x-input-label for="speciality" :value="__('speciality')" />
            <x-text-input id="speciality" name="speciality" type="text" class="mt-1 block w-full" :value="old('speciality', $user->speciality)" />
            <x-input-error class="mt-2" :messages="$errors->get('speciality')" />
        </div>

        <div>
            <x-input-label for="learning_style" :value="__('learning_style')" />
            <x-text-input id="learning_style" name="learning_style" type="text" class="mt-1 block w-full" :value="old('learning_style', $user->learning_style)" />
            <x-input-error class="mt-2" :messages="$errors->get('learning_style')" />
        </div>

        <div>
            <x-input-label for="year" :value="__('year')" />
            <x-text-input id="year" name="year" type="text" class="mt-1 block w-full" :value="old('year', $user->year)" />
            <x-input-error class="mt-2" :messages="$errors->get('year')" />
        </div>

        <div>
            <x-input-label for="skill" :value="__('skill')" />
            <x-text-input id="skill" name="skill" type="text" class="mt-1 block w-full" :value="old('skill', $user->skill)" />
            <x-input-error class="mt-2" :messages="$errors->get('skill')" />
        </div>

        <div>
            <x-input-label for="goal" :value="__('goal')" />
            <x-text-input id="goal" name="goal" type="text" class="mt-1 block w-full" :value="old('goal', $user->goal)" />
            <x-input-error class="mt-2" :messages="$errors->get('goal')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>