import {
    Sidebar, SearchInput, MultiSelect, Reveal, Button,
    Card, CardContent, CardFooter, CardTitle, Badge,
    useToast, ToastProvider, OverlayProvider,
    Dialog, DialogContent, DialogHeader,
    DialogTitle, DialogDescription, DialogFooter, DialogClose,
} from '@pikoloo/darwin-ui';
import { useEffect, useState } from 'react';
import { HomeIcon, Plus, Pencil, Trash2, Eye, UtensilsCrossed, CookingPot, ChefHat } from 'lucide-react';
import { Link, router, usePage } from '@inertiajs/react';
import { dashboard, createRecipe } from '@/routes';
import RecipeBackground from '@/components/recipe-background';
import HomeHeader from '@/components/home-header';

interface Categoria  { id: number; nombre: string; }
interface Dificultad { id: number; nombre: string; }
interface Receta {
    id: number;
    titulo: string;
    tiempo: number;
    categoria:  { id: number; nombre: string } | null;
    dificultad: { id: number; nombre: string } | null;
    imagen: string | null;
}

interface DashboardProps {
    categorias:   Categoria[];
    dificultades: Dificultad[];
    recetas:      Receta[];
    filters:      { search?: string; categoria_id?: string; dificultad_id?: string };
    flash?:       { success?: string; error?: string };
}

