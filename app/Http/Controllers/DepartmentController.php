<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    /**
     * Function to see all existing departments
     *
     * @return Response
     */
    public function all()
    {
        $departments = Department::orderBy('created_at', 'desc')->paginate(10);
        return response()->view('department.all', [
            'departments' => $departments
        ]);
    }

    /**
     * Rendering form to create new department
     *
     * @return Response
     */
    public function createForm()
    {
        $users = User::all();
        return response()->view('department.create-form', [
            'users' => $users
        ]);
    }

    /**
     * Create a new model instance of department
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createDepartment(Request $request)
    {
        $this->validate($request, Department::getValidationFields());
        $data = $request->except('_token', 'users', 'logo');
        $department = Department::create($data);
        if($request->users != null){
            $department->users()->attach($request->users);
        }
        if($request->logo != null){
            $department->saveImage($request->logo);
        }
        $department->save();
        return redirect(route('departments.all'))->with('success', 'Отдел успешно добавлен');
    }

    /**
     * Render form to update existing department
     *
     * @param integer $id
     * @return Response
     */
    public function updateForm($id)
    {
        $department = Department::whereId($id)->firstOrFail();
        $departmentUsers = $department->users->mapWithKeys(function (User $user){
            return [$user->id => $user->name];
        })->toArray();
        $allUser = User::all();
        return response()->view('department.update-form', [
            'department' => $department,
            'departmentsUser' => $departmentUsers,
            'allUsers' => $allUser
        ]);
    }

    /**
     * Update existing model
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateDepartment(Request $request)
    {
        $this->validate($request, Department::getValidationFields());
        $data = $request->except('users', 'id');
        $department = Department::whereId($request->id)->firstOrFail();
        $department->fill($data);
        if($request->users != null){
            $department->users()->sync($request->users);
        }
        $department->save();
        return redirect()->back()->with('success', 'Информация успешно обновлена');

    }

    /**
     * Delete selected department
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteDepartment($id)
    {
        Department::whereId($id)->delete();
        return redirect()->back()->with('success', 'Отдел успешно удалён');
    }
}
