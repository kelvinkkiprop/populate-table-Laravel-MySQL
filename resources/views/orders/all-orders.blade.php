@extends('layouts.auth')

<!-------------------------------section------------------------------->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fas fa-sitemap">&nbsp;{{ __('All Orders') }}</i></div>

                <div class="card-body">                       

                <!-------------------------------Orders Table-------------------------------> 
                @if($orders->count()>0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Voucher code</th>
                                <th>Item</th>
                                <th>Quantiy</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Added On</th>
                            </tr>   
                        </thead>     
                        <tbody>  
                            @foreach($orders as $order)              
                            <tr>
                                <td>{{$order->code}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>{{$order->price}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{Carbon\Carbon::parse($order->created_at)->format('d M, y') }}</td>
                            </tr>
                            @endforeach          
                            {{-- <tr>
                                <td>Soap</td>
                                <td>2</td>
                                <td>300</td>
                                <td>600</td>
                            </tr>            
                            <tr>
                                <td>Soap</td>
                                <td>2</td>
                                <td>300</td>
                                <td>600</td>
                            </tr> --}}
                        </tbody>
                    </table>
                    
                  </div> 
                @else
                    <p class="p-5 text-center text-muted">No orders</p>
                @endif
                <!-------------------------------./Oders Table------------------------------->             
            </div>

                <div class="card-footer">               
                </div>
            </div>        
        </div>
    </div>
</div>


    <!-------------------------------Scripts------------------------------->
    <script>
        $(document).ready(function(){                  

            $('#price').on("change", function (e) {
                //console.log(e);
                var given_price = $(this).val();
                var given_quantity = $('#quantity').val();
                // console.log(given_price)
                // console.log(given_quantity)
                $.get('/compute/'+given_price+'/'+given_quantity+'/item' , function(data){
                    // console.log(data.total);
                    $("#total").val(data.total);
                })
                
            });
        });
    </script>         
    <!-------------------------------./Scripts------------------------------->


@endsection
<!-------------------------------./section------------------------------->
