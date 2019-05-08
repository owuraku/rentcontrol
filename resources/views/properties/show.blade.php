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
        <p class="block2-txt">
        {{$property->title}}
        <br>
        {{$property->description}}
        <br>
        <span class="block2-price m-text6 p-r-5">
                <b>
                    @if ($property->type=="1")
                    {{($property->amount * $property->duration)." GHS (for $property->duration months )"}}
                    @else
                    {{$property->amount. " GHS"}}
                    @endif
                </b>
                </span>
                @if($personal && $property->available())
                <p class="block2-name dis-block s-text3 p-b-5">
                        This property is available to the public
                </p>
                @else
                <p class="block2-name dis-block s-text3 p-b-5">
                        This property is <strong>not available</strong> to the public.<br>
                        Pay the property rate to make it available
                </p>

                @endif
        <br>
        </p>
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
})

});
</script>

@endsection

