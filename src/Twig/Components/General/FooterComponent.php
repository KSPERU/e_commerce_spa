<?php

namespace App\Twig\Components\General;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'frontend/tiendaks/general/componentes/footer_component.html.twig')]
class FooterComponent
{
    public array $contenido = [];
}