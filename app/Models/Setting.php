<?php
namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Translatable;

    protected $table ='settings';

    protected $with =['translations'];

    protected $translatedAttributes =['value'];

    protected $fillable = [
        'key',
        'is_translatable',
        'plain_value',
    ];


    protected $casts = [
        'is_translatable' => 'boolean'
    ];


    public static function setMany($settings)
    {
        foreach ($settings as $key => $value) {
            self::set($key, $value);
        }
    }


    public static function set($key, $value)
    {
        if ($key === 'translatable') {
            return self::setTranslatableSettings($value);
        }

        if(is_array($value))
        {
            $value = json_encode($value);
        }

        static::updateOrCreate(['key' => $key], ['plain_value' => $value]);
    }


    /**
     * Set a translatable settings.
     *
     * @param array $settings
     * @return void
     */
    public static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $key => $value) {
            self::updateOrCreate(['key' => $key], [
                'is_translatable' => true,
                'value' => $value,
            ]);
        }
        return true;
    }

}
