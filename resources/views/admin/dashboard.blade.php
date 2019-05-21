@extends('admin.admin')
@section('content')
    @include('admin.header')
   
          
          <h2><a href="{{ route('newProd') }}" >+Add Product</a></h2>
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                      <th>Action</th>
                      
                  </tr>
              </thead>
              <tbody>
                @foreach($data as $row)
                  <tr>
                      <td>{{ $row->product_id }}</td>
                      <td>{{ $row->name }}</td>
                      <td>{{ $row->price }}</td>
                      <td>{{ $row->created_at }}</td>
                      <td>{{ $row->updated_at }}</td>
                      <td><a href="{{ route('getProduct', $row->id) }}" style="color:blue">Edit</a> / <a href="{{ route('deleteProduct', $row->id) }}" style="color:red">Delete</a></td>
                      
                  </tr>
                @endforeach 
              </tbody>
              <tfoot>
                  <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                  </tr>
              </tfoot>
          </table>
          </div>
        </main>
      </div>
    </div>

    <script>
      @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
      @endif
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
          $('body').css("padding-top", "0");
          $('#example').DataTable();

          $("#example_wrapper").removeClass("form-inline");
      });
    </script>
    
  </body>
</html>
@endsection
