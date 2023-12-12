<?php

namespace App\DataFixtures;

use App\Entity\Producto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $productoData = [
            //Manzana, Categoria, Cantidad, Precio
            ['Manzana', 'Fruta', 3, 26],
            ['Pantalon', 'Ropa', 2, 30],
            ['Pera', 'Fruta', 4, 40],
        ];
        foreach ($productoData as $data) {
            $producto = new Producto();
            $producto->setNombre($data[0]);
            $producto->setCategoria($data[1]);
            $producto->setCantidad($data[2]);
            $producto->setPrecio($data[3]);
            $manager->persist($producto);
        }
        $manager->flush();
    }
}
