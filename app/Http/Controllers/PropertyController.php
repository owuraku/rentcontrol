<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Property;
use App\PropertyImage;
use App\PropertyRatePayment;

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
    }



    public function payRate()
    {
        $this->validate(request(), [
            'type' => 'required',
            'number'=>'required|numeric|min:10',
            'amount' =>'required',
            ]);

        $errors;
        if(request()->type=="visa"&&request()->number!=="123456789")
        $errors="Invalid card number. Please check and try again";
        if(request()->type=="momo" &&request()->number!="0244419419")
        $errors="Transaction unsuccessful";
        if(Property::findOrFail(request()->id)->owner_id !=auth()->id)
        $errors="Only property owners can pay property rate";

        if(empty($errors))
        {
            $payment = new PropertyRatePayment;
            $payment->property_id = request()->id;
            $payment->amount = request()->amount;
            $payment->active_year = \Carbon\Carbon::now()->year;
            $payment->transaction_id = \Carbon\Carbon::now()->unix().request()->id;
            if($payment->save())
            return response()->json(['message' =>"Information saved successfully"]);
            $errors="Error submitting your request. Please try again.";
        }
        return response()->json(['errors' =>$errors]);
    }

    public function payForOwnership()
    {
        $this->validate(request(), [
            'type' => 'required',
            'number'=>'required|numeric|min:10',
            'amount' =>'required',
            ]);

            $errors;
        if(request()->type=="visa"&&request()->number!=="123456789")
        $errors="Invalid card number. Please check and try again";
        if(request()->type=="momo" &&request()->number!="0244419419")
        $errors="Transaction unsuccessful";

        $property = Property::findOrFail(request()->id);
        if(!$property->available())
        $error="Property not available for public";

        if(empty($errors))
        {
            $payment = new PropertyRatePayment;
            $payment->property_id = request()->id;
            $payment->amount = request()->amount;
            $payment->active_year = \Carbon\Carbon::now()->year;
            $payment->transaction_id = \Carbon\Carbon::now()->unix().request()->id;
            if($payment->save())
            return response()->json(['message' =>"Information saved successfully"]);
            $errors="Error submitting your request. Please try again.";
        }
        return response()->json(['errors' =>$errors]);


        # code...
    }

}
