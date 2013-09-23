<?php
/**
 * 
 * @package ZfSnippets
 */
return array(
    'controllers' => array(
        'invokables' => array(
            'ZfSnippets\Controller\ZfSnippets' => 'ZfSnippets\Controller\ZfSnippetsController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'zfsnippets' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/zfsnippets[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'ZfSnippets\Controller\ZfSnippets',
                        'action'     => 'index',
                        'action'     => 'search',
                        'action'     => 'recent',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'zfsnippets' => __DIR__ . '/../view',
        ),
    ),
);
?>
