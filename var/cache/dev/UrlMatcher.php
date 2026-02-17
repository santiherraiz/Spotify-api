<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/usuarios' => [[['_route' => 'usuarios', '_controller' => 'App\\Controller\\UsuarioController::usuarios'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/playlists' => [[['_route' => 'playlists_publicas', '_controller' => 'App\\Controller\\PlaylistController::playlistsPublicas'], null, ['GET' => 0], null, false, false, null]],
        '/canciones' => [[['_route' => 'catalogo_canciones', '_controller' => 'App\\Controller\\CatalogoController::canciones'], null, ['GET' => 0], null, false, false, null]],
        '/artistas' => [[['_route' => 'catalogo_artistas', '_controller' => 'App\\Controller\\CatalogoController::artistas'], null, ['GET' => 0], null, false, false, null]],
        '/albums' => [[['_route' => 'catalogo_albums', '_controller' => 'App\\Controller\\CatalogoController::albums'], null, ['GET' => 0], null, false, false, null]],
        '/podcasts' => [[['_route' => 'catalogo_podcasts', '_controller' => 'App\\Controller\\CatalogoController::podcasts'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/usuarios/([^/]++)(?'
                    .'|(*:190)'
                    .'|/(?'
                        .'|p(?'
                            .'|la(?'
                                .'|n(*:212)'
                                .'|ylists(?'
                                    .'|(*:229)'
                                    .'|\\-seguidas(?'
                                        .'|(*:250)'
                                        .'|/([^/]++)(?'
                                            .'|(*:270)'
                                        .')'
                                    .')'
                                .')'
                            .')'
                            .'|remium(*:288)'
                            .'|agos(*:300)'
                            .'|odcasts\\-seguidos(?'
                                .'|(*:328)'
                                .'|/([^/]++)(?'
                                    .'|(*:348)'
                                .')'
                            .')'
                        .')'
                        .'|c(?'
                            .'|onfiguracion(*:375)'
                            .'|anciones\\-guardadas(?'
                                .'|(*:405)'
                                .'|/([^/]++)(?'
                                    .'|(*:425)'
                                .')'
                            .')'
                        .')'
                        .'|a(?'
                            .'|rtistas\\-seguidos(?'
                                .'|(*:460)'
                                .'|/([^/]++)(?'
                                    .'|(*:480)'
                                .')'
                            .')'
                            .'|lbums\\-seguidos(?'
                                .'|(*:508)'
                                .'|/([^/]++)(?'
                                    .'|(*:528)'
                                .')'
                            .')'
                        .')'
                    .')'
                .')'
                .'|/suscripciones/([^/]++)(*:564)'
                .'|/p(?'
                    .'|laylists/([^/]++)(?'
                        .'|(*:597)'
                        .'|/canciones(?'
                            .'|(*:618)'
                            .'|/([^/]++)(*:635)'
                        .')'
                    .')'
                    .'|odcasts/([^/]++)(?'
                        .'|(*:664)'
                        .'|/capitulos(*:682)'
                    .')'
                .')'
                .'|/ca(?'
                    .'|nciones/([^/]++)(*:714)'
                    .'|pitulos/([^/]++)(*:738)'
                .')'
                .'|/a(?'
                    .'|rtistas/([^/]++)(?'
                        .'|(*:771)'
                        .'|/(?'
                            .'|albums(*:789)'
                            .'|canciones(*:806)'
                        .')'
                    .')'
                    .'|lbums/([^/]++)(?'
                        .'|(*:833)'
                        .'|/canciones(*:851)'
                    .')'
                .')'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        190 => [[['_route' => 'usuario', '_controller' => 'App\\Controller\\UsuarioController::usuario'], ['id'], ['GET' => 0, 'PUT' => 1, 'DELETE' => 2], null, false, true, null]],
        212 => [[['_route' => 'plan_actual', '_controller' => 'App\\Controller\\PlanController::plan_actual'], ['userId'], ['GET' => 0], null, false, false, null]],
        229 => [[['_route' => 'playlists_usuario', '_controller' => 'App\\Controller\\PlaylistController::playlists'], ['userId'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        250 => [[['_route' => 'playlists_seguidas', '_controller' => 'App\\Controller\\SeguidorController::playlistsSeguidas'], ['userId'], ['GET' => 0], null, false, false, null]],
        270 => [
            [['_route' => 'seguir_playlist', '_controller' => 'App\\Controller\\SeguidorController::seguirPlaylist'], ['userId', 'playlistId'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'dejar_seguir_playlist', '_controller' => 'App\\Controller\\SeguidorController::dejarSeguirPlaylist'], ['userId', 'playlistId'], ['DELETE' => 0], null, false, true, null],
        ],
        288 => [[['_route' => 'premium', '_controller' => 'App\\Controller\\PlanController::premium'], ['userId'], ['POST' => 0], null, false, false, null]],
        300 => [[['_route' => 'pagos', '_controller' => 'App\\Controller\\PlanController::pagos'], ['userId'], ['GET' => 0], null, false, false, null]],
        328 => [[['_route' => 'podcasts_seguidos', '_controller' => 'App\\Controller\\SeguidorController::podcastsSeguidos'], ['userId'], ['GET' => 0], null, false, false, null]],
        348 => [
            [['_route' => 'seguir_podcast', '_controller' => 'App\\Controller\\SeguidorController::seguirPodcast'], ['userId', 'podcastId'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'dejar_seguir_podcast', '_controller' => 'App\\Controller\\SeguidorController::dejarSeguirPodcast'], ['userId', 'podcastId'], ['DELETE' => 0], null, false, true, null],
        ],
        375 => [[['_route' => 'configuracion', '_controller' => 'App\\Controller\\ConfiguracionController::configuracion'], ['userId'], ['GET' => 0, 'PUT' => 1], null, false, false, null]],
        405 => [[['_route' => 'canciones_guardadas', '_controller' => 'App\\Controller\\CancionGuardadaController::cancionesGuardadas'], ['userId'], ['GET' => 0], null, false, false, null]],
        425 => [
            [['_route' => 'guardar_cancion', '_controller' => 'App\\Controller\\CancionGuardadaController::guardarCancion'], ['userId', 'cancionId'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'eliminar_cancion_guardada', '_controller' => 'App\\Controller\\CancionGuardadaController::eliminarCancionGuardada'], ['userId', 'cancionId'], ['DELETE' => 0], null, false, true, null],
        ],
        460 => [[['_route' => 'artistas_seguidos', '_controller' => 'App\\Controller\\SeguidorController::artistasSeguidos'], ['userId'], ['GET' => 0], null, false, false, null]],
        480 => [
            [['_route' => 'seguir_artista', '_controller' => 'App\\Controller\\SeguidorController::seguirArtista'], ['userId', 'artistaId'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'dejar_seguir_artista', '_controller' => 'App\\Controller\\SeguidorController::dejarSeguirArtista'], ['userId', 'artistaId'], ['DELETE' => 0], null, false, true, null],
        ],
        508 => [[['_route' => 'albums_seguidos', '_controller' => 'App\\Controller\\SeguidorController::albumsSeguidos'], ['userId'], ['GET' => 0], null, false, false, null]],
        528 => [
            [['_route' => 'seguir_album', '_controller' => 'App\\Controller\\SeguidorController::seguirAlbum'], ['userId', 'albumId'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'dejar_seguir_album', '_controller' => 'App\\Controller\\SeguidorController::dejarSeguirAlbum'], ['userId', 'albumId'], ['DELETE' => 0], null, false, true, null],
        ],
        564 => [[['_route' => 'suscripcion', '_controller' => 'App\\Controller\\PlanController::suscripcion'], ['id'], ['GET' => 0], null, false, true, null]],
        597 => [[['_route' => 'playlist_detalle', '_controller' => 'App\\Controller\\PlaylistController::playlistDetalle'], ['playlistId'], ['GET' => 0], null, false, true, null]],
        618 => [[['_route' => 'playlist_canciones', '_controller' => 'App\\Controller\\PlaylistController::playlistCanciones'], ['playlistId'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        635 => [[['_route' => 'playlist_cancion_eliminar', '_controller' => 'App\\Controller\\PlaylistController::playlistCancionEliminar'], ['playlistId', 'cancionId'], ['DELETE' => 0], null, false, true, null]],
        664 => [[['_route' => 'catalogo_podcast', '_controller' => 'App\\Controller\\CatalogoController::podcast'], ['podcastId'], ['GET' => 0], null, false, true, null]],
        682 => [[['_route' => 'catalogo_podcast_capitulos', '_controller' => 'App\\Controller\\CatalogoController::podcastCapitulos'], ['podcastId'], ['GET' => 0], null, false, false, null]],
        714 => [[['_route' => 'catalogo_cancion', '_controller' => 'App\\Controller\\CatalogoController::cancion'], ['cancionId'], ['GET' => 0], null, false, true, null]],
        738 => [[['_route' => 'catalogo_capitulo', '_controller' => 'App\\Controller\\CatalogoController::capitulo'], ['capituloId'], ['GET' => 0], null, false, true, null]],
        771 => [[['_route' => 'catalogo_artista', '_controller' => 'App\\Controller\\CatalogoController::artista'], ['artistaId'], ['GET' => 0], null, false, true, null]],
        789 => [[['_route' => 'catalogo_artista_albums', '_controller' => 'App\\Controller\\CatalogoController::artistaAlbums'], ['artistaId'], ['GET' => 0], null, false, false, null]],
        806 => [[['_route' => 'catalogo_artista_canciones', '_controller' => 'App\\Controller\\CatalogoController::artistaCanciones'], ['artistaId'], ['GET' => 0], null, false, false, null]],
        833 => [[['_route' => 'catalogo_album', '_controller' => 'App\\Controller\\CatalogoController::album'], ['albumId'], ['GET' => 0], null, false, true, null]],
        851 => [
            [['_route' => 'catalogo_album_canciones', '_controller' => 'App\\Controller\\CatalogoController::albumCanciones'], ['albumId'], ['GET' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
