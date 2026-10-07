<x-layouts.auth title="Iniciar sesión">
    <form method="POST" action="{{ route('login.store') }}" class="space-y-5"></form>
        <flux:card.header class="text-center">
            <flux:card.heading>Iniciar sesión</flux:card.heading>
            <flux:card.subheading>Ingresa tus credenciales</flux:card.subheading>
        </flux:card.header>

        <flux:card.body>
            <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                @csrf
                <flux:field>
                    <flux:input label="Correo electronico" type="email" name="email" :value="old('email')" required />
                </flux:field>

                <flux:field>
                    <flux:input label="Contraseña" type="password" name="password" required />
                </flux:field>
                @if ($errors->has('credentials'))
                    <div class="text-center text-red-500">
                        <flux:error name="credentials" />
                    </div>
                @endif
            
        </flux:card.body>
        
        <flux:card.footer>
            <flux:button type="submit" variant="primary" class="w-full">
                    Iniciar sesión
            </flux:button>
            </form>
            <flux:separator class="my-7" />

            <flux:text class="grid-2 text-center">
                ¿No tienes cuenta?
                <flux:link href="{{ route('register') }}">Regístrate</flux:link>
            </flux:text>
            <flux:text class="text-center">
                Continuar como
                <flux:link href="{{ route('dashboard') }}">invitado</flux:link>
            </flux:text>
        </flux:card.footer>
    </form>
</x-layouts.auth>
