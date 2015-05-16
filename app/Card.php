<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model {

	protected $table = 'card';

    public function todos() {
        return $this->hasMany('App\Todo', 'card_id');
    }

}
