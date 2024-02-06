<?php

namespace App\Funciones\tiendaks\usuario;

use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\Usuario\usuarioRepository;
use Exception;

class UsuarioFunciones
{
    private $usuarioRepository;
    private $security;

    public function __construct(Security $security, usuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->security = $security;
    }

        

    public function obtenerUsuario()
    {
        $user = $this->verificarUsuarioSesion();
        if ($user === null) {
            return null;
        }
        try{
            $usuario = $this->usuarioRepository->findOneBy([
                'u_correo' => $user->getUserIdentifier()
            ]);
            // $usuario = $this->usuarioRepository->findOneBy([
            //     'id' => 1
            // ]);

        }catch(Exception $e){
            echo 'Error al buscar el usuario en la base de datos: ' . $e->getMessage();
        }
        
        return $usuario;
    }

    private function verificarUsuarioSesion(){
        $user = $this->security->getUser();
        if ($user === null) {
            return null;
        }
        return $user;
    }

}