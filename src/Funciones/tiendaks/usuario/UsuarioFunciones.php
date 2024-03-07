<?php

namespace App\Funciones\tiendaks\usuario;

use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\Usuario\usuarioRepository;
use Doctrine\ORM\Mapping\Id;
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
            // $usuario = $this->usuarioRepository->findOneBy(['id' => 2]);

        }catch(Exception $e){
            echo 'Error al buscar el usuario en la base de datos: ' . $e->getMessage();
        }
        
        return $usuario;
    }

    public function obtenerUsuarioVista(int $id)
    {
        try{
            $usuario = $this->usuarioRepository->findOneBy([
                'id' => $id
            ]);
            $datos[] = [
                'id' => $usuario->getId(),
                'u_nombres' => $usuario->getUNombres(),
                'u_apepat' => $usuario->getUApepat(),
                'u_apemat' => $usuario->getUApemat(),
                'u_dni' => $usuario->getUDni(),
                'u_telefono' => $usuario->getUTelefono(),
                'u_correo' => $usuario->getUCorreo(),
            ];

        }catch(Exception $e){
            echo 'Error al buscar el usuario en la base de datos: ' . $e->getMessage();
        }
        
        return $datos;
    }

    private function verificarUsuarioSesion(){
        $user = $this->security->getUser();
        if ($user === null) {
            return null;
        }
        return $user;
    }

    public function accesoPerfilPropio(int $id)
    {
        $user = $this->verificarUsuarioSesion();
        if ($user === null) {
            return null;
        }
        try{
            $usuario = $this->usuarioRepository->findOneBy([
                'u_correo' => $user->getUserIdentifier()
            ]);
            if ($usuario->getId() == $id) {
                return ['success' => true];
            }else {
                return ['success' => false];
            }
        }catch(Exception $e){
            echo 'Error al buscar el usuario en la base de datos: ' . $e->getMessage();
        }
    }
}