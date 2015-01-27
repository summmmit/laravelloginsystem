<?php
/**
 * Created by PhpStorm.
 * User: summmmit
 * Date: 11/1/2014
 * Time: 12:19 AM
 */

class BuildingController extends BaseController {

    public function getCreateFloor(){
        $building = Input::get('building');
        return View::make('infrastructure.createFloor')->withbuilding($building);
    }

    public function getFloor(){

        $building                 = Input::get('building');
        $floors                   = Floors::where('building_id', '=', $building)->get();
        return View::make('infrastructure.floors')->withfloors($floors)->withbuilding($building);
    }

    public function postFloor(){

            $building_id                     = Input::get('building_id');
            $floor_number                    = Input::get('floor_number');

            $floors = Floors::create(array(
                'floor_number'    => $floor_number,
                'building_id'     => $building_id,
            ));

            if($floors){
                return Redirect::route('company-building-floor')
                    ->with('global' , 'Your Floor has been Registered')->withbuilding($building_id);
            }else{
                return Redirect::route('company-building-floor')
                    ->with('global', 'Cant Add Your Floor. Try Later');
            }
    }

    public function getInfrastructure(){
        $company_id = Auth::user()->id;
        $buildings = Buildings::where('company_id' , '=', $company_id)->get();

        return View::make('infrastructure.buildings')->withbuildings($buildings);
    }

    public function getBuildings(){
        return View::make('infrastructure.createBuildings');
    }

    public function postBuildings(){
        $validator = Validator::make(Input::all(),
            array(
                'building_name'              => 'required|max:50',
                'address'                    => 'required|max:50',
            )
        );
        if($validator->fails()){
            return Redirect::route('company-infrastructure')
                ->withErrors($validator)
                ->withInput();
        }else{
            $company_id                 = Input::get('company_id');
            $building_name              = Input::get('building_name');
            $address                    = Input::get('address');

            $buildings = Buildings::create(array(
                'building_name'    => $building_name,
                'address'          => $address,
                'company_id'       => $company_id,
            ));

            if($buildings){
                return Redirect::route('company-infrastructure')
                    ->with('global' , 'Your Building has been Registered');
            }else{
                return Redirect::route('company-infrastructure')
                    ->with('global', 'Cant Add Your Building. Try Later');
            }

        }
    }

} 