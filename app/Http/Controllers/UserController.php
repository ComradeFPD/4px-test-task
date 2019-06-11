<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * View for all users
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return response()->view('users.all', [
            'users' => User::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    /**
     * Render form to create user
     *
     * @return \Illuminate\Http\Response
     */
    public function createForm()
    {
        return response()->view('users.create-form');
    }

    /**
     * Create new user model
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createUser(Request $request)
    {
        $this->validate($request, User::getValidationRules());
        $data = $request->except('_token');
        User::create($data);
        return redirect(route('users.all'))->with('success', 'Пользователь успешно создан');
    }

    /**
     * Render form to update existing user
     *
     * @param integer $id
     *
     * @return \Illuminate\Http\Response
     */
    public function updateForm($id)
    {
        $user = User::whereId($id)->firstOrFail();
        return response()->view('users.update-form', [
           'user' => $user
        ]);
    }

    /**
     * Update existing user model
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateUser(Request $request)
    {
        $this->validate($request, User::getValidationRules());
        $data = $request->except('_token', 'id');
        User::whereId($request->id)->update($data);
        return redirect()->back()->with('success', 'Информация о пользователе успешно обновлена');
    }

    /**
     * Delete user
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id)
    {
        User::whereId($id)->delete();
        return redirect()->back()->with('success', 'Пользователь успешно удалён');
    }
}
