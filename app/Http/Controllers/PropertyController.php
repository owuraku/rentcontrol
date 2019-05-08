<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Property;
use App\PropertyImage;

class PropertyController extends Controller
{
    //

    public $pageTitle = "Property Page";

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function myProperties()
    {
        $properties = Property::myProperties();
        return view('properties.home')->with(['properties'=>$properties, 'personal'=>true]);
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

    public function addProperty()
    {
        $errors=$success=[];
        if(request()->method()=="GET")
        return view('properties.addProperty');

        $this->validate(request(), [
            'title' => 'required',
            'location'=>'required',
            'images.*' =>'required|mimes:png,jpg,jpeg',
            'saleAmount' =>'sometimes|required|numeric',
            'rentAmount' =>'sometimes|required|numeric',
            'duration' =>'sometimes|required|numeric',
            'type' => 'required'
            ]);

        $property = new Property;
        $property->owner_id = auth()->id();
        $property->location = request()->location;
        $property->title = request()->title;
        $property->description = request()->description;
        $property->type = request()->type;
        $property->amount = request()->type =="1"? request()->rentAmount : request()->saleAmount;
        $property->duration = request()->duration;

        if($property->save())
        {
            $success[]= "Property added successfully";
            foreach(request()->images as $image)
            {
                $propertyImage = new PropertyImage;
                //$propertyImage->path =$image->store('images');
                $propertyImage->path =Storage::putFile('images', $image);
                if($property->attachImage($propertyImage))
                {
                    $success[]= "Property image attached successfully";
                }
                else {
                    $errors[]= "Error Saving Image $image->getClientOriginalName()";
                    return;
                }
            }

        }
        else
        {
            $errors[] = "Error saving property details. Try again later";
        }

        if($errors!=null)$errors = collect($errors);
        if($success!=null)$success = collect($success);

        return view('properties.addProperty')->with([
            'success' => $success,
            'errors' => $errors
        ]);

        //if($request)
    }

    public function show(Property $property)
    {
        $personal = $property->owner_id == auth()->id();
        return view('properties.show')->with(['property'=>$property, 'personal'=>$personal]);
    }

}
