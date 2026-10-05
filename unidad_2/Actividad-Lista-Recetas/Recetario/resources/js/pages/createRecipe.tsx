import {
    Sidebar, Button, Reveal, Card, CardContent, CardDescription,
    CardFooter, CardTitle, Textarea, Select, Upload, CardHeader,
    useToast, ToastProvider,
} from '@pikoloo/darwin-ui';
import { useEffect } from 'react';
import { ChefHat, HomeIcon, Plus } from 'lucide-react';
import { router, useForm, usePage } from '@inertiajs/react';
import { dashboard, createRecipe } from '@/routes';
import RecipeBackground from '@/components/recipe-background';
import { Input } from '@/components/ui/input';
import InputError from '@/components/input-error';

interface Categoria  { id: number; nombre: string; }
interface Dificultad { id: number; nombre: string; }

interface CreateRecipeProps {
    categorias:   Categoria[];
    dificultades: Dificultad[];
}

function CreateRecipeInner({ categorias, dificultades }: CreateRecipeProps) {
    const { url } = usePage();
    const { flash } = usePage<{ flash: { success?: string; error?: string } }>().props;
    const { showToast } = useToast();

    useEffect(() => {
        if (flash?.success) showToast(flash.success, { type: 'success' });
        if (flash?.error)   showToast(flash.error,   { type: 'error'   });
    }, [flash]);

    const getActiveItem = (u: string) => {
        if (u.startsWith('/createRecipe')) return 'Nueva receta';
        if (u.startsWith('/mis-recetas'))  return 'Mis recetas';
        return 'Inicio';
    };

    const { data, setData, post, processing, errors, reset } = useForm({
        titulo:        '',
        ingredientes:  '',
        pasos:         '',
        nota:          '',
        categoria_id:  '',
        dificultad_id: '',
        tiempo:        '',
        imagen:        null as File | null,
    });

    const categoryOptions  = categorias.map(c  => ({ label: c.nombre,  value: c.id.toString() }));
    const dificultOptions  = dificultades.map(d => ({ label: d.nombre, value: d.id.toString() }));

    const items = [
        { label: 'Inicio',        onClick: () => router.visit(dashboard.url()),    icon: HomeIcon },
        { label: 'Mis recetas',   onClick: () => router.visit('/mis-recetas'),     icon: ChefHat  },
        { label: 'Nueva receta',  onClick: () => router.visit(createRecipe.url()), icon: Plus     },
    ];

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/recipes', {
            forceFormData: true,
            onSuccess: () => reset(),
        });
    };

    const handleUpload = async (uploadedFiles: File[]): Promise<string[]> => {
        if (uploadedFiles[0]) setData('imagen', uploadedFiles[0]);
        return uploadedFiles.map(f => URL.createObjectURL(f));
    };

    const [fileUrls, setFileUrls] = [
        data.imagen ? [URL.createObjectURL(data.imagen)] : [] as string[],
        (urls: string[]) => { if (!urls.length) setData('imagen', null); },
    ] as const;

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
                                <CardTitle className="text-xl font-bold">Crear Nueva Receta</CardTitle>
                                <CardDescription>Completa los campos para publicar tu plato.</CardDescription>
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
                                            placeholder="Ej. 1/2 taza de arroz, 2 dientes de ajo..."
                                            value={data.ingredientes}
                                            onChange={e => setData('ingredientes', e.target.value)}
                                            rows={4}
                                        />
                                        <InputError message={errors.ingredientes} />
                                    </div>

                                    <div className="space-y-1.5">
                                        <label className="text-sm font-medium">Pasos de preparación</label>
                                        <Textarea
                                            placeholder="Ej. 1. Agrega el aceite en una sartén..."
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

                                    <div className="space-y-1.5 p-4 border border-white/10 rounded-lg bg-white/5">
                                        <label className="text-sm font-medium">Imagen (opcional)</label>
                                        <Upload
                                            value={fileUrls}
                                            onChange={setFileUrls}
                                            onUpload={handleUpload}
                                            maxFiles={1}
                                            label="Arrastra tu imagen aquí"
                                        />
                                        <InputError message={errors.imagen} />
                                    </div>

                                </CardContent>

                                <CardFooter className="gap-2">
                                    <Button type="submit" variant="primary" loading={processing}>
                                        {processing ? 'Guardando...' : 'Crear receta'}
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

export default function CreateRecipe(props: CreateRecipeProps) {
    return (
        <ToastProvider>
            <CreateRecipeInner {...props} />
        </ToastProvider>
    );
}
