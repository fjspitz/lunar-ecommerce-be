<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateProductCsv extends Command
{
    protected $signature = 'generate:products {count=2000}';

    protected $description = 'Command description';

    public function handle()
    {
        // Obtenemos la cantidad desde el argumento, usando el default de 2000
        $count = (int) $this->argument('count');
        $filePath = storage_path('app/products.csv');

        $this->info("Generando $count productos en $filePath ...");

        // Usamos fputcsv para manejar la creación del CSV de forma eficiente
        try {
            $handle = fopen($filePath, 'w');

            // 1. Escribir la fila de cabecera (Header)
            fputcsv($handle, [
                'nombre',
                'descripcion',
                'marca',
                'categoria',
                'stock',
                'sku',
                'precio'
            ]);

            // Array de categorías de ejemplo
            //$categories = ['Electrónica', 'Ropa y Accesorios', 'Hogar y Jardín', 'Deportes', 'Alimentos y Bebidas', 'Juguetes', 'Libros'];
            //$categories = ProductT
            // $categories = [
            //     'Supermercado',
            //     'Tecnología',
            //     'Farmacia',
            //     'Compra internacional',
            //     'Hogar y muebles',
            //     'Herramientas',
            //     'Construcción',
            //     'Deportes y Fitness',
            //     'Mascotas',
            //     'Moda',
            //     'Accesorios para tu vehículo',
            //     'Para tu negocio',
            //     'Juegos y juguetes',
            //     'Bebés',
            //     'Belleza y cuidado personal',
            //     'Salud y equipamiento médico',
            //     'Servicios',
            // ];

            // 2. Generar y escribir las filas de productos
            for ($i = 0; $i < $count; $i++) {
                fputcsv($handle, [
                    fake()->productName(),
                    fake()->text(150), // Descripción de 150 caracteres
                    fake()->company(),
                    fake()->numberBetween(19, 35),
                    fake()->numberBetween(0, 500),
                    fake()->unique()->ean13(), // Un SKU único (código de barras)
                    fake()->randomFloat(2, 10, 1500) // Precio: 2 decimales, entre 10 y 1500
                ]);
            }

            fclose($handle);

            $this->info("¡Éxito! Archivo CSV generado correctamente.");
        } catch (\Exception $e) {
            $this->error("Se produjo un error: " . $e->getMessage());
            if (isset($handle) && is_resource($handle)) {
                fclose($handle);
            }
            return 1; // Retorna error
        }

        return 0; // Retorna éxito
    }
}
