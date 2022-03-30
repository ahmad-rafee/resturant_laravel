<?php

namespace App\Models;

use App\Casts\Base64Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "REST_IMAGES";
    protected $primaryKey = 'IMG_ID';
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    protected $casts = [
        'IMG_DATA'=>Base64Image::class
    ];
    public static function createRules($user)
    {
        return  [
            'IMG_DESCRIPTION' => 'required',
            'IMG_DATA' => 'required',
            'IMG_CREATE_DATE' => 'required',
            'IMG_USER_UPLOAD' => 'required',
            'IMG_TYPE' => 'required',
        ];
    }
    public static function updateRules($user)
    {
        return  [
            'IMG_DESCRIPTION' => 'required',
            'IMG_DATA' => 'required',
            'IMG_CREATE_DATE' => 'required',
            'IMG_USER_UPLOAD' => 'required',
            'IMG_TYPE' => 'required',
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
