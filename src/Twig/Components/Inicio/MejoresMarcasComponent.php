<?php

namespace App\Twig\Components\Inicio;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'frontend/tiendaks/inicio/componentes/mejores_marcas.html.twig')]
class MejoresMarcasComponent
{
    public array $contenido = [];
}