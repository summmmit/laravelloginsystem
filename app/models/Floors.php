<?php
/**
 * Created by PhpStorm.
 * User: summmmit
 * Date: 11/1/2014
 * Time: 12:45 AM
 */

class Floors extends Eloquent {

    protected $fillable = array('floor_number', 'building_id');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'floors';


} 