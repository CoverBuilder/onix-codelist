<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class Codelist extends Model
{
    use AlgoliaEloquentTrait;

    public static $autoIndex = true;
    public static $autoDelete = true;

    public $algoliaSettings = [
        'attributesToIndex' => [
            'description',
            'number',
            'codes.description',
            'codes.notes',
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['number'];

    /**
     * Get the Codes for the Codelist.
     */
    public function codes()
    {
        return $this->hasMany('App\Code');
    }

    public function getAlgoliaRecord()
    {
        /**
         * Load the categories relation so that it's available
         *  in the laravel toArray method
         */
        $this->codes;
        return $this->toArray();
    }
}