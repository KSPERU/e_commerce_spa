<?php

namespace App\Twig\Components\Inicio;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'frontend/tiendaks/inicio/componentes/consiguelo_aqui_component.html.twig')]
class ConsigueloAquiComponent
{
    public array $contenido = [];
}