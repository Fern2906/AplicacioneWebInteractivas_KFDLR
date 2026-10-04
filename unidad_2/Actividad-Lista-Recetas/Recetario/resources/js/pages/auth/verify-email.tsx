import { Form, Head } from '@inertiajs/react';
import TextLink from '@/components/text-link';
import { logout } from '@/routes';
import { send } from '@/routes/verification';
import { Button } from '@pikoloo/darwin-ui';

export default function VerifyEmail({ status }: { status?: string }) {
    return (
        <>
            <Head title="Verificar correo" />

            {status === 'verification-link-sent' && (
                <div className="mb-4 text-center text-sm font-medium text-green-600">
                    Se ha enviado un nuevo enlace de verificación al correo
                    que registraste.
                </div>
            )}

            <Form {...send.form()} className="space-y-6 text-center">
                {({ processing }) => (
                    <>
                        <Button disabled={processing} variant="secondary">
                            {processing
                                ? 'Enviando...'
                                : 'Reenviar correo de verificación'}
                        </Button>

                        <TextLink
                            href={logout()}
                            className="mx-auto block text-sm"
                        >
                            Cerrar sesión
                        </TextLink>
                    </>
                )}
            </Form>
        </>
    );
}

VerifyEmail.layout = {
    title: 'Verifica tu correo',
    description:
        'Por favor verifica tu correo haciendo clic en el enlace que te enviamos.',
};
