<?php

namespace SON\Http\Controllers\Admin;

use Kris\LaravelFormBuilder\Form;
use SON\Forms\UserForm;
use SON\Models\User;
use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @var User
     */
    private $model;

    /**
     * UsersController constructor.
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->model->paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(UserForm::class, ['url' => route('admin.users.store'), 'method' => 'POST']);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $inputs = $form->getFieldValues();
        $this->model->createFully($inputs);
        return redirect()->route('admin.users.index')->with('message', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \SON\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SON\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, ['url' => route('admin.users.update', $user->id), 'method' => 'PUT', 'model' => $user]);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \SON\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $form = \FormBuilder::create(UserForm::class, [
            'data' => ['id' => $user->id]
        ]);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $inputs = $form->getFieldValues();
        $user->update($inputs);
        return redirect()->route('admin.users.index')->with('message', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SON\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('message', 'Usuário excluido com sucesso!');
    }
}
