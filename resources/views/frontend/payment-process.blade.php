@extends('frontend.template', ['title'=>'Payment Processing'])

@section('content')
  <h3>Processing...</h3>
  
@endsection

@section('script')
  
  <script>
    function checkTransactionDone() {
      var url = '{{url('api/transactionSuccess?code='.$code)}}';
      //console.log(url);
      axios.get(url)
        .then(function (response) {
          var result = response.data;
          if (result) {
            location.href = '{{url($url)}}';
          } else {
            if (statusCheckingCount >= maxStatusCheckingCount) {
              clearInterval(statusCheckingIdentifier);
              location.href = '{{url('payment/fail?code='.$code)}}';
            }
          }
        })
        .catch(function (error) {
          console.log('payment-process error='+JSON.stringify(error));
        });
      
      statusCheckingCount++;
      if (statusCheckingCount >= maxStatusCheckingCount) {
        clearInterval(statusCheckingIdentifier);
        location.href = "{{ url('payment/fail?code=') }}"
      }
    }
    
    var statusCheckingCount = 0;
    var maxStatusCheckingCount = 30;
    var statusCheckingInterval = 2000;
    var statusCheckingIdentifier;
    $(document).ready(function () {
      statusCheckingIdentifier = setInterval("checkTransactionDone()", statusCheckingInterval);
    });
  </script>
@endsection