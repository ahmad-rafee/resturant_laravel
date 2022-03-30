<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallDecor extends Model
{
    protected $table = "REST_HallDecors";
    protected $primaryKey = 'DEC_ID';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static function createRules($user)
    {
        return  [
            'DEC_HALLID' => 'required',
            'DEC_TableNo' => 'required',
            'DEC_Name' => 'required',
            'DEC_TypeID' => 'required',
            'DEC_Status' => 'required',
            'DEC_Image' => 'required',
            'DEC_Left' => 'required',
            'DEC_Top' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'DEC_HALLID' => 'required',
            'DEC_TableNo' => 'required',
            'DEC_Name' => 'required',
            'DEC_TypeID' => 'required',
            'DEC_Status' => 'required',
            'DEC_Image' => 'required',
            'DEC_Left' => 'required',
            'DEC_Top' => 'required',
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
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'DEC_HALLID', 'HALL_ID');
    }
}
