import { Form, Head } from '@inertiajs/react';
import InputError from '@/components/input-error';
import PasswordInput from '@/components/password-input';
import { update } from '@/routes/password';
import { Button, Input } from '@pikoloo/darwin-ui';

type Props = {
    token: string;
    email: string;
    passwordRules: string;
};

export default function ResetPassword({ token, email, passwordRules }: Props) {
    return (
        <>
            <Head title="Restablecer contraseña" />

            <Form
                {...update.form()}
                transform={(data) => ({ ...data, token, email })}
                resetOnSuccess={['password', 'password_confirmation']}
            >
                {({ processing, errors }) => (
                    <div className="grid gap-6">
                        <div className="grid gap-2">
                            <label htmlFor="email" className="text-sm font-medium">
                                Correo electrónico
                            </label>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                autoComplete="email"
                                value={email}
                                className="mt-1 block w-full"
                                readOnly
                            />
                            <InputError message={errors.email} className="mt-2" />
                        </div>

                        <div className="grid gap-2">
                            <label htmlFor="password" className="text-sm font-medium">
                                Nueva contraseña
                            </label>
                            <PasswordInput
                                id="password"
                                name="password"
                                autoComplete="new-password"
                                className="mt-1 block w-full"
                                autoFocus
                                placeholder="Nueva contraseña"
                                passwordrules={passwordRules}
                            />
                            <InputError message={errors.password} />
                        </div>

                        <div className="grid gap-2">
                            <label htmlFor="password_confirmation" className="text-sm font-medium">
                                Confirmar contraseña
                            </label>
                            <PasswordInput
                                id="password_confirmation"
                                name="password_confirmation"
                                autoComplete="new-password"
                                className="mt-1 block w-full"
                                placeholder="Confirmar contraseña"
                                passwordrules={passwordRules}
                            />
                            <InputError message={errors.password_confirmation} className="mt-2" />
                        </div>

                        <Button
                            type="submit"
                            className="mt-4 w-full"
                            disabled={processing}
                            data-test="reset-password-button"
                        >
                            {processing ? 'Restableciendo...' : 'Restablecer contraseña'}
                        </Button>
                    </div>
                )}
            </Form>
        </>
    );
}

ResetPassword.layout = {
    title: 'Restablecer contraseña',
    description: 'Ingresa tu nueva contraseña a continuación',
};
