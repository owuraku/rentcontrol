<!--===============================================================================================-->
<script type="text/javascript" src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('vendor/gijgo/gijgo.min.js')}}"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/slick-custom.js')}}"></script>

<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{asset('vendor/lightbox2/js/lightbox.min.js')}}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.validate.min.js')}}"></script>

    <script type="text/javascript">
    function payment(url, id)
    {
        Swal.mixin({
        confirmButtonText: 'Next &rarr;',
        showCancelButton: true,
        progressSteps: ['1', '2', '3']
        }).queue([
                {
                    title: 'Enter Payment Method',
                    input: 'select',
                    inputOptions: {
                    'visa': 'Visa/Master Card',
                    'receipt': 'Receipt ',
                    'momo': 'Mobile Money(All networks)',
                    },
                    inputPlaceholder: 'Select a payment method',
                },
                {
                    title: 'Enter  Number',
                    text: 'Card/Phone Number/Receipt Number',
                    input: 'text',
                },
                {
                    title: 'Enter Payment Amount',
                    text: 'Enter the amount to be deducted from your account (If receipt leave empty)',
                    input: 'text',
                }
                ]).then((result) =>
                {
                    if("undefined"== typeof result.value) return false;
                    let type = result.value[0];
                    let number = result.value[1];
                    let amount = result.value[2];
                    let error;
                        if(type==="" || number==="")error = "Please enter all fields";
                        if(type==="receipt"&&amount==="")amount=0;
                        if(type!="receipt"&& (amount==="" || isNaN(amount) || amount<0 ))error = "Please enter a valid amount";
                        if(type==="momo"&& (number.lenght<10 || isNaN(number)) )error = "Please enter a valid mobile number";
                        if(error)
                        {
                            Swal.fire('Sorry Payment Unsuccessful! '+error,'', 'error');
                            return false;
                        }
                    let formdata = new FormData();
                    formdata.append('id', id);
                    formdata.append('_token', '{{csrf_token()}}')
                    formdata.append('type', type);
                    formdata.append('amount', amount);
                    formdata.append('number', number);
                    $.ajax({
                        url:url,
                        type: 'post',
                        data:formdata,
                        processData: false,
                        cache: false,
                        contentType:false,
                        dataType: 'json'
                    }).done(function(response)
                    {
                        if(response.errors)
                        {
                        Swal.fire(response.errors,'', 'error');
                        }
                        else
                        {
                        Swal.fire(response.message,'', 'info');
                        window.location.reload(true);
                        }

                    })
                });
    }
	</script>

<!--===============================================================================================-->
    <script src="{{asset('js/main.js')}}"></script>
