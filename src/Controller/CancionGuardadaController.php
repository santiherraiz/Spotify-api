<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuario;
use App\Entity\Cancion;
use Symfony\Component\Serializer\SerializerInterface;

class CancionGuardadaController extends AbstractController
{
    // GET /usuarios/{userId}/canciones-guardadas
    public function cancionesGuardadas(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('userId');
    
        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($id);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $canciones = $usuario->getCancion();
        
        $data = $serializer->serialize($canciones, 'json', ['groups' => ['cancion:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // PUT /usuarios/{userId}/canciones-guardadas/{cancionId}
    public function guardarCancion(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $cancionId = $request->get('cancionId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $cancion = $this->getDoctrine()
            ->getRepository(Cancion::class)
            ->find($cancionId);

        if (!$cancion) {
            return new Response('Canción no encontrada', 404);
        }

        $usuario->getCancion()->add($cancion);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Canción guardada correctamente', 200);
    }

    // DELETE /usuarios/{userId}/canciones-guardadas/{cancionId}
    public function eliminarCancionGuardada(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $cancionId = $request->get('cancionId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $cancion = $this->getDoctrine()
            ->getRepository(Cancion::class)
            ->find($cancionId);

        if (!$cancion) {
            return new Response('Canción no encontrada', 404);
        }

        $usuario->getCancion()->removeElement($cancion);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Canción eliminada de guardadas', 202);
    }
}
