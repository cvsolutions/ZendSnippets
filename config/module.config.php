<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Slug' => 'ZfSnippets\Service\Slug'
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'Directories' => 'ZfSnippets\Controller\Plugin\Directories'
        )
    ),
    'view_helpers' => array(
        'invokables' => array(
            'TruncateHtml' => 'ZfSnippets\View\Helper\TruncateHtml'
        )
    ),
);