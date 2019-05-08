<style>
.of-hidden{
overflow: visible;
}
</style>

<div class="row">
    <div class="mr-auto ml-auto col-md-6">
        <form class="leave-comment" method="POST" action="{{route('property.add')}}" enctype="multipart/form-data">
                @csrf
    <h4 class="m-text26 p-b-36 p-t-15">
        Add Property Details
    </h4>

    <div class="bo4 of-hidden size15 m-b-20">
        <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="title" placeholder="Title" value="{{ old('title') }}" required>
    </div>

    <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="location" placeholder="Location" value="{{ old('location') }}" required>
    </div>

    <div class="bo4 of-hidden size15 m-b-20">
            <select class="sizefull s-text7 p-l-22 p-r-22" type="text" name="type" required>
                {{$selected="selected"}}
                <option value="" >Select type of property listing</option>
                <option value="1" {{ old('type')=="1"? $selected: "" }}>Rent</option>
                <option value="2" {{ old('type')=="2"? $selected: "" }}>Sale</option>
                {{$selected=""}}
            </select>
    </div>

    {{-- when property is for rent --}}
    <div id="rent" style="display:none">
            <div class="bo4 of-hidden size15 m-b-20">
                    <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="duration" value="{{ old('duration') }}" placeholder="Enter duration in months" required>
            </div>
            <div class="bo4 of-hidden size15 m-b-20">
                    <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="rentAmount" value="{{ old('rentAmount') }}" placeholder="Enter amount per month" required>
            </div>
    </div>

    <div id="sale">
    <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="saleAmount" value="{{ old('saleAmount') }}" placeholder="Enter amount" required>
    </div>
    </div>

    <textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="description"  placeholder="Describe the property" required>@if (null!==old('description')){{old('description')}}@endif</textarea>

    <div class="bo4 of-hidden size15 m-b-20">
            <p class="s-text7">Property Class: &nbsp;&nbsp;&nbsp;&nbsp;</p>
                   <div class="star-rating">
                       <span class="fa fa-star-o" data-rating="1"></span>
                       <span class="fa fa-star-o" data-rating="2"></span>
                       <span class="fa fa-star-o" data-rating="3"></span>
                   <input type="hidden" name="class" class="rating-value" value="{{null===old('class') ? 1 : old('class')}}">
                    </div>
            </p>
    </div>
    <br>

    <div class="bo4 of-hidden size15 m-b-20">
            <input class="sizefull s-text7 p-l-22 p-r-22" multiple type="file" name="images[]" id="images" placeholder="Add Image" required accept="image/*">
    </div>
    <div id="displayImages">

    </div>

<br>
    <div class="w-size25">
        <!-- Button -->
        <button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4">
            SUBMIT
        </button>
    </div>
    </div>
</form>
</div>

@section('scripts')
<script>

$(document).ready(function() {
    jQuery.validator.setDefaults({
        //ignore: [],
        success: "valid",
        rules:
            {
                saleAmount: {
                 digits: true,
                 min:2000
                },
                rentAmount: {
                 digits: true,
                 min:20
                },
                duration: {
                    min: 1
                }
            },
        messages:
            {

            }
    });




var $star_rating = $('.star-rating .fa');

var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  });
};

$star_rating.on('click', function() {
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

SetRatingStar();

    let imgDiv = $("#displayImages");

function readURL(input) {

if (input.files && input.files[0]) {

    let images = $('<div>');

    let loader = function (e) {
        let img = $('<img>').attr('src', e.target.result)
                    .css('maxWidth', '100px')
                    .css('maxHeight','100px');
        images.append(img);
    };

        $(input.files).each((i, file) => {
        let reader = new FileReader();
        reader.onload = loader;
        reader.readAsDataURL(file);
        });

        imgDiv.html(images);
    }
}
$("#images").change(function(){
    imgDiv.html("");
    readURL(this);
});

let rentDiv = $('#rent');
let saleDiv = $('#sale');

function checkSaleOrRent()
{
    rentDiv.hide().find('input').attr('disabled', true);
    saleDiv.hide().find('input').attr('disabled', true);
    let option = $('select[name=type]').find('option:selected').val();
    if(option=="1")
    {
    rentDiv.show();
    rentDiv.find('input').attr('disabled', false);
    }
    if(option=="2")
    {
    saleDiv.show();
    saleDiv.find('input').attr('disabled', false);
    }
}

checkSaleOrRent();

$('select[name=type]').on('change', function(){
checkSaleOrRent();
});

$('form').on('submit', function(e){
    e.preventDefault();
    form = $(this);
    form.validate({
        ignore: []
    });

   if(form.valid())
   {
       form.get(0).submit();
   }

});




});
</script>

@endsection
