@extends('master')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">
            <div class="d-flex justify-content-between">
                <div>Product Detail's</div>
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddProductModal">Add Product</a>
            </div>
        </h4>
        <p class="card-text">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td scope="row">1</td>
                            <td>Walton</td>
                            <td>
                                <a href="" class="btn btn-primary">View Product</a>
                                <a href="" class="btn btn-warning">Edit Product</a>
                                <a href="" class="btn btn-danger">Delete Product</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </p>
    </div>
</div>
    {{--  --}}

  
  <!-- Modal -->
  <div class="modal fade" id="AddProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="AddProductModalLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- showing message/response --}}
            <ul class="list-unstyled" id="save_msgList"></ul>
            {{-- productName --}}
          <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text"
              class="form-control" name="name" id="addProductName" aria-describedby="helpId" placeholder="product name">
          </div>
          {{-- addProductDescription --}}
          <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="addProductDescription" placeholder="product description" rows="3"></textarea>
          </div>
           {{-- productPrice--}}
          <div class="mb-3">
            <label for="" class="form-label">Price</label>
            <input type="text"
              class="form-control" name="price" id="productPrice" aria-describedby="helpId" placeholder="product price">
          </div>
           {{-- productQuantity--}}
           <div class="mb-3">
            <label for="" class="form-label">Quantity</label>
            <input type="text"
              class="form-control" name="quantity" id="productQuantity" aria-describedby="helpId" placeholder="product quantity">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="add_product">Add</button>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // console.log("hello, I am working")
            $('#add_product').on('click',function(e){
                e.preventDefault();
                let productData = {
                    'name': $('#addProductName').val(),
                    'description': $('#addProductDescription').val(),
                    'price': $('#productPrice').val(),
                    'quantity': $('#productQuantity').val(),
                }
                // console.log(productData)
                $.ajax({
                    type: "POST",
                    url: "/products",
                    data: productData,
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 400){
                            $('#save_msgList').html("");
                            $('#save_msgList').addClass('alert alert-danger');
                            $.each(response.errors, function (key,err_value) { 
                                $('#save_msgList').append('<li>' + err_value + '</li>');
                                $('#add_product').text('Try again!');
                            }); 
                        }
                        else{
                            $('#save_msgList').html("");
                            $('#save_msgList').addClass('alert alert-success');
                            $('#save_msgList').text(response.message);
                            $('#AddProductModal').find('input').val('');
                            $('#add_product').text('Saved');
                            $('#AddProductModal').modal('hide');
                        }
                        
                    }
                });
            })
        });
    </script>
@endsection