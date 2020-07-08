@extends('layouts.auth')

<!-------------------------------section------------------------------->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-pen fa-1x" aria-hidden="true">&nbsp;{{ __('Add Item') }}</i></div>

                <div class="card-body">                       

                    <!-------------------------------Add------------------------------->         
                    <form method="POST" action="{{ url('add item') }}">
                        @csrf     
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class=" col-form-label">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                    name="name" value="{{ old('name') }}" />
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="quantity" class=" col-form-label">{{ __('Quantity') }}</label>
                                <input id="quantity" type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                                    name="quantity" value="{{ old('quantity') }}" />
                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="price" class=" col-form-label">{{ __('Price') }}</label>
                                <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" 
                                    name="price" value="{{ old('price') }}" />
                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="total" class=" col-form-label">{{ __('Total') }}</label>
                                <input id="total" type="number" class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" 
                                    name="total" value="{{ old('total') }}" readonly />
                                @if ($errors->has('total'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="col-md-2 pt-2">
                            <div class="form-group">  
                                <label>&nbsp;</label>                       
                                <button type="submit" class="btn btn-dark btn-block">
                                    {{ __('ADD') }}
                                </button> 
                            </div>
                        </div>                         
                </div>
                </form>
                <!-------------------------------./Add------------------------------->  

                <!-------------------------------Table-------------------------------> 
                @if($items->count()>0)
                <form method="GET" action="{{ url('save table items') }}">
                    @csrf   
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantiy</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>   
                        </thead>     
                        <tbody>  
                            @foreach($items as $item)              
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->total}}</td>
                                <td>{{Carbon\Carbon::parse($item->created_at)->format('d M, y') }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#editModal{{$item->id}}">
                                        <button class="btn btn-dark btn-sm"><small>EDIT</small></button></a>
                                    <a href="#" data-toggle="modal" data-target="#deleteModal{{$item->id}}">
                                        <button class="btn btn-danger mr-1 btn-sm"><small>DELETE</small></button></a>
                                </td>
                                <!-----------------------------EditModal---------------------------------->
                                <div class="modal fade" id="editModal{{$item->id}}">
                                    <form method="PUT" action="item/{{$item->id}}/update">
                                        @csrf   
                                    <div class="modal-dialog">
                                        <div class="modal-content">   
                                            <div class="modal-header bg-info text-white">  
                                                <h5><i class="fas fa-pen-square" aria-hidden="true"></i>&nbsp;Edit Item</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>          
                                            </div>
                                            <div class="modal-body">                         
                                                <p class="text-center"><i class="fas fa-info fa-4x"></i></p>                                                               
                                                <p class="text-center"><strong>Coming soon</strong></p>    
                                                {{-- <div class="form-group">
                                                    <label for="name" class=" col-form-label">{{ __('Name') }}</label>
                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                        name="name" value="{{ $item->name }}" />
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity" class=" col-form-label">{{ __('Quantity') }}</label>
                                                    <input id="quantity" type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" 
                                                        name="quantity" value="{{ $item->quantity }}"/>
                                                    @if ($errors->has('quantity'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('quantity') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="price" class=" col-form-label">{{ __('Price') }}</label>
                                                    <input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" 
                                                        name="price" value="{{ $item->price }}" />
                                                    @if ($errors->has('price'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('price') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="total" class=" col-form-label">{{ __('Total') }}</label>
                                                    <input id="total" type="text" class="form-control{{ $errors->has('total') ? ' is-invalid' : '' }}" 
                                                        name="total" value="{{ $item->total }}" />
                                                    @if ($errors->has('total'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('total') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> --}}
                                            </div>    
                                            <div class="modal-footer bg-dark">
                                                <button type="button" class="pull-left btn btn-secondary btn-sm" data-dismiss="modal">Dismiss</button> 
                                                {{-- <button type="submit" class="pull-left btn btn-dark btn-sm">Submit</button>  --}}
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-----------------------------./EditModal---------------------------------->


                                <!-----------------------------DeleteModal---------------------------------->
                                <div class="modal fade" id="deleteModal{{$item->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">   
                                            <div class="modal-header bg-danger text-white">       
                                            </div>
                                            <div class="modal-body">                                                                
                                                <p class="text-center"><i class="fas fa-exclamation-triangle fa-4x"></i></p>                                                               
                                                <p class="text-center"><strong>Delete item?</strong></p>  
                                            </div>    
                                            <div class="modal-footer bg-dark">
                                                <button type="button" class="pull-left btn btn-secondary btn-sm" data-dismiss="modal">No</button> 
                                                <a href="item/{{$item->id}}/delete" class="btn btn-danger btn-sm">Yes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-----------------------------./DeleteModal---------------------------------->

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

                  <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-10">
                        <button type="submit" class="btn btn-dark btn-block">
                            {{ __('Save') }}
                        </button>
                    </div>
                  </div>
                </form>
                @else
                    <p class="p-5 text-center text-muted">No items</p>
                @endif
                <!-------------------------------./Table-------------------------------> 
            
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
