<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Usuario;
use App\Entity\Premium;
use App\Entity\Free;
use App\Entity\Suscripcion;
use App\Entity\Pago;
use App\Entity\TarjetaCredito;
use App\Entity\Paypal;
use App\Entity\FormaPago;
use Symfony\Component\Serializer\SerializerInterface;

class PlanController extends AbstractController
{
    // GET /usuarios/{userId}/plan
    public function plan_actual(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('userId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);

        if (!$usuario) {
            return new Response('Usuario no encontrado', 404);
        }

        $premium = $this->getDoctrine()->getRepository(Premium::class)->findOneBy(['usuario' => $usuario]);

        // if ($premium) {
        //     $data = $serializer->serialize($premium, 'json', [
        //         'groups' => ['plan:read', 'usuario:read']
        //     ]);

        //     return new Response($data, 200, [
        //         'Content-Type' => 'application/json'
        //     ]);
        // }

        if ($premium) {
            $data = [
                'plan' => 'premium',
                'detalles' => [
                    'id usuario' => $premium->getUsuario()->getId(),
                    'usuario' => $premium->getUsuario()->getUsername(),
                    'fecha_renovacion' => $premium->getFechaRenovacion()->format('d-m-y')
                ]
            ];

            $data = $serializer->serialize($data, 'json');
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        }

        $free = $this->getDoctrine()->getRepository(Free::class)->findOneBy(['usuario' => $usuario]);

        if ($free) {
            // $data = $serializer->serialize($free, 'json', [
            //     'groups' => ['plan:read', 'usuario:read']
            // ]);

            // return new Response($data, 200, [
            //     'Content-Type' => 'application/json'
            // ]);

            $data = [
                'plan' => 'free',
                'detalles' => [
                    'id usuario' => $free->getUsuario()->getId(),
                    'usuario' => $free->getUsuario()->getUsername(),
                    'fecha_revision' => $free->getFechaRevision()->format('d-m-y'),
                    'tiempo_publicidad' => $free->getTiempoPublicidad()
                ]
            ];

            $data = $serializer->serialize($data, 'json');
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        }

        return new Response('Plan no encontrado', 404);
    }

    // POST /usuarios/{userId}/premium
    public function premium(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('userId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);
            
        if (!$usuario) {
            return new Response('Usuario no encontrado', 404);
        }

        $free = $this->getDoctrine()->getRepository(Free::class)->findOneBy(['usuario' => $usuario]);
        $em = $this->getDoctrine()->getManager();
        
        if ($free) {
            // Eliminar plan Free
            $em->remove($free);
            $em->flush();

            // Crear plan Premium
            $premium = new Premium();
            $premium->setUsuario($usuario);
            $fechaRenovacion = new \DateTime();
            $fechaRenovacion->modify('+1 month');
            $premium->setFechaRenovacion($fechaRenovacion);
            
            $em->persist($premium);
            $em->flush();

            $data = $serializer->serialize([
                'message' => 'Plan actualizado a Premium',
                'plan' => 'premium',
                'fecha_renovacion' => $premium->getFechaRenovacion()->format('d-m-Y')
            ], 'json');
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        }

        $premium = $this->getDoctrine()->getRepository(Premium::class)->findOneBy(['usuario' => $usuario]);
        
        if ($premium) {
            // Renovar Premium existente (actualizar fecha)
            $fechaRenovacion = new \DateTime();
            $fechaRenovacion->modify('+1 month');
            $premium->setFechaRenovacion($fechaRenovacion);
            
            $em->flush();

            $data = $serializer->serialize([
                'message' => 'Plan Premium renovado',
                'plan' => 'premium',
                'fecha_renovacion' => $premium->getFechaRenovacion()->format('d-m-Y')
            ], 'json');
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        }

        // TODO: poner un pago para renovar/comprar suscripción
        
        return new Response('No se ha podido procesar la solicitud', 400);
    }

    // GET /usuarios/{userId}/pagos
    public function pagos(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('userId');

        $usuario = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findOneBy(['id' => $id]);

        if (!$usuario) {
            return new Response('Usuario no encontrado', 404);
        }

        $free = $this->getDoctrine()
            ->getRepository(Free::class)
            ->findOneBy(['usuario' => $usuario]);

        $premium = $this->getDoctrine()
            ->getRepository(Premium::class)
            ->findOneBy(['usuario' => $usuario]);

        if ($free) {
            return new Response('El usuario no tiene pagos porque está en el plan gratuito', 200, [
                'Content-Type' => 'application/json'
            ]);

        } elseif ($premium) {
            $suscripcion = $this->getDoctrine()
                ->getRepository(Suscripcion::class)
                ->findOneBy(['premiumUsuario' => $premium]);
            
            $data = $serializer->serialize($suscripcion, 'json', [
                'groups' => ['suscripcion:read', 'pago:read']
            ]);

            // return new Response($data, 200, [
            //     'Content-Type' => 'application/json'
            // ]);

            
            $data = $serializer->serialize([
                'id' => $id,
                'fechaInicio' => $suscripcion->getFechaInicio()->format('d-m-Y'),
                'fechaFin' => $suscripcion->getFechaFin()->format('d-m-Y')
            ], 'json');
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        } else {
            return new Response('El usuario no tiene plan', 200, [
                'Content-Type' => 'application/json'
            ]);
        }
    }

    // GET /suscripciones/{id}
    public function suscripcion(Request $request, SerializerInterface $serializer): Response
    {
        $id = $request->get('id');

        $suscripcion = $this->getDoctrine()
            ->getRepository(Suscripcion::class)
            ->findOneBy(['id' => $id]);
        //     ->find($id);

        // if (!$suscripcion) {
        //     return new Response('Suscripción no encontrada', 404);
        // }

        $pago = $this->getDoctrine()
            ->getRepository(Pago::class)
            ->findOneBy(['suscripcion' => $suscripcion]);

        $responseData = [
            'suscripcion' => [
                'id' => $suscripcion->getId(),
                'fecha_inicio' => $suscripcion->getFechaInicio() ? $suscripcion->getFechaInicio()->format('d-m-Y') : null,
                'fecha_fin' => $suscripcion->getFechaFin() ? $suscripcion->getFechaFin()->format('d-m-Y') : null,
            ],
            'pago' => null
        ];

        if ($pago) {
            $formaPago = $pago->getFormaPago();
            
            $detallePago = null;
            if ($formaPago) {
                $tarjeta = $this->getDoctrine()
                    ->getRepository(TarjetaCredito::class)
                    ->findOneBy(['formaPago' => $formaPago]);

                if ($tarjeta) {
                    $detallePago = [
                        'tipo' => 'tarjeta',
                        'numero_tarjeta' => $tarjeta->getNumeroTarjeta(),
                        'mes_caducidad' => $tarjeta->getMesCaducidad(),
                        'anyo_caducidad' => $tarjeta->getAnyoCaducidad(),
                    ];
                } else {
                    $paypal = $this->getDoctrine()
                        ->getRepository(Paypal::class)
                        ->findOneBy(['formaPago' => $formaPago]);
                    
                    if ($paypal) {
                        $detallePago = [
                            'tipo' => 'paypal',
                            'username_paypal' => $paypal->getUsernamePaypal(),
                        ];
                    }
                }
            }

            $responseData['pago'] = [
                'numero_orden' => $pago->getNumeroOrden(),
                'fecha' => $pago->getFecha() ? $pago->getFecha()->format('d-m-Y') : null,
                'total' => $pago->getTotal(),
                'forma_pago' => $formaPago ? [
                    'id' => $formaPago->getId(),
                    'detalle' => $detallePago
                ] : null
            ];
        }

        $data = $serializer->serialize($responseData, 'json');
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }
}