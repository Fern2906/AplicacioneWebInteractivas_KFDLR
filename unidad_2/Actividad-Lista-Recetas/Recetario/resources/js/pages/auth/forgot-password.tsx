import { Form, Head } from '@inertiajs/react';
import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { login } from '@/routes';
import { email } from '@/routes/password';
import { Button, Input } from '@pikoloo/darwin-ui';

export default function ForgotPassword({ status }: { status?: string }) {
    return (
        <>
            <Head title="Recuperar contraseña" />

            {status && (
                <div className="mb-4 text-center text-sm font-medium text-green-600">
                    {status}
                </div>
            )}

            <div className="space-y-6">
                <Form {...email.form()}>
                    {({ processing, errors }) => (
                        <>
                            <div className="grid gap-2">
                                <label htmlFor="email" className="text-sm font-medium">
                                    Correo electrónico
                                </label>
                                <Input
                                    id="email"
                                    type="email"
                                    name="email"
                                    autoComplete="off"
                                    autoFocus
                                    placeholder="correo@ejemplo.com"
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="my-6 flex items-center justify-start">
                                <Button
                                    className="w-full"
                                    disabled={processing}
                                    data-test="email-password-reset-link-button"
                                >
                                    {processing
                                        ? 'Enviando...'
                                        : 'Enviar enlace de recuperación'}
                                </Button>
                            </div>
                        </>
                    )}
                </Form>

                <div className="space-x-1 text-center text-sm text-muted-foreground">
                    <span>O vuelve a</span>
                    <TextLink href={login()}>iniciar sesión</TextLink>
                </div>
            </div>
        </>
    );
}

ForgotPassword.layout = {
    title: 'Recuperar contraseña',
    description: 'Ingresa tu correo para recibir un enlace de recuperación',
};
