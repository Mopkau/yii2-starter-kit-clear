<?php
	return [
		'id'         => 'frontend' ,
		'basePath'   => dirname ( __DIR__ ) ,
		'components' => [
			'urlManager' => require ( __DIR__ . '/_urlManager.php' ) ,
			'cache'      => require ( __DIR__ . '/_cache.php' ) ,
			'view'       => [
				'theme' => [
					'basePath' => '@app/themes/' ,
					'baseUrl'  => '@web/themes/' ,
					'pathMap'  => [
						 '@app/views' => '@app/themes/bootstrap' ,
						//'@app/views' => '@app/themes/materialize' ,
						// '@app/views' => '@app/themes/clear',
					] ,
				] ,
			] ,

		] ,
	];
