<?php


namespace Impactaweb\Listing;


use Illuminate\Support\Facades\Request;

trait ListingActions
{
    public $actions = [];

    public function __construct()
    {
        $this->createDefaultActions();
    }

    public function createDefaultActions()
    {
        $defaultActions = config('datatable.default_actions');
        foreach ($defaultActions as $action) {
            $type = $action['type'];
            $label = $action['label'];
            $url = $action['url'];
            $icon = $action['icon'];
            $method = $action['method'];
            $showLabel = $action['showLabel'];
            $message = $action['message'] ?? '';
            $this->addAction($type, $label, $url, $icon, $method, $showLabel, $message);
        }
    }

    public function addAction(
        string $type,
        string $label,
        string $url = '',
        string $icon = '',
        string $method = 'GET',
        bool $showLabel = false,
        ?string $message = null)
    {
        $path = Request::path();
        $root = Request::root();
        $fullUrl = Request::fullUrl();
        $redir = urlencode(substr($fullUrl, strlen($root), strlen($fullUrl)));

        $url = str_replace('{redir}', $redir, $url);
        $url = str_replace('{path}', $path, $url);
        $this->actions[$type] = [
            'label' => $label,
            'url' => $url,
            'showLabel' => $showLabel,
            'icon' => $icon,
            'method' => $method,
            'message' => $message
        ];
    }

    public function removeAction(string $type)
    {
        if (isset($this->actions[$type])) {
            unset($this->actions[$type]);
        }
    }

    public function clearActions(array $actions)
    {
        foreach ($actions as $action) {
            $this->removeAction($action);
        }
    }
}
