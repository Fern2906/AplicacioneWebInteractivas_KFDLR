import { Head, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';
import { Button, Input } from '@pikoloo/darwin-ui';
import React from 'react';
import { DotLottieReact } from '@lottiefiles/dotlottie-react';


type Props = {
    status?: string;
    canResetPassword: boolean;
};

export default function Login({ status }: Props) {
    const { data, setData, post, processing, errors } = useForm({
        correo: '',
        contrasena: '',
    });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/login');
    };

    return (
        <>
            <Head title="Iniciar sesión" />

            <form onSubmit={submit} className="flex flex-col gap-6">
                <div className="grid gap-6">
                    <div className="grid gap-2">
                        <label htmlFor="correo" className="text-sm font-medium">
                            Correo electrónico
                        </label>
                        <Input
                            id="correo"
                            type="email"
                            name="correo"
                            value={data.correo}
                            onChange={(e) => setData('correo', e.target.value)}
                            required
                            autoFocus
                            autoComplete="email"
                            placeholder="correo@ejemplo.com"
                        />
                        <InputError message={errors.correo} />
                    </div>

                    <div className="grid gap-2">
                        <label htmlFor="contrasena" className="text-sm font-medium">
                            Contraseña
                        </label>
                        <Input
                            id="contrasena"
                            type="password"
                            name="contrasena"
                            value={data.contrasena}
                            onChange={(e) => setData('contrasena', e.target.value)}
                            required
                            autoComplete="current-password"
                            placeholder="Contraseña"
                        />
                        <InputError message={errors.contrasena} />
                    </div>

                    <Button
                        type="submit"
                        className="mt-4 w-full"
                        disabled={processing}
                    >
                        {processing ? 'Iniciando...' : 'Iniciar sesión'}
                    </Button>
                </div>
            </form>

            {status && (
                <div className="mb-4 text-center text-sm font-medium text-green-600">
                    {status}
                </div>
            )}
        </>
    );
}

Login.layout = {
    title: 'Iniciar sesión',
    description: 'Ingresa tu correo y contraseña para continuar',
};
