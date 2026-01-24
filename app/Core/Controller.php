<?php

namespace App\Core;

use Smarty\Smarty;
use Throwable;

class Controller
{
    protected Smarty $view;

    public function __construct()
    {
        $this->view = new Smarty();

        // Smarty directories
        $this->view->setTemplateDir(__DIR__ . '/../../resources/views/');
        $this->view->setCompileDir(__DIR__ . '/../../storage/smarty/compile/');
        $this->view->setCacheDir(__DIR__ . '/../../storage/smarty/cache/');
        $this->view->setConfigDir(__DIR__ . '/../../storage/smarty/config/');

        // Dev vs Prod toggle
        $this->view->caching = false;
        $this->view->debugging = false;
    }

    /**
     * Render a Smarty template with data
     *
     * @param string $template
     * @param array  $data
     */
    protected function render(string $template, array $data = []): void
    {
        // Flash messages
        if (!empty($_SESSION['error'])) {
            $data['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        if (!empty($_SESSION['success'])) {
            $data['success'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }

        // Assign variables
        foreach ($data as $key => $value) {
            $this->view->assign($key, $value);
        }

        try {
            $this->view->display($template);
        } catch (Throwable $e) {
            http_response_code(500);
            echo '<h1>Template Rendering Error</h1>';
            echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    }
}
