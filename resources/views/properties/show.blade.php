@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-6 col-xs-12">
        @if(!empty($property->toArray()['images']))
    <img id="fullImage" class="img animsition" style="max-width:100%" src="{{asset('storage/'.$property->images->first()->path)}}" alt="">
        @else
    <img id="fullImage" class="img animsition" style="max-width:100%;max-height:70%" src="{{asset('storage/images/no-image.png')}}" alt="">
        @endif
    </div>

<div class="col-md-6 col-xs-12">
    <div>
                @foreach ($property->images as $images)
                <img class="img img-thumbnail" src="{{asset("storage/$images->path")}}" alt="" style="max-width: 20%; cursor: pointer">
                @endforeach
    </div>
    <div>
        <h4 class="block2-txt">
            <b>
        {{$property->title}}
            </b>
        </h4>
        <br>
        Property Description: <br>
        {{$property->description}}
        <br>
        <span class="block2-price m-text6 p-r-5">
            <p>
                <b>
                        @if ($property->type==1)
                        {{number_format($property->amount * $property->duration, 0)." GHS"}}
                        <br>
                        {{ "(for {$property->convertMonths()} )"}}
                        @else
                        {{ number_format($property->amount,0). " GHS"}}
                        @endif
                    </b>
            </p>
        </span>
                <div>
                @auth
                @if($personal && $property->available())
                <p class="block2-name dis-block s-text3 p-b-5">
                        This property is available to the public
                </p>
                @endif
                @if($personal && !$property->available())
                <p class="block2-name dis-block s-text3 p-b-5">
                        This property is <strong>not available</strong> to the public.<br>
                        Pay the property rate to make it available
                </p>
                <button class="btn btn-info" data-prop-id="{{$property->id}}" name="prop-rate-pay">Pay Property Rate</button>
                @endif


                @if(!$personal && $property->available())
                <button  name="purchase" data-prop-id="{{$property->id}}"
                        class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                            Purchase
                        </button>
                @endif
                @endauth
            </div>
        <br>
    </div>
</div>

</div>
@endsection

@section('scripts')
<script>

$(document).ready(function(){
let imageFull = $('#fullImage');
let thumbs = $('.img-thumbnail');

thumbs.on('click', function(){
    imageFull.attr('src', $(this).attr('src')).fadeIn();
});


});

</script>
@auth
<script>
let propRatePay = $('button[name=prop-rate-pay]');

propRatePay.on('click', function () {
    let id = $(this).data('prop-id');
    let url = "{{route('property.pay.rate')}}"
    payment(url,id);
    })
</script>

@if (!$personal && $property->available())
<script>
let purchase =$('button[name=purchase]');
purchase.on('click', function(){
    let id = $(this).data('prop-id');
    let url = "{{route('property.pay.own')}}"
 payment(url, id);
})
</script>
@endif
@endauth
@endsection

