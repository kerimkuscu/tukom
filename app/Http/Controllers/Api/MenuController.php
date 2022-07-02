<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuFormRequest;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function __construct(public MenuRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->repository->getTreeData();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getMenuList()
    {
        $data = $this->repository->getMenuList();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getMegaMenuList()
    {
        $data = $this->repository->getMegaMenuList();

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MenuFormRequest $request
     *
     * @return MenuResource
     */
    public function store(MenuFormRequest $request): MenuResource
    {
        $attributes              = $request->toArray();
        $attributes['parent_id'] = hashids_decode($attributes['parent_id']);

        $menu = Menu::query()->create($attributes);

        return new MenuResource($menu);
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     *
     * @return MenuResource
     */
    public function show(Menu $menu): MenuResource
    {
        return new MenuResource($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuFormRequest $request
     * @param Menu            $menu
     *
     * @return MenuResource
     */
    public function update(MenuFormRequest $request, Menu $menu): MenuResource
    {
        $menu->update($request->toArray());

        return new MenuResource($menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     *
     * @return JsonResponse
     */
    public function destroy(Menu $menu): JsonResponse
    {
        $status = false;
        if (!$menu->subMenus()->exists()) {
            $menu->delete();
            $status = true;
        }

        return response()->json([
            'status' => $status,
        ]);
    }
}
