<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table="Rest_Notifications";
    protected $primaryKey = 'NTF_ID';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function createRules($user)
    {
        return  [
            'NTF_MSG'=>'required',
            'NTF_CREATOR'=>'required',
            'NTF_TOUSER'=>'required',
            'NTF_CREATEDATE'=>'required',
            'NTF_TYPE'=>'required',
            'NTF_ISREAD'=>'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'NTF_MSG'=>'required',
            'NTF_CREATOR'=>'required',
            'NTF_TOUSER'=>'required',
            'NTF_CREATEDATE'=>'required',
            'NTF_TYPE'=>'required',
            'NTF_ISREAD'=>'required',
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
