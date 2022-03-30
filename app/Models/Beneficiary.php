<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $table = "Benificary";
    protected $primaryKey = 'BEN_No';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public static function createRules($user)
    {
        return  [
            'CAT_ID' => 'required',
            'CAT_ArbName' => 'required',
            'CAT_EngName' => 'required',
            'CAT_Order' => 'required',
            'CAT_Status' => 'required',
            'CAT_Notes' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'CAT_ID' => 'nullable',
            'CAT_ArbName' => 'nullable',
            'CAT_EngName' => 'nullable',
            'CAT_Order' => 'nullable',
            'CAT_Status' => 'nullable',
            'CAT_Notes' => 'nullable',
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
}