function DashboardInner({ categorias, dificultades, recetas, filters }: DashboardProps) {
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

    const [search,      setSearch]      = useState(filters.search       ?? '');
    const [catFilter,   setCatFilter]   = useState<string[]>(
        Array.isArray(filters.categoria_id) 
            ? filters.categoria_id 
            : filters.categoria_id ? [filters.categoria_id] : []
    );
    const [dificFilter, setDificFilter] = useState<string[]>(
        Array.isArray(filters.dificultad_id) 
            ? filters.dificultad_id 
            : filters.dificultad_id ? [filters.dificultad_id] : []
    );
    const [deleteId,    setDeleteId]    = useState<number | null>(null);

    const applyFilters = (
        s    = search,
        cats = catFilter,
        difs = dificFilter,
    ) => {
        router.get('/dashboard', {
            search:        s         || undefined,
            categoria_id:  cats.length > 0 ? cats :  undefined,
            dificultad_id: difs.length > 0 ? difs : undefined,
        }, { preserveState: true, replace: true });
    };

    const handleDelete = () => {
        if (!deleteId) return;
        router.delete(`/recipes/${deleteId}`, {
            onFinish: () => setDeleteId(null),
        });
    };
    
    const handleLogout = () => {
        router.post('/logout');
    }

    const categoryOptions  = categorias.map(c  => ({ label: c.nombre,  value: c.id.toString() }));
    const dificultOptions  = dificultades.map(d => ({ label: d.nombre, value: d.id.toString() }));

    const items = [
        { label: 'Inicio',       onClick: () => router.visit(dashboard.url()),    icon: HomeIcon },
        { label: 'Nueva receta', onClick: () => router.visit(createRecipe.url()), icon: Plus     },
    ];

    return (
        <div className="flex h-screen min-h-screen">
            <Sidebar
                items={items}
                activeItem={getActiveItem(url)}
                onLogout={handleLogout}
                collapsible
                glass
            />
            <RecipeBackground>
                <div className="py-6 px-6 space-y-5">
                    <HomeHeader label='Bienvenido a tu recetario' icon={ChefHat}/>
                    <Reveal type="fade" delay={0.1}>
                        <div className="flex gap-3 items-center">
                            <div className="flex-1">
                                <SearchInput
                                    placeholder="Buscar recetas..."
                                    value={search}
                                    onChange={e => setSearch(e.target.value)}
                                    onKeyDown={(e: React.KeyboardEvent) => {
                                        if (e.key === 'Enter') applyFilters();
                                    }}
                                />
                            </div>
                            <Link href={createRecipe.url()}>
                                <Button variant="primary">
                                    <Plus className="h-4 w-4" />
                                    Nueva receta
                                </Button>
                            </Link>
                        </div>
                    </Reveal>

                    <Reveal type="fade" delay={0.15}>
                        <div className="flex gap-3 flex-wrap">
                            <MultiSelect
                                value={catFilter}
                                onChange={cats => { setCatFilter(cats); applyFilters(search, cats, dificFilter); }}
                                options={categoryOptions}
                                placeholder="Categoría..."
                                className="w-52"
                                glass
                            />
                            <MultiSelect
                                value={dificFilter}
                                onChange={difs => { setDificFilter(difs); applyFilters(search, catFilter, difs); }}
                                options={dificultOptions}
                                placeholder="Dificultad..."
                                className="w-52"
                                glass
                            />
                            {(catFilter.length > 0 || dificFilter.length > 0 || search) && (
                                <Button
                                    variant="secondary"
                                    onClick={() => {
                                        setSearch(''); setCatFilter([]); setDificFilter([]);
                                        router.get('/dashboard', {}, {preserveState: true, replace: true });
                                    }}
                                >
                                    Limpiar filtros
                                </Button>
                            )}
                        </div>
                    </Reveal>

                    {recetas.length === 0 ? (
                        <Reveal type="fade" delay={0.2}>
                            <div className="flex flex-col items-center justify-center gap-4 py-24 text-white/40">
                                <UtensilsCrossed className="w-16 h-16" />
                                <p className="text-lg font-medium">Aún no tienes recetas</p>
                                <p className="text-sm">Crea tu primera receta usando el botón de arriba.</p>
                            </div>
                        </Reveal>
                    ) : (
                        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            {recetas.map((receta, i) => (
                                <Reveal key={receta.id} type="fade" delay={0.05 * i}>
                                    <Card glass className="flex flex-col h-full">
                                        {receta.imagen && (
                                            <div className="h-40 overflow-hidden rounded-t-xl">
                                                <img
                                                    src={`/storage/${receta.imagen}`}
                                                    alt={receta.titulo}
                                                    className="w-full h-full object-cover"
                                                />
                                            </div>
                                        )}
                                        <CardContent className="flex-1 pt-4 space-y-2">
                                            <CardTitle className="text-base font-semibold leading-snug">
                                                {receta.titulo}
                                            </CardTitle>
                                            <div className="flex gap-2 flex-wrap">
                                                {receta.categoria && (
                                                    <Badge variant="secondary">
                                                        {receta.categoria.nombre}
                                                    </Badge>
                                                )}
                                                {receta.dificultad && (
                                                    <Badge variant={receta.dificultad?.nombre === 'Fácil' ? 'success' : receta.dificultad?.nombre === 'Intermedia' ? 'warning' : 'destructive'}>
                                                        {receta.dificultad.nombre}
                                                    </Badge>
                                                )}
                                            </div>
                                        </CardContent>
                                        <CardFooter className="gap-2 pt-2">
                                            <Button
                                                variant="secondary"
                                                size="sm"
                                                onClick={() => router.visit(`/recipes/${receta.id}`)}
                                            >
                                                <Eye className="h-3.5 w-3.5" />
                                                Ver
                                            </Button>
                                            <Button
                                                variant="secondary"
                                                size="sm"
                                                onClick={() => router.visit(`/recipes/${receta.id}/edit`)}
                                            >
                                                <Pencil className="h-3.5 w-3.5" />
                                                Editar
                                            </Button>
                                            <Button
                                                variant="destructive"
                                                size="sm"
                                                onClick={() => setDeleteId(receta.id)}
                                            >
                                                <Trash2 className="h-3.5 w-3.5" />
                                                Eliminar
                                            </Button>
                                        </CardFooter>
                                    </Card>
                                </Reveal>
                            ))}
                        </div>
                    )}
                </div>

                <Dialog open={deleteId !== null} onOpenChange={open => { if (!open) setDeleteId(null); }}>
                    <DialogContent>
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

export default function Dashboard(props: DashboardProps) {
    return (
        <OverlayProvider>
            <ToastProvider>
                <DashboardInner {...props} />
            </ToastProvider>
        </OverlayProvider>
    );
}
