<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Testimonial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                        {{ $error }}
                    </div>
                    @endforeach
                @endif

                <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
                    @csrf

                    @method('PUT')

                    <!-- Nama otomatis dari user yang login -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="Auth::user()->name" readonly required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Message -->
                    <div class="mt-5">
                        <x-input-label for="message" :value="__('Message')" />
                        <x-text-input id="message" class="block mt-1 w-full" type="text" name="message" :value="old('message', $testimonial->message)" required autofocus autocomplete="message" />
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Edit Testimonial') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
