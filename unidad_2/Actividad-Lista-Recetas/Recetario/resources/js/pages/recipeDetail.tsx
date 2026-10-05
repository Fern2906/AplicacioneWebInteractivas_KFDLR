import RecipeBackground from '@/components/recipe-background';
import { createRecipe, dashboard } from '@/routes';
import { router, usePage } from '@inertiajs/react';
import {
    Sidebar, Reveal, Card, CardContent, Badge,
    Button, Accordion, AccordionContent,
    AccordionItem, AccordionTrigger,
    ToastProvider, OverlayProvider,
    Dialog, DialogContent, DialogHeader, DialogTitle,
    DialogDescription, DialogFooter, DialogClose,
} from '@pikoloo/darwin-ui';
import { ArrowLeft, ChefHat, Clock, HomeIcon, Pencil, Plus, Trash2 } from 'lucide-react';
import { useState } from 'react';

interface Receta {
    id: number;
    titulo: string;
    ingredientes: string;
    pasos: string;
    nota: string | null;
    tiempo: number;
    imagen: string | null;
    categoria:  { id: number; nombre: string } | null;
    dificultad: { id: number; nombre: string } | null;
}

interface RecipeDetailProps {
    receta: Receta;
}

function RecipeDetailInner({ receta }: RecipeDetailProps) {
    const { url } = usePage();
    const [confirmDelete, setConfirmDelete] = useState(false);

    const getActiveItem = (u: string) => {
        if (u.startsWith('/createRecipe')) return 'Nueva receta';
        if (u.startsWith('/mis-recetas'))  return 'Mis recetas';
        return 'Inicio';
    };

    const items = [
        { label: 'Inicio',       onClick: () => router.visit(dashboard.url()),    icon: HomeIcon },
        { label: 'Nueva receta', onClick: () => router.visit(createRecipe.url()), icon: Plus     },
    ];

    const handleDelete = () => {
        router.delete(`/recipes/${receta.id}`, {
            onSuccess: () => router.visit('/dashboard'),
        });
    };

    const toLines = (text: string) =>
        text.split('\n').map(l => l.trim()).filter(Boolean);

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
                <div className="py-6 px-6 max-w-6xl mx-auto space-y-6">

                    <Reveal type="fade" delay={0.05}>
                        <Button variant="ghost" size="sm" onClick={() => router.visit('/dashboard')}>
                            <ArrowLeft className="h-4 w-4 mr-1" />
                            Volver
                        </Button>
                    </Reveal>

                    <Reveal type="fade" delay={0.15}>
                        <Card glass>
                            <CardContent className="pt-5 space-y-3">
                                <h1 className="text-2xl font-bold text-white">{receta.titulo}</h1>

                                <div className="flex flex-wrap gap-2 items-center">
                                    {receta.dificultad && (
                                        <Badge variant={receta.dificultad?.nombre === 'Fácil' ? 'success' : receta.dificultad?.nombre === 'Intermedia' ? 'warning' : 'destructive'}>
                                            {receta.dificultad?.nombre}
                                        </Badge>
                                    )}
                                    {receta.categoria && (
                                        <Badge variant="info">{receta.categoria.nombre}</Badge>
                                    )}
                                    <div className="flex items-center gap-1 text-sm text-white/50">
                                        <Clock className="h-3.5 w-3.5" />
                                        <span>{receta.tiempo} min</span>
                                    </div>
                                </div>

                                <div className="flex gap-2 pt-1">
                                    <Button
                                        variant="secondary"
                                        size="sm"
                                        onClick={() => router.visit(`/recipes/${receta.id}/edit`)}
                                    >
                                        <Pencil className="h-3.5 w-3.5 mr-1" />
                                        Editar
                                    </Button>
                                    <Button
                                        variant="destructive"
                                        size="sm"
                                        onClick={() => setConfirmDelete(true)}
                                    >
                                        <Trash2 className="h-3.5 w-3.5 mr-1" />
                                        Eliminar
                                    </Button>
                                </div>
                            </CardContent>
                        </Card>
                    </Reveal>

                    <Reveal type="fade" delay={0.2}>
                        <Accordion type="multiple" defaultValue={['ingredientes', 'pasos']}>
                            <AccordionItem value="ingredientes">
                                <AccordionTrigger className="text-white font-semibold">
                                    Ingredientes
                                </AccordionTrigger>
                                <AccordionContent>
                                    <ul className="space-y-1.5 pt-1">
                                        {toLines(receta.ingredientes).map((line, i) => (
                                            <li key={i} className="flex gap-2 text-sm text-white/80">
                                                <span className="text-amber-400 mt-0.5">•</span>
                                                {line}
                                            </li>
                                        ))}
                                    </ul>
                                </AccordionContent>
                            </AccordionItem>

                            <AccordionItem value="pasos">
                                <AccordionTrigger className="text-white font-semibold">
                                    Preparación
                                </AccordionTrigger>
                                <AccordionContent>
                                    <ol className="space-y-3 pt-1">
                                        {toLines(receta.pasos).map((step, i) => (
                                            <li key={i} className="flex gap-3 text-sm text-white/80">
                                                <span className="flex-shrink-0 w-6 h-6 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center text-xs font-bold">
                                                    {i + 1}
                                                </span>
                                                {step}
                                            </li>
                                        ))}
                                    </ol>
                                </AccordionContent>
                            </AccordionItem>
                            {receta.nota && (
                                <AccordionItem value="notas">
                                    <AccordionTrigger className="text-white font-semibold">
                                        Notas
                                    </AccordionTrigger>
                                    <AccordionContent>
                                        <p className="text-sm text-white/70 pt-1">{receta.nota}</p>
                                    </AccordionContent>
                                </AccordionItem>
                            )}
                        </Accordion>
                    </Reveal>
                </div>

                <Dialog open={confirmDelete} onOpenChange={setConfirmDelete}>
                    <DialogContent glass>
                        <DialogHeader>
                            <DialogTitle>¿Eliminar receta?</DialogTitle>
                            <DialogDescription>
                                Esta acción es permanente y no se puede deshacer.
                            </DialogDescription>
                        </DialogHeader>
                        <DialogFooter>
                            <DialogClose asChild>
                                <Button variant="secondary">Cancelar</Button>
                            </DialogClose>
                            <Button variant="destructive" onClick={handleDelete}>
                                Sí, eliminar
                            </Button>
                        </DialogFooter>
                    </DialogContent>
                </Dialog>

            </RecipeBackground>
        </div>
    );
}

export default function RecipeDetail(props: RecipeDetailProps) {
    return (
        <OverlayProvider>
            <ToastProvider>
                <RecipeDetailInner {...props} />
            </ToastProvider>
        </OverlayProvider>
    );
}
