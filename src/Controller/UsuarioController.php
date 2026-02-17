<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Usuario;
use App\Entity\Premium;
use App\Entity\Free;
use App\Entity\Configuracion;
use App\Entity\Calidad;
use App\Entity\Idioma;
use App\Entity\TipoDescarga;

class UsuarioController extends AbstractController
{
    public function usuarios(Request $request, SerializerInterface $serializer): Response
    {
        if ($request->isMethod('GET')) {
            $usuarios = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findAll();

            $data = $serializer->serialize($usuarios, 'json', [
                'groups' => 'usuario:read'  
            ]);

            return new Response($data, 200, [
                'Content-Type' => 'application/json'
            ]);

        } elseif ($request->isMethod('POST')) {
            // leemos query parameter
            $premium = $request->query->get('premium');

            $data = $request->getContent();
            $usuario = $serializer->deserialize($data, Usuario::class, 'json',
                [
                    'groups' => 'usuario:write'
                ]
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);

            // dependiendo del usuario creamos free o premium
            if ($premium) {
                $premium = new Premium();
                $premium->setUsuario($usuario);
                $proximaRenovacion = (new \DateTime('today'))->modify('+1 month');
                $premium->setFechaRenovacion($proximaRenovacion);
                $entityManager->persist($premium);

            } else {
                $free = new Free();
                $free->setUsuario($usuario);
                $fechaRevision = (new \DateTime('today'))->modify('+1 month');
                $free->setFechaRevision($fechaRevision);
                $entityManager->persist($free);
            }

            // creamos configuración por defecto
            $configuracion = new Configuracion();
            $configuracion->setUsuario($usuario);
            $configuracion->setAutoplay(true);
            $configuracion->setNormalizacion(true);
            $configuracion->setAjuste(true);

            $calidad = $entityManager
                ->getRepository(Calidad::class)
                ->findOneBy(['id' => 1]);

            $idioma = $entityManager
                ->getRepository(Idioma::class)
                ->findOneBy(['id' => 1]);

            $tipoDescarga = $entityManager
                ->getRepository(TipoDescarga::class)
                ->findOneBy(['id' => 1]);

            $configuracion->setCalidad($calidad);
            $configuracion->setIdioma($idioma);
            $configuracion->setTipoDescarga($tipoDescarga);

            $entityManager->persist($configuracion);

            $entityManager->flush();

            $data = $serializer->serialize($usuario, 'json', [
                'groups' => 'usuario:read'
            ]);

            return new Response($data, 201, [
                'Content-Type' => 'application/json'
            ]);

        } else {
            return new Response('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    public function usuario(Request $request, SerializerInterface $serializer): Response
    {

        $id = $request->get('id');
        
        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);

        if ($request->isMethod('GET')) {
            $data = $serializer->serialize($usuario, 'json', [
                'groups' => 'usuario:read'
            ]);

            return new Response($data, 200, [
                'Content-Type' => 'application/json'
            ]);

        } elseif ($request->isMethod('PUT')) {
            
            if (!$usuario) {
                return new Response('Usuario no encontrado', 404);
            }

            $serializer->deserialize(
                $request->getContent(), 
                Usuario::class, 
                'json', 
                [
                    'groups' => 'usuario:write',
                    'object_to_populate' => $usuario
                ]
            );

            $this->getDoctrine()->getManager()->flush(); 

            $data = $serializer->serialize($usuario, 'json', ['groups' => 'usuario:read']);
            return new Response($data, 200, ['Content-Type' => 'application/json']);

        } elseif ($request->isMethod('DELETE')) {

            if (!$usuario) {
                return new Response('Usuario no encontrado', 404);
            }
            
            $entityManager = $this->getDoctrine()->getManager();

            $configuracion = $entityManager->getRepository(Configuracion::class)->findOneBy(['usuario' => $usuario]);
            $entityManager->remove($configuracion);
            
            $premium = $entityManager->getRepository(Premium::class)->findOneBy(['usuario' => $usuario]);
            if ($premium) {
                $entityManager->remove($premium);
            }

            $free = $entityManager->getRepository(Free::class)->findOneBy(['usuario' => $usuario]);
            if ($free) {
                $entityManager->remove($free);
            }

            $entityManager->remove($usuario);
            $entityManager->flush();
            
            return new Response('Usuario eliminado correctamente', 200);

            
        } else {
            return new Response('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }
}