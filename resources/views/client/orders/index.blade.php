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
                           <tr>
                                                 
                            @if ($item->status == 'Success')
                            <td>
                                @if ($items->product->ratings->count() > 0)
                                <button type="button" class="btn btn-primary modal-review" disabled>Reviewed</button>
                                @else
                                <button type="button" class="btn btn-primary modal-review" data-toggle="modal" data-target="#exampleModal" data-id={{ $items->product_id }}>Review</button>
                                @endif
                            </td>
                            @else
                            <td>+</td>
                           @endif
                       <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>
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
              <h5 class="modal-title" id="exampleModalLabel">New review</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="form-review" method="POST" action="{{ route('client.orders.review') }}">
                    @csrf
                <input type="hidden" name="id">
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Rate:</label>
                  {{-- <input type="number" name="rate" class="form-control" id="recipient-name"> --}}
                  <input id="input-id" name="rate" type="text" class="rating" data-size="lg" >
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Comment:</label>
                  <textarea class="form-control" name="comment" id="message-text"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" form="form-review" id="button-review" class="btn btn-primary">Submit</button>
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

             $('.modal-review').on('click', function (e) {
                var id = $(this).data("id");
            $(".modal .modal-body input[name='id']").val(id);

            $("#input-id").rating();
        })

         });
     </script>


 @endsection
