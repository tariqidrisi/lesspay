@extends('admin.admin')
@section('content')

  @include('admin.header')

  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="form_main">
           <h4 class="heading"><strong>Edit </strong> Product <span></span></h4>
           <div class="form">
              <form action="{{ route('editProduct') }}" method="post" id="addProduct" name="addProduct" role="form" enctype="multipart/form-data">
                 @csrf

                 <input type="hidden" name="id" value="{{ $data->id }}">
                 <input type="text" required="" placeholder="Product Id" value="{{ $data->product_id }}" name="product_id" class="txt">
                 <input type="text" required="" placeholder="Product Name" value="{{ $data->name }}" name="name" class="txt">
                 <input type="text" required="" placeholder="Product Price" value="{{ $data->price }}" name="price" class="txt">
                 <input type="file" name="file" id="prod-img">
                 <img src="{{ env('APP_URL') }}{{ Storage::url($data->image) }}" name="img" id="prod-img-tag" width="200px" style="display: block" />
                 <input type="submit" value="Update" name="submit" class="txt2">
              </form>
           </div>
        </div>
        </div>
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

        function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              
              reader.onload = function (e) {
                  $('#prod-img-tag').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
        }
        $("#prod-img").change(function(){
            readURL(this);
        });
    });
  </script>
@endsection