<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cancion;
use App\Entity\Artista;
use App\Entity\Album;
use App\Entity\Podcast;
use App\Entity\Capitulo;
use Symfony\Component\Serializer\SerializerInterface;

class CatalogoController extends AbstractController
{
    // GET /canciones
    public function canciones(Request $request, SerializerInterface $serializer): Response
    {
        $canciones = $this->getDoctrine()
            ->getRepository(Cancion::class)
            ->findAll();

        $data = $serializer->serialize($canciones, 'json', ['groups' => ['cancion:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /canciones/{cancionId}
    public function cancion(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('cancionId');

        $cancion = $this->getDoctrine()
            ->getRepository(Cancion::class)
            ->find($id);

        if (!$cancion) {
            return new Response('Canción no encontrada', 404);
        }

        $data = $serializer->serialize($cancion, 'json', ['groups' => ['cancion:read_detail', 'album:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /artistas
    public function artistas(Request $request, SerializerInterface $serializer): Response
    {
        $artistas = $this->getDoctrine()
            ->getRepository(Artista::class)
            ->findAll();

        $data = $serializer->serialize($artistas, 'json', ['groups' => ['artista:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /artistas/{artistaId}
    public function artista(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('artistaId');

        $artista = $this->getDoctrine()
            ->getRepository(Artista::class)
            ->find($id);

        if (!$artista) {
            return new Response('Artista no encontrado', 404);
        }

        $data = $serializer->serialize($artista, 'json', ['groups' => ['artista:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /artistas/{artistaId}/albums
    public function artistaAlbums(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('artistaId');

        $artista = $this->getDoctrine()
            ->getRepository(Artista::class)
            ->find($id);

        if (!$artista) {
            return new Response('Artista no encontrado', 404);
        }

        $albums = $this->getDoctrine()
            ->getRepository(Album::class)
            ->findBy(['artista' => $artista]);

        $data = $serializer->serialize($albums, 'json', ['groups' => ['album:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /artistas/{artistaId}/canciones
    public function artistaCanciones(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('artistaId');

        $artista = $this->getDoctrine()
            ->getRepository(Artista::class)
            ->find($id);

        if (!$artista) {
            return new Response('Artista no encontrado', 404);
        }

        $albums = $this->getDoctrine()
            ->getRepository(Album::class)
            ->findBy(['artista' => $artista]);

        $allCanciones = [];
        foreach ($albums as $album) {
            $canciones = $this->getDoctrine()
                ->getRepository(Cancion::class)
                ->findBy(['album' => $album]);
            
            foreach ($canciones as $cancion) {
                $allCanciones[] = $cancion;
            }
        }

        $data = $serializer->serialize($allCanciones, 'json', ['groups' => ['cancion:read_detail', 'album:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /albums
    public function albums(Request $request, SerializerInterface $serializer): Response
    {
        $albums = $this->getDoctrine()
            ->getRepository(Album::class)
            ->findAll();

        $data = $serializer->serialize($albums, 'json', ['groups' => ['album:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /albums/{albumId}
    public function album(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('albumId');

        $album = $this->getDoctrine()
            ->getRepository(Album::class)
            ->find($id);

        if (!$album) {
            return new Response('Álbum no encontrado', 404);
        }

        $data = $serializer->serialize($album, 'json', ['groups' => ['album:read', 'album:read_detail']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /albums/{albumId}/canciones
    public function albumCanciones(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('albumId');

        $album = $this->getDoctrine()
            ->getRepository(Album::class)
            ->find($id);

        if (!$album) {
            return new Response('Álbum no encontrado', 404);
        }

        $canciones = $this->getDoctrine()
            ->getRepository(Cancion::class)
            ->findBy(['album' => $album]);

        $data = $serializer->serialize($canciones, 'json', ['groups' => ['cancion:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /podcasts
    public function podcasts(Request $request, SerializerInterface $serializer): Response
    {
        $podcasts = $this->getDoctrine()
            ->getRepository(Podcast::class)
            ->findAll();

        $data = $serializer->serialize($podcasts, 'json', ['groups' => ['podcast:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /podcasts/{podcastId}
    public function podcast(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('podcastId');

        $podcast = $this->getDoctrine()
            ->getRepository(Podcast::class)
            ->find($id);

        if (!$podcast) {
            return new Response('Podcast no encontrado', 404);
        }

        $data = $serializer->serialize($podcast, 'json', ['groups' => ['podcast:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /podcasts/{podcastId}/capitulos
    public function podcastCapitulos(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('podcastId');

        $podcast = $this->getDoctrine()
            ->getRepository(Podcast::class)
            ->find($id);

        if (!$podcast) {
            return new Response('Podcast no encontrado', 404);
        }

        $capitulos = $this->getDoctrine()
            ->getRepository(Capitulo::class)
            ->findBy(['podcast' => $podcast]);

        $data = $serializer->serialize($capitulos, 'json', ['groups' => ['capitulo:read']]);
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    // GET /capitulos/{capituloId}
    public function capitulo(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('capituloId');

        $capitulo = $this->getDoctrine()
            ->getRepository(Capitulo::class)
            ->find($id);

        if (!$capitulo) {
            return new Response('Capítulo no encontrado', 404);
        }

        $data = $serializer->serialize(
            $capitulo,
            'json',
            ['groups' => ['capitulo:read', 'capitulo:read_detail']]
        );

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }
}
