<?php

class View
{
    private string $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    public function render(string $viewName): void
    {
        $viewPath = $this->buildViewPath($viewName);

        $content = $this->renderViewFromTemplate($viewPath);
        $title = $this->title;

        require(MAIN_VIEW_PATH);
    }

    private function renderViewFromTemplate(string $viewPath): string
    {
        if (file_exists($viewPath)) {
            ob_start();
            require($viewPath);
            return ob_get_clean();
        } else {
            throw new Exception("La vue '$viewPath' est introuvable.");
        }
    }

    private function buildViewPath(string $viewName): string
    {
        return TEMPLATE_VIEW_PATH . $viewName . '.php';
    }
}
