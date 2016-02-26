<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\LocalizesDates;
use Jenssegers\Date\Date;

class Reservation extends Model
{
    use LocalizesDates;

    protected $dates = ['starts_at', 'ends_at', 'created_at', 'updated_at'];

    protected $visible = ['id', 'user_id', 'resource_id', 'starts_at', 'ends_at', 'card_id'];

    protected $appends = ['card_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    public function getStartDateAttribute()
    {
        return $this->getAttribute('starts_at')->format('Y-m-d');
    }

    public function getStartTimeAttribute()
    {
        return $this->getAttribute('starts_at')->format('H:i');
    }

    public function getEndDateAttribute()
    {
        return $this->getAttribute('ends_at')->format('Y-m-d');
    }

    public function getEndTimeAttribute()
    {
        return $this->getAttribute('ends_at')->format('H:i');
    }

    public function scopeEnded($query)
    {
        return $query->where('ends_at', '<', Date::now());
    }

    public function scopeActive($query)
    {
        return $query->where('ends_at', '>=', Date::now());
    }

    public function getCardIdAttribute()
    {
        if ($this->user->cards && $this->user->cards->first()) {
            return $this->user->cards->first()->id;
        }
    }
}
