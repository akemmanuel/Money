<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
  <label class="label label-text" for="email">Email</label>
  <input type="text" id="email" class="input" type="email" name="email" :value="old('email')" required autofocus  />
</div>

            <div class="mt-4">
            <label class="label label-text" for="password">Passwort</label>
            <input id="password" class="input" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center gap-1">
  <input type="checkbox" class="checkbox" id="defaultCheckbox1" name="remember"/>
  <label class="label label-text text-base" for="defaultCheckbox1">Remember me</label>
</div>


            <div class="flex items-center justify-end mt-4 gap-1">
                @if (Route::has('password.request'))
                    <a class="link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <button class="btn btn-primary">Login</button>

            </div>
        </form>

        @if (JoelButcher\Socialstream\Socialstream::show())
            <x-socialstream />
        @endif
    </x-authentication-card>
</x-guest-layout>
