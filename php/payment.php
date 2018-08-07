
<script type="text/javascript">
$(document).ready(function () {
            //Token
            $.ajax({
                        url: "token.php",
                        type: 'POST',
                        contentType: 'application/json',
                        success: function (data) {
                            console.log('got data from token  ..');
                        }
                    });

            var paymentConfig= {
            createCheckoutURL: "createpayment.php",
            executeCheckoutURL: "executepayment.php",
            };


            var paymentRequest;
            paymentRequest = { amount: '10', invoice: 'duInvoice001' };

            bKash.init({

                paymentMode: 'checkout',

                paymentRequest: paymentRequest,


                createRequest: function (request) {

                    console.log('=> createRequest (request) :: ');
                    console.log(request);


                    $.ajax({
                        url: paymentConfig.createCheckoutURL+"?amount="+paymentRequest.amount,
                        type: 'GET',
                        contentType: 'application/json',
                        success: function (data) {
                            console.log('got data from create  ..');
                            console.log('data ::=>');
                            console.log(JSON.parse(data).paymentID);
                            data = JSON.parse(data);
                            if (data && data.paymentID != null) {
                                paymentID = data.paymentID;
                                bKash.create().onSuccess(data);      
                            } else {
                                bKash.create().onError();
                            }
                        },
                        error: function () {
                            bKash.create().onError();

                        }
                    });

                },
                executeRequestOnAuthorization: function () {

                    console.log('=> executeRequestOnAuthorization');
                    $.ajax({
                        url: paymentConfig.executeCheckoutURL+"?paymentID="+paymentID,
                        type: 'GET',
                        contentType: 'application/json',
                        success: function (data) {

                            console.log('got data from execute  ..');
                            console.log('data ::=>');
                            console.log(JSON.stringify(data));
                            data = JSON.parse(data);
                            if (data && data.paymentID != null) {
                                window.location.href = "success.html";//your success page

                            } else {
                                bKash.execute().onError();
                            }
                        },
                        error: function () {
                            bKash.execute().onError();
                        }
                    });
                }
            });
        });


</script>
