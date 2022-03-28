<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecorType extends Model
{
    protected $table = "REST_DecorType";

    use HasFactory;
    protected $primaryKey = 'DTYP_ID';
    protected $guarded = [];
    public $timestamps = false;

    public static function createRules($user)
    {
        return  [
            'DTYP_Name' => 'required',
            'DTTYP_Name' => 'required',
            'DTYP_Description' => 'required',
            'DTYP_Logo' => 'required',
            'DTYP_CanReserve' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'DTTYP_Name' => 'required',
            'DTYP_Name' => 'required',
            'DTYP_Description' => 'required',
            'DTYP_Logo' => 'required',
            'DTYP_CanReserve' => 'required',
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
