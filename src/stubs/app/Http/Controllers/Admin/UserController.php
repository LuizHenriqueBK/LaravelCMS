<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\{Update, Store};
use App\Repositories\Admin\{UserRepository, RoleRepository};
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var UserRepository
     */
    public $repository;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repositories\Admin\UserRepository  $repository
     * @return void
     */
    public function __construct(Request $request, UserRepository $repository)
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

        $model = $this->repository->with(['avatar', 'roles'])->paginate($length);

        return view("Admin::users.index", compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = null;
        $roles = RoleRepository::get(['id','title'])->pluck('title', 'id');

        return view("Admin::users.createAndEdit", compact('model', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Users\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Store $request)
    {
        $model = $this->repository->create($request->validated());

        if ($model) {
            if ($request->avatar) {
                $avatar = new Media;
                $avatar->file = $request->avatar;
                $model->avatar()->save($avatar);
            }

            $model->roles()->sync($request->roles);

            return redirect()
                ->route('admin.users.edit', $model->id)
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
            return view("Admin::users.show", compact('model'));
        }
        return redirect()
                ->route('admin.users.index')
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
            $roles = RoleRepository::get(['id','title'])->pluck('title', 'id');

            return view("Admin::users.createAndEdit", compact('model','roles'));
        }

        return redirect()
            ->route('admin.users.index')
            ->withToastError('Ops, Registro não encontrado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Users\Update  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Update $request, $id)
    {
        $model = $this->repository->update($id, $request->validated());

        if ($model) {
            $model->roles()->sync($request->roles);

            if ($request->avatar) {
                $model->avatar->file = $request->avatar;
                $model->avatar->save();
            }

            return redirect()
                ->route('admin.users.edit', $id)
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
                ->route('admin.users.index')
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
                ->route('admin.users.index')
                ->withToastSuccess('Registros deletados com sucesso!');
        }

        return redirect()
            ->back()
            ->withToastError('Ops, Erro ao deletar os registros!');
    }
}
