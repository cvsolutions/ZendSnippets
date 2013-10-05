<?php
return array(
	'service_manager'=>array(
        'factories' => array(
            'Slug' => 'ZfSnippets\Service\Slug'
        ),
    ),
    'view_helpers' => array(
        'invokables'=> array(
            'TruncateHtml' => 'ZfSnippets\View\Helper\TruncateHtml'   
        )
    ),
);