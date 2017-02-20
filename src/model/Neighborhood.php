<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;
use Model\City;

class Neighborhood extends Model
{
    protected $table = 'neighborhoods';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'city_id',
    ];
    protected $connection = 'neighborhoods';

    public function create($parameters){
        $this->fill($parameters);
        $this->save();
        if (!$this->save()) {
            $validationErrors = (implode(', ', $this->validationMessages()->all()));
            throw new \Exception($validationErrors);
        }
    }
}
