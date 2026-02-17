<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Usuario;
use App\Entity\Configuracion;
use App\Entity\Calidad;
use App\Entity\Idioma;
use App\Entity\TipoDescarga;
use Symfony\Component\Serializer\SerializerInterface;

class ConfiguracionController extends AbstractController
{
    // GET /usuarios/{userId}/configuracion y PUT /usuarios/{userId}/configuracion
    public function configuracion(Request $request, SerializerInterface $serializer): Response
    {
        if ($request->isMethod('GET')) {

            $id = $request->get('userId');

            $usuario = $this->getDoctrine()
                ->getRepository(Usuario::class)
                ->findOneBy(['id' => $id]);

            if (!$usuario) {
                return new Response('El usuario no existe', 404);
            }

            $configuracion = $this->getDoctrine()
                ->getRepository(Configuracion::class)
                ->findOneBy(['usuario' => $usuario]);

            if (!$configuracion) {
                return new Response('La configuración no existe', 404);
            }

            $data = $serializer->serialize($configuracion, 'json', [
                'groups' => 'configuracion:read'
            ]);

            return new Response($data, 200, [
                'Content-Type' => 'application/json'
            ]);
        }

        if ($request->isMethod('PUT')) {

            $id = $request->get('userId');
            $usuario = $this->getDoctrine()->getRepository(Usuario::class)->find($id);

            if (!$usuario) {
                return new Response('El usuario no existe', 404);
            }

            $configuracion = $this->getDoctrine()
                ->getRepository(Configuracion::class)
                ->findOneBy(['usuario' => $usuario]);

            if (!$configuracion) {
                return new Response('La configuración no existe', 404);
            }

            // 1. Leemos el contenido como array para extraer los IDs de las relaciones
            $dataRequest = json_decode($request->getContent(), true);

            // 2. Actualizamos las relaciones manualmente si vienen en el JSON
            if ($dataRequest['calidad']) {
                $calidad = $this->getDoctrine()->getRepository(Calidad::class)->find($dataRequest['calidad']);
                if ($calidad) $configuracion->setCalidad($calidad);
            }
            if ($dataRequest['idioma']) {
                $idioma = $this->getDoctrine()->getRepository(Idioma::class)->find($dataRequest['idioma']);
                if ($idioma) $configuracion->setIdioma($idioma);
            }
            if ($dataRequest['tipoDescarga']) {
                $tipoDescarga = $this->getDoctrine()->getRepository(TipoDescarga::class)->find($dataRequest['tipoDescarga']);
                if ($tipoDescarga) $configuracion->setTipoDescarga($tipoDescarga);
            }

            // 3. Usamos el serializer para el resto de campos (booleans como autoplay, ajuste, etc.)
            // Ignoramos las relaciones para que no den problemas
            $serializer->deserialize(
                $request->getContent(), 
                Configuracion::class, 
                'json', 
                [
                    'groups' => 'configuracion:write',
                    'object_to_populate' => $configuracion,
                    'ignored_attributes' => ['calidad', 'idioma', 'tipoDescarga'] // IMPORTANTE
                ]
            );

            $this->getDoctrine()->getManager()->flush();

            $data = $serializer->serialize($configuracion, 'json', [
                'groups' => 'configuracion:read'
            ]);

            return new Response($data, 200, ['Content-Type' => 'application/json']);    
        }

        return new Response('Método no permitido', 405);        
    }
}