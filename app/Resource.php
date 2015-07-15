<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['name'];

    protected $visible = ['id', 'name'];

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function getLinkAttribute()
    {
        $href = route('admin.resources.show', $this);
        $name = $this->getAttribute('name');

        return sprintf('<a href="%s" title="%s">%s</a>', $href, $name, $name);
    }
}
