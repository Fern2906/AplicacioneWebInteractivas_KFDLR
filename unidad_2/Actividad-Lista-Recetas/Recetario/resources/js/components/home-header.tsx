import { Reveal } from "@pikoloo/darwin-ui";
import { LucideIcon } from "lucide-react"; 

type Props = {
    label: string;
    icon: LucideIcon;
};

export default function HomeHeader({ label, icon: IconComponent }: Props) {
    return (
        <Reveal 
            type="fade" 
            delay={0.1} 
            className="flex items-center gap-4 p-6 rounded-2xl bg-black/5 dark:bg-white/5 text-zinc-900 dark:text-zinc-100 shadow-sm transition-all duration-200 backdrop-blur-sm hover:bg-black/10 dark:hover:bg-white/10 ring-1 ring-inset ring-black/10 dark:ring-white/10"
        >
            <div className="p-3 rounded-xl">
                <IconComponent className="h-8 w-8" />
            </div>
            <div>
                <h1 className="text-2xl font-bold tracking-tight">
                    {label}
                </h1>
            </div>
        </Reveal>
    );
}