<?php
namespace Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];
    protected $connection = 'cities';

    public function create($parameters){
        $this->fill($parameters);
        $this->save();
        if (!$this->save()) {
            $validationErrors = (implode(', ', $this->validationMessages()->all()));
            throw new \Exception($validationErrors);
        }
    }

    public function neighborhoods(){
        return $this->hasMany(
            'Model\Neighborhood',
            'city_id'
        );
    }
}
