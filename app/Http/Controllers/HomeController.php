<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($type="all")
    {

        switch($type)
        {
            case "buy":
            $type = 2;
            break;

            case "rent":
            $type =1;
            break;

            default:
            $type = 3;
            break;
        }

        $properties = Property::allAvailableProperties($type);
        return view('properties.home')->with(['properties'=>$properties, 'personal'=>false]);
    }

    public function getAllProperties($type)
    {
        switch($type)
        {
            case "buy":
            $type = 2;
            break;

            case "rent":
            $type =1;
            break;

            default:
            $type = 3;
            break;
        }

        $properties = Property::allAvailableProperties($type);
        return view('properties.home')->with(['properties'=>$properties, 'personal'=>false]);
    }

    public function show(Property $property)
    {
        $personal = $property->owner_id == auth()->id();
        return view('properties.show')->with(['property'=>$property, 'personal'=>$personal]);
    }

}
