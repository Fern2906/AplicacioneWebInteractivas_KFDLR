import {
    Sidebar, Button, Reveal, Card, CardContent, CardDescription,
    CardFooter, CardTitle, Textarea, Select, Upload, CardHeader,
    useToast, ToastProvider,
} from '@pikoloo/darwin-ui';
import { useEffect, useState } from 'react';
import { ChefHat, HomeIcon, Plus } from 'lucide-react';
import { router, useForm, usePage } from '@inertiajs/react';
import { dashboard, createRecipe } from '@/routes';
import RecipeBackground from '@/components/recipe-background';
import { Input } from '@/components/ui/input';
import InputError from '@/components/input-error';

interface Categoria  { id: number; nombre: string; }
interface Dificultad { id: number; nombre: string; }
interface Receta {
    id: number;
    titulo: string;
    ingredientes: string;
    pasos: string;
    nota: string | null;
    tiempo: number;
    imagen: string | null;
    categoria_id: number;
    dificultad_id: number;
}

interface EditRecipeProps {
    receta:       Receta;
    categorias:   Categoria[];
    dificultades: Dificultad[];
}

function EditRecipeInner({ receta, categorias, dificultades }: EditRecipeProps) {
    const { url } = usePage();
    const { flash } = usePage<{ flash: { success?: string; error?: string } }>().props;
    const { showToast } = useToast();

    useEffect(() => {
        if (flash?.success) showToast(flash.success, { type: 'success' });
        if (flash?.error)   showToast(flash.error,   { type: 'error'   });
    }, [flash]);

    const getActiveItem = (u: string) => {
        if (u.startsWith('/createRecipe')) return 'Nueva receta';
        return 'Inicio';
    };

    const { data, setData, post, processing, errors } = useForm({
        titulo:        receta.titulo,
        ingredientes:  receta.ingredientes,
        pasos:         receta.pasos,
        nota:          receta.nota ?? '',
        categoria_id:  receta.categoria_id.toString(),
        dificultad_id: receta.dificultad_id.toString(),
        tiempo:        receta.tiempo.toString(),
        imagen:        null as File | null,
        _method:       'PUT',
    });

    const categoryOptions = categorias.map(c  => ({ label: c.nombre, value: c.id.toString() }));
    const dificultOptions = dificultades.map(d => ({ label: d.nombre, value: d.id.toString() }));

    const items = [
        { label: 'Inicio',       onClick: () => router.visit(dashboard.url()),    icon: HomeIcon },
        { label: 'Nueva receta', onClick: () => router.visit(createRecipe.url()), icon: Plus     },
    ];

    const handleSubmit = (e: React.SubmitEvent) => {
        e.preventDefault();
        post(`/recipes/${receta.id}`, { forceFormData: true });
    };


    return (
        <div className="flex h-screen min-h-screen w-full">
            <Sidebar
                items={items}
                activeItem={getActiveItem(url)}
                onLogout={() => {}}
                collapsible
                glass
            />
            <RecipeBackground>
                <div className="py-6 px-6">
                    <Reveal type="fade" delay={0.1}>
                        <Card className="max-w-3xl mx-auto shadow-md" glass>
                            <CardHeader>
                                <CardTitle className="text-xl font-bold">Editar Receta</CardTitle>
                                <CardDescription>Modifica los campos y guarda los cambios.</CardDescription>
                            </CardHeader>

                            <form onSubmit={handleSubmit}>
                                <CardContent className="space-y-4">

                                    <div className="space-y-1.5">
                                        <label className="text-sm font-medium">Título de la receta</label>
                                        <Input
                                            type="text"
                                            value={data.titulo}
                                            onChange={e => setData('titulo', e.target.value)}
                                            placeholder="Ej. Tacos al Pastor"
                                        />
                                        <InputError message={errors.titulo} />
                                    </div>

                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div className="space-y-1.5">
                                            <label className="text-sm font-medium">Categoría</label>
                                            <Select
                                                type="single"
                                                value={data.categoria_id}
                                                onChange={(val: any) => setData('categoria_id', val?.target ? val.target.value : val)}
                                                options={categoryOptions}
                                                placeholder="Selecciona una categoría..."
                                                className="w-full"
                                            />
                                            <InputError message={errors.categoria_id} />
                                        </div>
                                        <div className="space-y-1.5">
                                            <label className="text-sm font-medium">Dificultad</label>
                                            <Select
                                                type="single"
                                                value={data.dificultad_id}
                                                onChange={(val: any) => setData('dificultad_id', val?.target ? val.target.value : val)}
                                                options={dificultOptions}
                                                placeholder="Selecciona dificultad..."
                                                className="w-full"
                                            />
                                            <InputError message={errors.dificultad_id} />
                                        </div>
                                    </div>

                                    <div className="space-y-1.5">
                                        <label className="text-sm font-medium">Tiempo (minutos)</label>
                                        <Input
                                            type="number"
                                            value={data.tiempo}
                                            onChange={e => setData('tiempo', e.target.value)}
                                            placeholder="Ej. 45"
                                            min={1}
                                        />
                                        <InputError message={errors.tiempo} />
                                    </div>

                                    <div className="space-y-1.5">
                                        <label className="text-sm font-medium">Ingredientes</label>
                                        <Textarea
                                            placeholder="Ej. 1/2 taza de arroz..."
                                            value={data.ingredientes}
                                            onChange={e => setData('ingredientes', e.target.value)}
                                            rows={4}
                                        />
                                        <InputError message={errors.ingredientes} />
                                    </div>

                                    <div className="space-y-1.5">
                                        <label className="text-sm font-medium">Pasos de preparación</label>
                                        <Textarea
                                            placeholder="Ej. 1. Agrega el aceite..."
                                            value={data.pasos}
                                            onChange={e => setData('pasos', e.target.value)}
                                            rows={4}
                                        />
                                        <InputError message={errors.pasos} />
                                    </div>

                                    <div className="space-y-1.5">
                                        <label className="text-sm font-medium">Notas (opcional)</label>
                                        <Textarea
                                            placeholder="Ej. Usar productos frescos..."
                                            value={data.nota}
                                            onChange={e => setData('nota', e.target.value)}
                                            rows={2}
                                        />
                                    </div>

                                </CardContent>

                                <CardFooter className="gap-2">
                                    <Button type="submit" variant="primary" loading={processing}>
                                        {processing ? 'Guardando...' : 'Guardar cambios'}
                                    </Button>
                                    <Button type="button" variant="secondary" onClick={() => router.visit('/dashboard')}>
                                        Cancelar
                                    </Button>
                                </CardFooter>
                            </form>
                        </Card>
                    </Reveal>
                </div>
            </RecipeBackground>
        </div>
    );
}

export default function EditRecipe(props: EditRecipeProps) {
    return (
        <ToastProvider>
            <EditRecipeInner {...props} />
        </ToastProvider>
    );
}
