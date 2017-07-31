<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rss extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Protected fields
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'rss_feed';

    /**
     * Set Published Date to be Formatted Carbon instance
     *
     * @return string
     */
    public function setPubDateAttribute()
    {
        return \Carbon\Carbon::parse($this->pubDate)->format('Y-m-d H:i:s');
    }

}