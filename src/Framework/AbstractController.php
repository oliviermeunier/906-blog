<?php 

namespace App\Framework;

use App\Service\Renderer\PHPRenderer;

abstract class AbstractController {

    protected $userSession;
    protected $flashbag;
    protected $renderer;

    public function __construct($renderer)
    {
        $this->userSession = new UserSession();
        $this->flashbag = new FlashBag();
        $this->renderer = $renderer;
    }

    public function addFlash(string $message)
    {
        $this->flashbag->addFlash($message);
    }

    public function render(string $template, array $data = [])
    {
        return $this->renderer->render($template, $data);
    }
}