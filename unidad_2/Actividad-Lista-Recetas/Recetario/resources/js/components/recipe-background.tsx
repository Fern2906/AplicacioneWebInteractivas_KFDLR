
export default function RecipeBackground({ children }: { children: React.ReactNode }) {
    return (
        <div className="relative flex-1 overflow-hidden">
            <div className="absolute inset-0 bg-[#0f0d0b]" />

            <div
                className="absolute inset-0"
                style={{
                    background:
                        'radial-gradient(ellipse 80% 60% at 50% 0%, rgba(141, 55, 5, 0.28) 0%, transparent 70%), ' +
                        'radial-gradient(ellipse 60% 40% at 80% 100%, rgba(78, 35, 10, 0.15) 0%, transparent 60%)',
                }}
            />
            <div
                className="absolute inset-0 pointer-events-none"
                style={{
                    background:
                        'radial-gradient(ellipse 100% 100% at 50% 50%, transparent 55%, rgba(0,0,0,0.55) 100%)',
                }}
            />

            {/* Contenido */}
            <div className="relative z-10 h-full overflow-y-auto">
                {children}
            </div>
        </div>
    );
}
