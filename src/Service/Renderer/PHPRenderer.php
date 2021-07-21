<?php 

namespace App\Service\Renderer;

class PHPRenderer implements RendererInterface {

    public function render(string $template, array $data = [])
    {
        /*
            [
                'articles' => [ 0 => ['title' => 'toto, etc]]
            ]

            => $articles
        */
          
        extract($data);

        // Démarrage de la tamporisation de sortie
        ob_start();

        require '../templates/base.phtml';

        return ob_get_clean();
    }
}