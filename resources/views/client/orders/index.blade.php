 <!-- Featured Start -->
 @extends('client.layouts.app')
 @section('title', 'Home')
 @section('content')
     <div class="container-fluid pt-5">
         @if (session('message'))
             <h1 class="text-primary">{{ session('message') }}</h1>
         @endif


         <div class="col">
             <div>
                 <table class="table table-hover">
                     <tr>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Note</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Product</th>
                        <th>Qty</th>


                     </tr>

                     @foreach ($orders as $item)
                         <tr>
                            <td>
                                @if ($item->status == 'Pending')
                                    <form action="{{ route('client.orders.cancel', $item->id) }}"
                                        id="form-cancel{{ $item->id }}" method="post">
                                        @csrf
                                        <button class="btn btn-cancel btn-danger" data-id={{ $item->id }}>Cancel
                                            Order</button>
                                    </form>
                                @else
                            {{ $item->status }}
                               @endif
                           </td>
                           <td>{{ $item->customer_name }}</td>
                           <td>{{ $item->customer_phone }}</td>
                           <td>{{ $item->customer_email }}</td>
                           <td>{{ $item->customer_address }}</td>
                           <td>{{ $item->note }}</td>
                           <td>{{ $item->payment }}</td>
                           <td>${{ $item->total }}</td>
                           @foreach ($item->orderdetails as $items)
                           <tr>                            <td>
                            @if ($item->status == 'Success')
                                <form action="{{ route('client.orders.cancel', $item->id) }}"
                                    id="form-cancel{{ $item->id }}" method="post">
                                    @csrf
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Review</button>
                                </form>
                            @else
                            +
                           @endif
                       </td><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
                               <td>{{ $items->product->name }}</td>
                               <td>{{ $items->quantity }}</td>
                           
                           @endforeach
                           

                     </tr>
                     @endforeach
                 </table>
                 {{ $orders->links() }}
             </div>
         </div>

     </div>
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Recipient:</label>
                  <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Message:</label>
                  <textarea class="form-control" id="message-text"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Send message</button>
            </div>
          </div>
        </div>
      </div>
 @endsection
 @section('script')
     <script>
         $(function() {

             $(document).on("click", ".btn-cancel", function(e) {
                 e.preventDefault();
                 let id = $(this).data("id");
                 confirmDelete()
                     .then(function() {
                         $(`#form-cancel${id}`).submit();
                     })
                     .catch();
             });

         });
     </script>


 @endsection
