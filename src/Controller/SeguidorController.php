<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Usuario;
use App\Entity\Playlist;
use App\Entity\Artista;
use App\Entity\Album;
use App\Entity\Podcast;
use Symfony\Component\Serializer\SerializerInterface;

class SeguidorController extends AbstractController
{
    // GET /usuarios/{userId}/playlists-seguidas
    public function playlistsSeguidas(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('userId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($id);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $playlists = $usuario->getPlaylist();

        $data = [];
        foreach ($playlists as $playlist) {
            $data[] = [
                'id' => $playlist->getId(),
                'titulo' => $playlist->getTitulo(),
                'numeroCanciones' => $playlist->getNumeroCanciones(),
                'fechaCreacion' => $playlist->getFechaCreacion()->format('d-m-Y')
            ];
        }

        $data = $serializer->serialize($data, 'json');
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // PUT /usuarios/{userId}/playlists-seguidas/{playlistId}
    public function seguirPlaylist(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $playlistId = $request->get('playlistId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $playlist = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->find($playlistId);

        if (!$playlist) {
            return new Response('Playlist no encontrada', 404);
        }

        $usuario->getPlaylist()->add($playlist);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Playlist seguida correctamente', 200);
    }

    // DELETE /usuarios/{userId}/playlists-seguidas/{playlistId}
    public function dejarSeguirPlaylist(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $playlistId = $request->get('playlistId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $playlist = $this->getDoctrine()
            ->getRepository(Playlist::class)
            ->find($playlistId);

        if (!$playlist) {
            return new Response('Playlist no encontrada', 404);
        }

        $usuario->getPlaylist()->removeElement($playlist);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Has dejado de seguir la playlist', 202);
    }

    // GET /usuarios/{userId}/artistas-seguidos
    public function artistasSeguidos(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('userId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($id);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $artistas = $usuario->getArtista();

        $data = [];
        foreach ($artistas as $artista) {
            $data[] = [
                'id' => $artista->getId(),
                'nombre' => $artista->getNombre(),
                'imagen' => $artista->getImagen()
            ];
        }

        $data = $serializer->serialize($data, 'json');
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // PUT /usuarios/{userId}/artistas-seguidos/{artistaId}
    public function seguirArtista(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $artistaId = $request->get('artistaId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $artista = $this->getDoctrine()
            ->getRepository(Artista::class)
            ->find($artistaId);

        if (!$artista) {
            return new Response('Artista no encontrado', 404);
        }

        $usuario->getArtista()->add($artista);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Artista seguido correctamente', 200);
    }

    // DELETE /usuarios/{userId}/artistas-seguidos/{artistaId}
    public function dejarSeguirArtista(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $artistaId = $request->get('artistaId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $artista = $this->getDoctrine()
            ->getRepository(Artista::class)
            ->find($artistaId);

        if (!$artista) {
            return new Response('Artista no encontrado', 404);
        }

        $usuario->getArtista()->removeElement($artista);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Has dejado de seguir al artista', 202);
    }

    // GET /usuarios/{userId}/albums-seguidos
    public function albumsSeguidos(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('userId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($id);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $albums = $usuario->getAlbum();

        $data = [];
        foreach ($albums as $album) {
            $data[] = [
                'id' => $album->getId(),
                'titulo' => $album->getTitulo(),
                'imagen' => $album->getImagen(),
                'anyo' => $album->getAnyo()->format('Y')
            ];
        }

        $data = $serializer->serialize($data, 'json');
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // PUT /usuarios/{userId}/albums-seguidos/{albumId}
    public function seguirAlbum(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $albumId = $request->get('albumId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $album = $this->getDoctrine()
            ->getRepository(Album::class)
            ->find($albumId);

        if (!$album) {
            return new Response('Álbum no encontrado', 404);
        }

        $usuario->getAlbum()->add($album);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Álbum seguido correctamente', 200);
    }

    // DELETE /usuarios/{userId}/albums-seguidos/{albumId}
    public function dejarSeguirAlbum(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $albumId = $request->get('albumId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $album = $this->getDoctrine()
            ->getRepository(Album::class)
            ->find($albumId);

        if (!$album) {
            return new Response('Álbum no encontrado', 404);
        }

        $usuario->getAlbum()->removeElement($album);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Has dejado de seguir el álbum', 202);
    }

    // GET /usuarios/{userId}/podcasts-seguidos
    public function podcastsSeguidos(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('userId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($id);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $podcasts = $usuario->getPodcast();

        $data = [];
        foreach ($podcasts as $podcast) {
            $data[] = [
                'id' => $podcast->getId(),
                'titulo' => $podcast->getTitulo(),
                'imagen' => $podcast->getImagen(),
                'descripcion' => $podcast->getDescripcion()
            ];
        }

        $data = $serializer->serialize($data, 'json');
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // PUT /usuarios/{userId}/podcasts-seguidos/{podcastId}
    public function seguirPodcast(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $podcastId = $request->get('podcastId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $podcast = $this->getDoctrine()
            ->getRepository(Podcast::class)
            ->find($podcastId);

        if (!$podcast) {
            return new Response('Podcast no encontrado', 404);
        }

        $usuario->getPodcast()->add($podcast);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Podcast seguido correctamente', 200);
    }

    // DELETE /usuarios/{userId}/podcasts-seguidos/{podcastId}
    public function dejarSeguirPodcast(Request $request, SerializerInterface $serializer): Response
    {
        $userId = $request->get('userId');
        $podcastId = $request->get('podcastId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->find($userId);

        if (!$usuario) {
            return new Response('El usuario no existe', 404);
        }

        $podcast = $this->getDoctrine()
            ->getRepository(Podcast::class)
            ->find($podcastId);

        if (!$podcast) {
            return new Response('Podcast no encontrado', 404);
        }

        $usuario->getPodcast()->removeElement($podcast);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Has dejado de seguir el podcast', 202);
    }
}
