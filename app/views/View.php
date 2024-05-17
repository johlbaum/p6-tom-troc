<?php

/**
 * Classe qui génère les vues en fonction de ce que chaque contrôlleur lui passe en paramètre. 
 */
class View
{
    private string $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Méthode qui retourne une page complète. 
     * @param string $viewPath : le chemin de la vue demandée par le controlleur. 
     * @param array $params : les paramètres que le controlleur a envoyé à la vue.
     * @return string
     */
    public function render(string $viewName, array $params = []): void
    {
        $viewPath = $this->buildViewPath($viewName);

        $content = $this->renderViewFromTemplate($viewPath, $params);
        $title = $this->title;

        require(MAIN_VIEW_PATH);
    }

    /**
     * Coeur de la classe, c'est ici qu'est généré ce que le controlleur a demandé. 
     * @param $viewPath : le chemin de la vue demandée par le controlleur.
     * @param array $params : les paramètres que le controlleur a envoyés à la vue.
     * @return string : le contenu de la vue.
     */
    private function renderViewFromTemplate(string $viewPath, array $params = []): string
    {
        if (file_exists($viewPath)) {
            extract($params);
            ob_start();
            require($viewPath);
            return ob_get_clean();
        } else {
            throw new Exception("La vue '$viewPath' est introuvable.");
        }
    }

    /**
     * Cette méthode construit le chemin vers la vue demandée.
     * @param string $viewName : le nom de la vue demandée.
     * @return string : le chemin vers la vue demandée.
     */
    private function buildViewPath(string $viewName): string
    {
        return TEMPLATE_VIEW_PATH . $viewName . '.php';
    }
}
