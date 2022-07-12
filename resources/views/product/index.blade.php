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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </p>
    </div>
</div>
{{--  --}}

  <!-- Add Product Modal -->
  <div class="modal fade" id="AddProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddProductModalLabel" aria-hidden="true">
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
  {{-- End Add Product Modal --}}

  {{-- edit product modal --}}
  <div class="modal fade" id="EditProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditProductModalLabel">Edit Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- showing message/response --}}
            <ul class="list-unstyled" id="save_msgList"></ul>
            {{-- productName --}}
          <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text"
              class="form-control" name="name" id="editProductName" aria-describedby="helpId" placeholder="product name">
          </div>
          {{-- addProductDescription --}}
          <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="editProductDescription" placeholder="product description" rows="3"></textarea>
          </div>
           {{-- productPrice--}}
          <div class="mb-3">
            <label for="" class="form-label">Price</label>
            <input type="text"
              class="form-control" name="price" id="editProductPrice" aria-describedby="helpId" placeholder="product price">
          </div>
           {{-- productQuantity--}}
           <div class="mb-3">
            <label for="" class="form-label">Quantity</label>
            <input type="text"
              class="form-control" name="quantity" id="editProductQuantity" aria-describedby="helpId" placeholder="product quantity">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="edit_product">Add</button>
        </div>
      </div>
    </div>
  </div>
  {{-- end edit product modal --}}

  {{-- Delete Product Modal --}}
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Confirm to Delete Data ?</h4>
                    <input type="hidden" id="deleteing_product">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_product">Yes Delete</button>
                </div>
            </div>
        </div>
    </div>
{{-- End Product Delete Modal --}}
  
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // console.log("hello, I am working")

            // insert/add product
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
                            // after added data fetch all product to get instant new inserted data in UI
                            getAllProduct()
                        }
                        
                    }
                });
            })

            // getAllProduct
            getAllProduct()

            function getAllProduct(){
                $.ajax({
                    type: "GET",
                    url: "/products",
                    dataType: "json",
                    success: function (response) {
                        // before show data in UI, tbody should empty, otherwise data will repetitive
                        $('tbody').html("");
                        $.each(response.products, function (key, product) { 
                            // console.log(key, product);
                            $('tbody').append('<tr class="">\
                                <td scope="row">'+product.id+'</td>\
                                <td>'+product.name+'</td>\
                                <td>'+product.price+'</td>\
                                <td>\
                                    <button type="button" value="' + product.id + '" class="btn btn-primary viewbtn">View Product</button>\
                                    <button type="button" value="' + product.id + '" class="btn btn-primary editbtn">Edit Product</button>\
                                    <button type="button" value="' + product.id + '" class="btn btn-danger deletebtn">Delete Product</button>\
                                </td>\
                             </tr>')
                        });
                    }
                });
            }

            // edit a specific Product Information
            $(document).on('click', '.editbtn', function (e) {
                e.preventDefault();
                var product_id = $('.editbtn').val();
                $('#editProductModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/products/" + product_id,
                    success: function (response) {
                        if (response.status == 404) {
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#editProductModal').modal('hide');
                        } else {
                            console.log(response.product);
                            $('#editProductName').val(response.product.name);
                            $('#editProductDescription').val(response.product.description);
                            $('#editProductPrice').val(response.product.price);
                            $('#editProductQuantity').val(response.product.quantity);
                            $('#product_id').val(product_id);
                        }
                    }
                });
                $('.btn-close').find('input').val('');
            })
            

            // delete a specific Product
            $(document).on('click', '.deletebtn', function (e) {
                e.preventDefault();
                var product_id = $('.deletebtn').val();
                // console.log($(this).val());
                $('#DeleteModal').modal('show');
                $('#deleteing_product').val(product_id);
            });

            $(document).on('click', '.delete_product', function (e) {
                e.preventDefault();

                $(this).text('Deleting...');
                var id = $('#deleteing_product').val();

                $.ajax({
                    type: "DELETE",
                    url: "/products/" + id,
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        if (response.status == 404) {
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.delete_product').text('Yes Delete');
                        } else {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('.delete_product').text('Yes Delete');
                            $('#DeleteModal').modal('hide');
                            getAllProduct();
                        }
                    }
                });
            });
            // end product deleting
        });
    </script>
@endsection
