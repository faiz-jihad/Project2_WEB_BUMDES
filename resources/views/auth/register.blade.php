<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 dark:bg-gray-900">
        <!-- Card -->
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 sm:p-8">
            <!-- Header -->
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 text-center mb-4">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" class="mb-1" />
                    <x-text-input id="name"
                        class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="mb-1" />
                    <x-text-input id="email"
                        class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4 relative" style="display:block;">
                    <x-input-label for="password" :value="__('Password')" class="mb-1" />
                    <div style="position: relative;">
                        <x-text-input id="password"
                            class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                            type="password" name="password" required autocomplete="new-password" />
                        <!-- Eye SVG Button -->
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none"
                            aria-label="Toggle password visibility">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4 relative">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-1" />
                    <x-text-input id="password_confirmation"
                        class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        const password = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');
        togglePassword.addEventListener('click', () => {
            if (password.type === 'password') {
                password.type = 'text';
                // Ganti ke mata tertutup SVG
                eyeIcon.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.271-3.284M6.343 6.343A9.969 9.969 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.969 9.969 0 01-1.722 2.875M3 3l18 18" />`;
            } else {
                password.type = 'password';
                // Kembali ke mata terbuka SVG
                eyeIcon.innerHTML =
                    `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
            }
        });
    </script>
</x-guest-layout>
</div>
</div>

<hr class="mt-4 bg-light">
<div class="text-center small text-light">
    &copy; {{ date('Y') }} Bumdes Madusari. All rights reserved.
</div>
</div>
</footer>
