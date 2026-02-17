<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Playlist;
use App\Entity\Usuario;
use App\Entity\Cancion;
use App\Entity\AnyadeCancionPlaylist;
use Symfony\Component\Serializer\SerializerInterface;

class PlaylistController extends AbstractController
{
    // GET /usuarios/{userId}/playlists  y  POST /usuarios/{userId}/playlists
    public function playlists(Request $request, SerializerInterface $serializer): Response
    {
        if ($request->isMethod('GET')) {
            
            $id = $request->get('userId');
            
            $usuario = $this->getDoctrine()
                ->getRepository(Usuario::class)
                ->find($id);

            if (!$usuario) {
                return new Response('El usuario no existe', 404);
            }

            $usuarioId = $usuario->getId();

            $playlists = $this->getDoctrine()
                ->getRepository(Playlist::class)
                ->findBy(['usuario' => $usuarioId]);

            if (!$playlists) {
                return new Response('No se han encontrado playlists', 404);
            }

            $data = $serializer->serialize($playlists, 'json', [
                'groups' => ['playlist:read']
            ]);

            return new Response($data, 200, ['Content-Type' => 'application/json']);

        } else if ($request->isMethod('POST')) {

            $id = $request->get('userId');

            $usuario = $this->getDoctrine()
                ->getRepository(Usuario::class)
                ->find($id);

            if (!$usuario) {
                return new Response('El usuario no existe', 404);
            }

            $playlist = new Playlist();
            $playlist->setUsuario($usuario);
            $playlist->setFechaCreacion(new \DateTime());
            $playlist->setNumeroCanciones(0);
            
            $serializer->deserialize(
                $request->getContent(),
                Playlist::class,
                'json',
                [
                    'groups' => 'playlist:write',
                    'object_to_populate' => $playlist
                ]
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($playlist);
            $em->flush(); 

            $data = $serializer->serialize($playlist, 'json', [
                'groups' => ['playlist:read']
            ]);

            return new Response($data, 201, ['Content-Type' => 'application/json']);
        }

        return new Response("Método no permitido", 405);
    }

    // GET /playlists/{playlistId}
    public function playlistDetalle(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('playlistId');

        $playlist = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->find($id);

        if (!$playlist) {
            return new Response('Playlist no encontrada', 404);
        }

        $data = $serializer->serialize($playlist, 'json', ['groups' => ['playlist:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /playlists/{playlistId}/canciones  y  POST /playlists/{playlistId}/canciones
    public function playlistCanciones(Request $request, SerializerInterface $serializer): Response
    {
        $playlistId = $request->get('playlistId');

        $playlist = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->findOneBy(['id' => $playlistId]);

        if (!$playlist) {
            return new Response('Playlist no encontrada', 404);
        }

        if ($request->isMethod('GET')) {

            $canciones = $this->getDoctrine()
                ->getRepository(AnyadeCancionPlaylist::class)
                ->findBy(['playlist' => $playlist]);

            if (!$canciones) {
                return new Response('No se han encontrado canciones en esta playlist', 404);
            }

            $data = $serializer->serialize($canciones, 'json', ['groups' => ['playlist:canciones', 'cancion:read']]);
            return new Response($data, 200, ['Content-Type' => 'application/json']);

        } else if ($request->isMethod('POST')) {

            $dataRequest = json_decode($request->getContent(), true);

            $cancion = $this->getDoctrine()
                ->getRepository(Cancion::class)
                ->find($dataRequest['cancionId']);

            if (!$cancion) {
                return new Response('Canción no encontrada', 404);
            }

            $usuario = $this->getDoctrine()
                ->getRepository(Usuario::class)
                ->find($dataRequest['usuarioId']);

            if (!$usuario) {
                return new Response('Usuario no encontrado', 404);
            }

            $entrada = new AnyadeCancionPlaylist();
            $entrada->setPlaylist($playlist);
            $entrada->setCancion($cancion);
            $entrada->setUsuario($usuario);
            $entrada->setFechaAnyadida(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($entrada);
            $em->flush();

            $data = $serializer->serialize([
                'message' => 'Canción añadida a la playlist',
                'playlistId' => $playlist->getId(),
                'cancionId' => $cancion->getId()
            ], 'json');
            return new Response($data, 201, ['Content-Type' => 'application/json']);
        }

        return new Response("Método no permitido", 405);
    }

    // DELETE /playlists/{playlistId}/canciones/{cancionId}
    public function playlistCancionEliminar(Request $request, SerializerInterface $serializer): Response
    {
        $playlistId = $request->get('playlistId');
        $cancionId = $request->get('cancionId');

        $playlist = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->find($playlistId);

        if (!$playlist) {
            return new Response('Playlist no encontrada', 404);
        }

        $cancion = $this->getDoctrine()
            ->getRepository(Cancion::class)
            ->find($cancionId);

        if (!$cancion) {
            return new Response('Canción no encontrada', 404);
        }

        $entrada = $this->getDoctrine()
            ->getRepository(AnyadeCancionPlaylist::class)
            ->findOneBy(['playlist' => $playlist, 'cancion' => $cancion]);

        if (!$entrada) {
            return new Response('La canción no está en la playlist', 404);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($entrada);
        $em->flush();

        return new Response('Canción eliminada de la playlist', 202);
    }

    // GET /playlists
    public function playlistsPublicas(Request $request, SerializerInterface $serializer): Response
    {
        $playlists = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->findAll();

        if (!$playlists) {
            return new Response('No se han encontrado playlists', 404);
        }

        $data = $serializer->serialize($playlists, 'json', [
            'groups' => ['playlist:read']
        ]);

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }
}