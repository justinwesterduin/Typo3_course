<?php
#Methods => ['POST'] testen, lijkt ook te werken
    return [
            'teaClick' => [
                'path' => '/module/tea',
                'target' => \TTN\Tea\Controller\BackendController::class . '::buttonClicked',
            ],
        ];