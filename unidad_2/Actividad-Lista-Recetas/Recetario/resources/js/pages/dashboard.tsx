import { Sidebar, SearchInput, MultiSelect, Reveal, Button, Skeleton } from '@pikoloo/darwin-ui';
import { useState } from 'react';
import { useAppearance } from '@/hooks/use-appearance';
import { ChefHat, HomeIcon, Moon, Plus, Sun } from 'lucide-react';
import { Label } from '@radix-ui/react-dropdown-menu';

interface Categoria {
    id: number;
    nombre: string;
}

interface Dificultad {
    id: number;
    nombre: string;
}

interface DashboardProps {
    categorias: Categoria[];
    dificultades: Dificultad[];
}


export default function Dashboard({ categorias, dificultades}: DashboardProps) {

    const [active, setActive] = useState('Inicio');
    const [query, setQuery] = useState("");

    const categoryOptions = categorias.map((categoria) => ({
        label: categoria.nombre,
        value: categoria.id.toString(),
    }));

    const dificultOptions = dificultades.map((dificultad) => ({
        label: dificultad.nombre,
        value: dificultad.id.toString(),
    }));

    const [selectedCategory, setSelectedCategory] = useState<string[]>([]);
    const [selectedDificult, setSelectedDificult] = useState<string[]>([]);

    const { resolvedAppearance, updateAppearance } = useAppearance();

    const isDark = resolvedAppearance === 'dark';
    const items = [
        { label: 'Inicio', onClick: () => setActive('Inicio'), icon: HomeIcon },
        { label: 'Mis recetas', onClick: () => setActive('Mis recetas'), icon: ChefHat },
        { label: 'Nueva receta', onClick: () => setActive('Nueva receta'), icon: Plus},
        {label: isDark ? 'Modo claro' : 'Modo oscuro', onClick: () => updateAppearance(isDark ? 'light' : 'dark'), icon: isDark ? Sun : Moon, },
    ];

    return (
        <div className="flex h-screen min-h-screen">
            <Sidebar items={items} activeItem={active} onLogout={() => { } } collapsible glass />
            <main className="flex-1 align-items-center px-6 py-3">
                <Reveal type="fade" delay={0.2}>
                    <SearchInput placeholder="Buscar recetas..." value={query} onChange={(e) => setQuery(e.target.value)} />
                </Reveal>
                <div className="flex py-5 gap-2">
                    <Reveal type="fade" delay={0.2}>
                        <MultiSelect
                            value={selectedDificult}
                            onChange={setSelectedDificult}
                            options={dificultOptions}
                            placeholder="Selecciona una dificultad..."
                            className="w-50"
                            glass />
                    </Reveal>
                    <Reveal type="fade" delay={0.2}>
                        <MultiSelect
                            value={selectedCategory}
                            onChange={setSelectedCategory}
                            options={categoryOptions}
                            placeholder="Selecciona una categoria..."
                            className="w-50"
                            glass />
                    </Reveal>
                    <Reveal type="fade" delay={0.2} className="ml-auto">
                        <Button variant="primary">
                            <Plus className="h-4 w-4" />
                            Crear nueva receta
                        </Button>
                    </Reveal>
                </div>
                <div className="space-y-3">
                    <div className="flex items-center gap-3">
                        <Skeleton className="h-12 w-12 rounded-full" />
                        <div className="flex-1 space-y-2">
                            <Skeleton className="h-4 w-3/4" />
                            <Skeleton className="h-3 w-1/2" />
                        </div>
                    </div>
                    <Skeleton className="h-24 w-full rounded-lg" />
                </div>
            </main>
        </div>
    );
}
