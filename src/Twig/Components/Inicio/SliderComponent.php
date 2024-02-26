<?php

namespace App\Twig\Components\Inicio;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'frontend/tiendaks/inicio/componentes/slider_component.html.twig')]
class SliderComponent
{
    public array $imagenes = [];
}