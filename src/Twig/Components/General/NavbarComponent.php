<?php

namespace App\Twig\Components\General;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'frontend/tiendaks/general/componentes/navbar_component.html.twig')]
class NavbarComponent
{
    public array $usuario = [];
    public array $subnavbar = [];
}