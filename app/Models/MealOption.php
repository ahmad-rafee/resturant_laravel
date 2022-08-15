<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealOption extends Model
{
    protected $table = "REST_MealOptions";
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $with = ['option'];

    public static function createRules($user)
    {
        return  [
            'OPT_ID' => 'required',
            'MEL_ID' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'OPT_ID' => 'required',
            'MEL_ID' => 'required',
        ];
    }
    public function scopeSearch($query, $request)
    {
        $locale = app()->getLocale();
        // $query->orderBy('bills.created_at', 'desc');
        $query->when($request->name, function ($query, $name) use ($locale) {
            $query->where("name->$locale", 'like', "%$name%");
        });
    }
    public function scopeSort($query, $request)
    {
        $sortBy = $request->sortBy;
        $sortDesc = $request->sortDesc;
        $custom_fields = [];
        if ($sortBy && $sortDesc) {
            foreach ($sortBy as $index => $field) {
                $desc = $sortDesc[$index] ? "desc" : "asc";
                if (!isset($custom_fields[$field])) {
                    $query->orderBy($field, $desc);
                } else {
                    $custom_fields[$field]($query, $desc);
                }
            }
        }
    }
    public function option(){
        return $this->belongsTo(Option::class,'OPT_ID','OPT_ID');
    }
}
