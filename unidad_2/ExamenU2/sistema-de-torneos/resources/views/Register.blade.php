<x-layouts.auth title="Crear cuenta">
    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        <flux:card.header size="lg" class="text-center">
            <flux:card.heading>Registrarse</flux:card.heading>
            <flux:card.subheading>Ingresa tus datos</flux:card.subheading>
        </flux:card.header>
            @csrf
        <flux:card.body>
            <flux:field>
                <flux:input label="Nombre" type="text" name="name" :value="old('name')" required autofocus />
            </flux:field>
            <flux:field>
                <flux:input label="Correo electrónico" type="email" name="email" required />
            </flux:field>
            <flux:field>
                <flux:input label="Contraseña" type="password" name="password" required />
            </flux:field>
            <flux:field>
                <flux:input label="Confirmar contraseña" type="password" name="password_confirmation" required />
            </flux:field>
        </flux:card.body>    
        <flux:card.footer>
            <flux:button type="submit" variant="primary" class="w-full">
                Registrarse
            </flux:button>
            <flux:separator class="my-4" />
            <flux:text class="text-center text-sm">
                ¿Ya tienes cuenta?
                <flux:link href="{{ route('login') }}">Inicia sesión</flux:link>
            </flux:text>
        </flux:card.footer>
    </form>
</x-layouts.auth>
