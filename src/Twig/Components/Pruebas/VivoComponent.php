<?php

namespace App\Twig\Components\Pruebas;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('pruebas_vivo', template: 'components/pruebas/vivo.html.twig')]
class VivoComponent
{
    use DefaultActionTrait;

    public function getRandomNumber(): int
    {
        return rand(0, 1000);
    }
}
