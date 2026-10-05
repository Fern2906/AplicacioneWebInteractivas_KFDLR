
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

            {/* Patrón SVG: cubiertos repetidos */}
            <div
                className="absolute inset-0 opacity-[0.045]"
                style={{
                    backgroundImage: `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23f5f0e8' fill-rule='nonzero'%3E%3C!-- Tenedor --%3E%3Crect x='13' y='8' width='2' height='14' rx='1'/%3E%3Crect x='17' y='8' width='2' height='14' rx='1'/%3E%3Crect x='15' y='18' width='2' height='20' rx='1'/%3E%3Crect x='11' y='8' width='8' height='2' rx='1'/%3E%3C!-- Cuchara --%3E%3Cellipse cx='40' cy='13' rx='4' ry='5'/%3E%3Crect x='39' y='17' width='2' height='24' rx='1'/%3E%3C!-- Cuchillo --%3E%3Crect x='63' y='8' width='3' height='30' rx='1.5'/%3E%3Cpath d='M63 8 Q60 14 63 20' stroke='%23f5f0e8' stroke-width='1.5' fill='none'/%3E%3C/g%3E%3C/svg%3E")`,
                    backgroundSize: '80px 80px',
                }}
            />

            {/* Viñeta en los bordes */}
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
