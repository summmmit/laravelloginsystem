<?php
/**
 * Created by PhpStorm.
 * User: summmmit
 * Date: 11/1/2014
 * Time: 12:45 AM
 */

class Buildings extends Eloquent {

    protected $fillable = array('building_name', 'address', 'company_id');
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'buildings';


} 