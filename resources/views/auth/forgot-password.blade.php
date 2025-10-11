<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 dark:bg-gray-900">
        <!-- Card -->
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 sm:p-8">
            <!-- Header -->
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 text-center mb-4">Forgot Password</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-6">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="mb-1" />
                    <x-text-input id="email" class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="w-full">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Back to Login -->
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                    {{ __('Kembali Masuk') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
