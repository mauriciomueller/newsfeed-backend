<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Concerns\HidesAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettingsCategory extends Model
{
    use HasFactory, HasAttributes, HidesAttributes;

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'settings_categories_codes'
    ];


    protected function getSettingsCategoriesCodesAttribute(string $value): array
    {
        return $categoryCodes = json_decode($value, true) ?? [];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
