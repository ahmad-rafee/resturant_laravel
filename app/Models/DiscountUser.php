<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountUser extends Model
{
    protected $table = "REST_DISCOUNT_USERS";
    protected $primaryKey = 'DISU_DISC_ROLE_ID';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function createRules($user)
    {
        return  [
            'DISU_SERIAL' => 'required',
            'DISU_USER_ID_TYPE' => 'required',
            'DISU_USER_ID' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'DISU_SERIAL' => 'required',
            'DISU_USER_ID_TYPE' => 'required',
            'DISU_USER_ID' => 'required',
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
