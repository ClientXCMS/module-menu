<?php

namespace App\Menu\Actions;

use App\ClientX\FontAwesome;
use ClientX\Actions\CrudAction;
use App\Menu\Database\MenuTable as Table;
use ClientX\Renderer\RendererInterface;
use ClientX\Router;
use ClientX\Session\FlashService;
use ClientX\Translator\Translater;
use ClientX\Validator;
use Psr\Http\Message\ServerRequestInterface as Request;

class MenuCrudAction extends CrudAction
{

    protected $viewPath = "@menu_admin";
    protected $routePrefix = 'menu.admin';
    protected $moduleName = "Menu";
    protected $fillable = ["redirect", "icon", "badge", "title", "user"];

    public function __construct(RendererInterface $renderer, Table $table, Router $router, FlashService $flash, Translater $translater)
    {
        parent::__construct($renderer, $table, $router, $flash);
        $this->translater = $translater;
    }

    public function getValidator(Request $request): Validator
    {
        return parent::getValidator($request)->notEmpty('title', 'redirect', 'icon');
    }

    public function formParams(array $params): array
    {
        $params['icons'] = (new FontAwesome())->getAll();
        $params['users'] = collect(['global', 'offline', 'online'])->mapWithKeys(function ($k) {
            $translation = $this->trans("menu.users." . $k);
            return [$k => $translation];
        })->toArray();
        return parent::formParams($params);
    }
}
