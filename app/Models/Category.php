<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    static function createNewCategory ($request) {
        $category = Category::create([
            'title' => $request->get('new_category'),
            'type_id' => $request->get('typeId')
        ]);
        return $category;
    }
}
