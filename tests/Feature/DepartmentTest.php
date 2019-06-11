<?php

namespace Tests\Feature;

use App\Department;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
   use RefreshDatabase;

    /**
     * @test
     * 
     * Test to display department on page
     */
    public function canSeeDepartment()
    {
        $departments = \factory(Department::class, 15)->make();
        $resp = $this->get('/departments');
        $resp->assertStatus(200);
        foreach ($departments as $department){
            $resp->assertSee($department->title);
        }
    }

    /**
     * @test
     *
     * Test to create department through request
     */
    public function canCreateDepartment()
    {
        $this->withoutExceptionHandling();
        $users = \factory(User::class, 3)->create();
        $resp = $this->post(route('departments.create'), [
            'name' => 'test',
            'description' => 'test description',
            'users' => $users->pluck('id'),
        ]);
        $resp->assertStatus(302);
        $department = Department::where('name', 'test')->firstOrFail();
        $this->assertNotNull($department);
        $this->assertNotNull($department->users);
    }

    /**
     * @test
     *
     * Test to update department via request
     */
    public function canUpdateDepartment()
    {
        $this->withoutExceptionHandling();
        $users = \factory(User::class, 5)->create();
        $newUser = $users->splice(3);
        $department = \factory(Department::class)->create();
        $department->users()->attach($users->pluck('id'));
        $department->save();
        $resp = $this->post(route('departments.update'), [
            'id' => $department->id,
            'name' => 'New title',
            'description' => 'New test description',
            'users' => $newUser
        ]);
        $resp->assertStatus(302);
        $updatedDepartment = Department::where('name', 'New title')->firstOrFail();
        $this->assertNotEquals($department->name, $updatedDepartment->name);
    }

}
