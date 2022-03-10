<?php

namespace App\Menu\Actions;

use App\Admin\DatabaseAdminAuth;
use App\Menu\Database\MenuTable;
use ClientX\Actions\Action;
use ClientX\Session\FlashService;
use ClientX\Translator\Translater;
use Psr\Http\Message\ServerRequestInterface as Request;

class MenuSwitchAction extends Action
{

    private MenuTable $menuTable;

    public function __construct(MenuTable $menuTable, DatabaseAdminAuth $auth, FlashService $flash, Translater $translater)
    {
        $this->menuTable = $menuTable;
        $this->flash = $flash;
        $this->auth = $auth;
        $this->translater = $translater;
    }

    /**
     * @throws \ClientX\Exception\JsonEncoderException
     */
    public function __invoke(Request $request): \Psr\Http\Message\ResponseInterface
    {
        $ids = explode(',', $request->getParsedBody()['menus']);
        $position = 1;
        foreach ($ids as $id) {
            $this->menuTable->update2($id, ['position' => $position++]);
        }
        $this->success($this->trans("configuration.update"));
        return $this->json(['success' => true]);
    }
}