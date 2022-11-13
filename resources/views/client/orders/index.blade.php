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
                         <th>Name</th>
                         <th>Phone</th>
                         <th>Email</th>
                         <th>Address</th>
                         <th>Product</th>
                         <th>Qty</th>
                         <th>Total</th>
                         <th>Note</th>
                         <th>Payment</th>
                         <th>Status</th>


                     </tr>

                     @foreach ($orders as $item)
                         <tr>
                             {{-- <td>{{ $item->id }}</td> --}}
                             <td>{{ $item->customer_name }}</td>
                             <td>{{ $item->customer_phone }}</td>
                             <td>{{ $item->customer_email }}</td>
                             <td>{{ $item->customer_address }}</td>
                             <td>{{ $item->product_name }}</td>
                             <td>{{ $item->quantity }}</td>
                             <td>${{ $item->total }}</td>
                             <td>{{ $item->note }}</td>
                             <td>{{ $item->payment }}</td>
                             <td>{{ $item->status }}</td>
                             <td>
                                 @if ($item->status == 'Pending')
                                     <form action="{{ route('client.orders.cancel', $item->id) }}"
                                         id="form-cancel{{ $item->id }}" method="post">
                                         @csrf
                                         <button class="btn btn-cancel btn-danger" data-id={{ $item->id }}>Cancel
                                             Order</button>
                                     </form>
                                 @endif

                             </td>
                         </tr>
                     @endforeach
                 </table>
                 {{ $orders->links() }}
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
