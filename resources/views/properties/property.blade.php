<section class="newproduct bgwhite p-t-45">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Properties
				</h3>
            </div>
            <div class="row">
            @foreach ($properties as $property)
            @php
                $imagepath ="images/no-image.png";
                if(!empty($property->toArray()['images']))
                $imagepath = $property->images->first()->path;
            @endphp
                    <div class="mr-auto ml-auto col-sm-12 col-md-4 col-lg-3 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    <img style="max-height:100%" src="{{asset('storage/'.$imagepath)}}" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        {{-- <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a> --}}
                                        @if(!$personal)
                                        <div class="block2-btn-wishlist hov-pointer trans-0-4">
                                            <!-- Button -->
                                            <button  name="book-appointment"
                                            class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Book Appointment
                                            </button>
                                        </div>
                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                                <!-- Button -->
                                                <button  name="purchase"
                                                class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                    Purchase
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                <a href="{{route('property.get', ['id' => $property->id])}}" class="block2-name dis-block s-text3 p-b-5">
                                        {{$property->title}}
                                </a>
                                <p class="block2-name dis-block s-text3 p-b-5">
                                    {{$property->location}}
                                </p>
                                <div class="star-rating">
                                @for ($i = 0; $i < $property->class; $i++)
                                <span class="fa fa-star" data-rating="1"></span>
                                @endfor
                                </div>
                                    <span class="block2-price m-text6 p-r-5">
                                    <b>
                                        @if ($property->type=="1")
                                        {{($property->amount * $property->duration)." GHS (for $property->duration months )"}}
                                        @else
                                        {{$property->amount. " GHS"}}
                                        @endif
                                    </b>
                                    </span>
                                    

                                </div>
                            </div>
                        </div>
                        @endforeach
            </div>

        <!-- Pagination -->
        <div class="pagination flex-m flex-w p-t-26 mr-auto p-r-106">
                {{ $properties->links() }}
        </div>
    </div>
	</section>
@section('scripts')

<script>
let book = $('button[name=book-appointment]');
let purchase =$('button[name=purchase]');
// let selectDate = element => {
//    $(this.target).datepicker();
// }
book.on('click', async function(){
    let format = 'YYYY-MM-DD';
    let today = moment();
    let min = today.add('1', 'days').format(format);
    let max = today.add('30', 'days').format(format);
    let datetime;


    date = await Swal.fire({
            onBeforeOpen: () => {
                //const content = Swal.getContent()
                //const $$ = content.querySelector.bind(content);
                const datepicker = $('#bookingTime').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: format.toLowerCase(),
                    disableDaysOfWeek: [0],
                    keyboardNavigation: true,
                    modal: true,
                    header: true,
                    footer: true,
                    minDate: min,
                    maxDate:max
                });
            },
            title: 'Choose Date and Time',
            html:
            `<input id="bookingTime" class="sizefull s-text7 p-l-22 p-r-22" readonly type="text" >`,
            focusConfirm: false,
            preConfirm: () => {
                return  $('#bookingTime').val()
            }
        });

        if (date) {
           let {value: appointment} = date;
        }
});

purchase.on('click', function(){
    Swal.mixin({
  input: 'text',
  confirmButtonText: 'Next &rarr;',
  showCancelButton: true,
  progressSteps: ['1', '2', '3']
}).queue([
  {
    title: 'Question 1',
    text: 'Chaining swal2 modals is easy'
  },
  'Question 2',
  'Question 3'
]).then((result) => {
  if (result.value) {
    Swal.fire({
      title: 'All done!',
      html:
        'Your answers: <pre><code>' +
          JSON.stringify(result.value) +
        '</code></pre>',
      confirmButtonText: 'Lovely!'
    })
  }
})
})

</script>

@endsection
