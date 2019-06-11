<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public static function getValidationFields()
    {
        return [
            'name' => 'required:unique',
            'description' => 'required'
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_department_pivot', 'department_id', 'user_id');
    }

    public function saveImage($file)
    {
        $ext = $file->getClientOriginalExtension();
        $filename = time().'.'.$ext;
        $file->move(storage_path('/app/public/logo/'), $filename);
        $this->logo = $filename;
    }
}
