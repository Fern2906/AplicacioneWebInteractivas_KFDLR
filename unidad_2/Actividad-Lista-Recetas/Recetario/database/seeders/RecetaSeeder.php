<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecetaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('recetas')->insert([
            [
                'titulo' => 'Pozole Rojo Tradicional',
                'tiempo' => 120,
                'ingredientes' => "1 kg de maíz pozolero precocido\n1 kg de carne de cerdo\n4 chiles guajillo\n2 chiles ancho\n1 cabeza de ajo\nLechuga, rábanos y limón",
                'pasos' => "1. Cocer el maíz con agua, cebolla y ajo.\n2. Agregar la carne de cerdo hasta que esté suave.\n3. Licuar los chiles cocidos con ajo y sal, y añadir al caldo.\n4. Hervir 20 minutos más y servir acompañado de lechuga y rábanos.",
                'nota' => 'Platillo tradicional mexicano muy reconfortante.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 2, // Intermedia
                'categoria_id' => 2, // Almuerzo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Huevos Rancheros',
                'tiempo' => 15,
                'ingredientes' => "2 huevos\n2 tortillas de maíz\n1/2 taza de salsa roja\nFrijoles refritos\nAceite y sal al gusto",
                'pasos' => "1. Freír ligeramente las tortillas en aceite caliente.\n2. Preparar los huevos estrellados o fritos.\n3. Colocar los huevos sobre las tortillas con frijoles y bañar con salsa caliente.",
                'nota' => 'Ideal para un desayuno lleno de energía.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 1, // Fácil
                'categoria_id' => 1, // Desayuno
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Enchiladas Potosinas',
                'tiempo' => 45,
                'ingredientes' => "Tortillas rojas con chile cascabel\nQueso fresco desmoronado\nCebolla picada\nCrema y aguacate para decorar",
                'pasos' => "1. Rellenar las tortillas con queso y cebolla.\n2. Doblar en forma de empleadas y freír ligeramente en comal o sartén.\n3. Servir con crema, queso espolvoreado y aguacate.",
                'nota' => 'Un clásico originario de San Luis Potosí.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 2, // Intermedia
                'categoria_id' => 2, // Almuerzo
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Pechuga de Pollo a la Plancha',
                'tiempo' => 20,
                'ingredientes' => "1 pechuga de pollo\n1 diente de ajo picado\nSal, pimienta y hierbas finas\n1 cucharada de aceite de oliva",
                'pasos' => "1. Sazonar la pechuga con ajo, sal, pimienta y hierbas.\n2. Calentar el aceite en una sartén a fuego medio-alto.\n3. Cocinar la pechuga 6-8 minutos por lado hasta que esté bien dorada.",
                'nota' => 'Opción saludable y ligera para la cena.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 1, // Fácil
                'categoria_id' => 3, // Cena
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Flan Napolitano',
                'tiempo' => 60,
                'ingredientes' => "1 lata de leche condensada\n1 lata de leche evaporada\n5 huevos\n1 cucharadita de vainilla\n1 taza de azúcar para el caramelo",
                'pasos' => "1. Fundir el azúcar en un molde hasta caramelizar.\n2. Licuar las leches, huevos y vainilla.\n3. Verter la mezcla en el molde y hornear a baño maría por 50 minutos.",
                'nota' => 'Dejar enfriar antes de desmoldar.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 2, // Intermedia
                'categoria_id' => 4, // Postres
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Agua de Horchata de Arroz',
                'tiempo' => 15,
                'ingredientes' => "1 taza de arroz\n1 ramita de canela\n1 lata de leche condensada\n1 litro de agua\nCanela en polvo",
                'pasos' => "1. Remojar el arroz y la canela en agua durante la noche.\n2. Licuar y colar perfectamente.\n3. Mezclar con el resto del agua, la leche condensada y servir con hielo.",
                'nota' => 'Refrescante para los días calurosos.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 1, // Fácil
                'categoria_id' => 5, // Bebida
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Tacos de Bistec',
                'tiempo' => 30,
                'ingredientes' => "500g de bistec de res picado\nTortillas de maíz\nCebolla y cilantro picados\nLimones y salsa verde",
                'pasos' => "1. Sazonar y cocinar la carne en una sartén caliente con un poco de aceite.\n2. Calentar las tortillas de maíz.\n3. Armar los tacos agregando carne, cebolla, cilantro y salsa al gusto.",
                'nota' => 'Una cena rápida y deliciosa.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 1, // Fácil
                'categoria_id' => 3, // Cena
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Pastel de Chocolate Húmedo',
                'tiempo' => 50,
                'ingredientes' => "2 tazas de harina\n1 taza de cacao en polvo\n2 tazas de azúcar\n1 taza de leche\n1 taza de aceite\n2 huevos",
                'pasos' => "1. Mezclar los ingredientes secos en un tazón grande.\n2. Añadir la leche, el aceite y los huevos batiendo constantemente.\n3. Hornear a 180°C por 35 minutos.",
                'nota' => 'Perfecto para celebraciones.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 2, // Intermedia
                'categoria_id' => 4, // Postres
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Limonada Mineral',
                'tiempo' => 10,
                'ingredientes' => "Jugo de 5 limones\n1 botella de agua mineral con gas\nAzúcar o jarabe al gusto\nHielo",
                'pasos' => "1. Mezclar el jugo de limón con el azúcar hasta disolver.\n2. Agregar abundante hielo en un vaso.\n3. Rellenar con el agua mineral y mezclar suavemente.",
                'nota' => 'Bebida burbujeante y muy refrescante.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 1, // Fácil
                'categoria_id' => 5, // Bebida
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titulo' => 'Mole Poblano con Pollo',
                'tiempo' => 90,
                'ingredientes' => "Piezas de pollo cocidas\n1 frasco de pasta de mole\nCaldo de pollo\nAjONjolí tostado",
                'pasos' => "1. Diluir la pasta de mole en caldo de pollo a fuego lento.\n2. Agregar las piezas de pollo cocidas y dejar hervir por 15 minutos para que absorban los sabores.\n3. Servir espolvoreando ajonjolí tostado por encima.",
                'nota' => 'Platillo complejo pero de sabor inigualable.',
                'imagen' => '',
                'usuario_id' => 1,
                'dificultad_id' => 3, // Difícil
                'categoria_id' => 2, // Almuerzo
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}