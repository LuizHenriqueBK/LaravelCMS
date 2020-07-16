<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\{Update, Store};
use App\Repositories\Admin\{RoleRepository, PermissionRepository};
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers\Admin
 */
class RoleController extends Controller
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var RoleRepository
     */
    public $repository;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repositories\Admin\RoleRepository  $repository
     * @return void
     */
    public function __construct(Request $request, RoleRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $length = $this->request->input('length', 25);

        $model = $this->repository->paginate($length);

        return view("Admin::roles.index", compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = null;
        $permissions = PermissionRepository::get(['id', 'title', 'name'])
            ->mapToGroups(function($permission, $key) {
                $module = current(explode('.', $permission->name));
                return [$module => $permission];
            })
            ->sortBy(function($permission, $key){
                return $permission->first()->id;
            })
            ->all();

        return view("Admin::roles.createAndEdit", compact('model', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Roles\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Store $request)
    {
        $model = $this->repository->create($request->validated());

        if ($model) {
            $model->permissions()->sync($request->permissions);
            return redirect()
                ->route('admin.roles.edit', $model->id)
                ->withToastSuccess('Registro salvo com sucesso!');
        }

        return redirect()
            ->back()
            ->withToastError('Ops, Erro ao salvar o Registro!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($model = $this->repository->find($id)) {
            return view("Admin::roles.show", compact('model'));
        }
        return redirect()
                ->route('admin.roles.index')
                ->withToastError('Ops, Registro não encontrado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($model = $this->repository->find($id)) {
            $permissions = PermissionRepository::get(['id', 'title', 'name'])
                ->mapToGroups(function($permission, $key) {
                    $module = current(explode('.', $permission->name));
                    return [$module => $permission];
                })
                ->sortBy(function($permission, $key){
                    return $permission->first()->id;
                })
                ->all();

            return view("Admin::roles.createAndEdit", compact('model', 'permissions'));
        }

        return redirect()
            ->route('admin.roles.index')
            ->withToastError('Ops, Registro não encontrado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \App\Http\Requests\Roles\Update  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Update $request, $id)
    {
        $model = $this->repository->update($id, $request->validated());

        if ($model) {
            $model->permissions()->sync($request->permissions);
            return redirect()
                ->route('admin.roles.edit', $id)
                ->withToastSuccess('Registro salvo com sucesso!');
        }

        return redirect()
            ->back()
            ->withToastError('Ops, Erro ao salvar o Registro!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->repository->delete($id)) {
            return redirect()
                ->route('admin.roles.index')
                ->withToastSuccess('Registro deletado com sucesso!');
        }

        return redirect()
            ->back()
            ->withToastError('Ops, Erro ao deletar o Registro!');
    }

    /**
     * Destroy bulk resources by id`s
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyMass()
    {
        $id = $this->request->validate([
            'id' => 'required|array'
        ]);

        if ($this->repository->bulkDelete($id)) {
            return redirect()
                ->route('admin.roles.index')
                ->withToastSuccess('Registros deletados com sucesso!');
        }

        return redirect()
            ->back()
            ->withToastError('Ops, Erro ao deletar os registros!');
    }
}
