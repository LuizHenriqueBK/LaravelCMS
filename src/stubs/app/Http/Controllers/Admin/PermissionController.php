<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permissions\{Update, Store};
use App\Repositories\Admin\PermissionRepository;
use Illuminate\Http\Request;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Admin
 */
class PermissionController extends Controller
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var PermissionRepository
     */
    public $repository;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repositories\Admin\PermissionRepository  $repository
     * @return void
     */
    public function __construct(Request $request, PermissionRepository $repository)
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

        return view("Admin::permissions.index", compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = null;

        return view("Admin::permissions.createAndEdit", compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Permissions\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Store $request)
    {
        $model = $this->repository->create($request->validated());

        if ($model) {
            return redirect()
                ->route('admin.permissions.edit', $model->id)
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
            return view("Admin::permissions.show", compact('model'));
        }
        return redirect()
                ->route('admin.permissions.index')
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
            return view("Admin::permissions.createAndEdit", compact('model'));
        }

        return redirect()
            ->route('admin.permissions.index')
            ->withToastError('Ops, Registro não encontrado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \App\Http\Requests\Permissions\Update  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Update $request, $id)
    {
        if ($this->repository->update($id, $request->validated())) {
            return redirect()
                ->route('admin.permissions.edit', $id)
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
                ->route('admin.permissions.index')
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
                ->route('admin.permissions.index')
                ->withToastSuccess('Registros deletados com sucesso!');
        }

        return redirect()
            ->back()
            ->withToastError('Ops, Erro ao deletar os registros!');
    }
}
