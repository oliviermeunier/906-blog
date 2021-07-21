<?php 

namespace App\Service\Renderer;

interface RendererInterface {
    public function render(string $template, array $data = []);
}