<?php
//product.php

include('database_connection.php');
include('function.php');

if (!isset($_SESSION["type"])) {
    header('location:login.php');
}

if ($_SESSION['type'] != 'master') {
    header('location:index.php');
}

include('header.php');
?>
<span id='alert_action'></span>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                        <h3 class="panel-title">Product List</h3>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align='right'>
                        <button type="button" name="add" id="add_button" class="btn btn-success btn-xs">Add</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row"><div class="col-sm-12 table-responsive">
                        <table id="product_data" class="table table-bordered table-striped">
                            <thead><tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Product Code</th>
                                    <th>Product Code Internal</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Enter By</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr></thead>
                        </table>
                    </div></div>
            </div>
        </div>
    </div>
</div>

<div id="productModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="product_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
                </div>
                <div class="modal-body">
                    <span id="alert_action_model"></span>
                    <div class="form-group">
                        <label>Select Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php echo fill_category_list($connect); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control" required>
                            <option value="">Select Brand</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Enter Product Code</label>
                        <input type="text" name="product_code" id="product_code" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Enter Product Code Internal</label>
                        <input type="text" name="product_code_other" id="product_code_other" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Enter Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Enter Product Description</label>
                        <textarea name="product_description" id="product_description" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Enter Product Quantity</label>
                        <div class="input-group">
                            <input type="text" name="product_quantity" id="product_quantity" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" /> 
                            <span class="input-group-addon">
                                <select name="product_unit" id="product_unit" required>
                                    <option value="">Select Unit</option>
                                    <option value="Bags">Bags</option>
                                    <option value="Bottles">Bottles</option>
                                    <option value="Box">Box</option>
                                    <option value="Dozens">Dozens</option>
                                    <option value="Feet">Feet</option>
                                    <option value="Gallon">Gallon</option>
                                    <option value="Grams">Grams</option>
                                    <option value="Inch">Inch</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Liters">Liters</option>
                                    <option value="Meter">Meter</option>
                                    <option value="Nos">Nos</option>
                                    <option value="Packet">Packet</option>
                                    <option value="Rolls">Rolls</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="1" name="is_gst" id="is_gst" >Is GST?</label>
                    </div>
                    <div class="form-group">
                        <label>Enter Product Bill Price</label>
                        <input type="text" name="bill_base_price" id="bill_base_price" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                    </div>
                    <div class="form-group">
                        <label>Enter Product Bill Net Price</label>
                        <input type="text" name="bill_net_price" id="bill_net_price" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                    </div>
                    <div class="form-group">
                        <label>Enter Product Base Price</label>
                        <input type="text" name="product_base_price" id="product_base_price" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                    </div>
                    <div class="form-group">
                        <label>Enter Product Tax (%)</label>
                        <input type="text" disabled="disabled" value="0" name="product_tax" id="product_tax" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                    </div>
                    <div class="form-group">
                        <label>Product Net Price</label>
                        <input type="text" disabled="disabled" name="product_net_price" id="product_net_price" class="form-control" required pattern="[+-]?([0-9]*[.])?[0-9]+" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="product_id" id="product_id" />
                    <input type="hidden" name="btn_action" id="btn_action" />
                    <input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="productdetailsModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="product_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Product Details</h4>
                </div>
                <div class="modal-body">
                    <Div id="product_details"></Div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        var productdataTable = $('#product_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "product_fetch.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": [9, 10, 11],
                    "orderable": false,
                }
            ],
            "pageLength": 10
        });

        $('#add_button').click(function () {
            $("#alert_action_model").html("");
            $('#productModal').modal('show');
            $('#product_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add Product");
            $('#action').val("Add");
            $('#btn_action').val("Add");

            $('#is_gst').change(function () {
                if ($(this).is(":checked")) {
                    $(this).attr("checked", true);
                    $("#product_tax").removeAttr("disabled");
                    $("#product_tax").val("18");
                    $('#product_net_price').val(findTax());
                } else {
                    $("#product_tax").attr("disabled", "disabled");
                    $("#product_tax").val("0");
                    $('#product_net_price').val(findTax());
                }
                $('#is_gst').val($(this).is(':checked'));
            });

            $('#product_base_price, #product_tax').keyup(function () {
                if ($('#is_gst').is(":checked")) {
                    $('#product_net_price').val(findTax());
                } else {
                    $('#product_net_price').val($(this).val());
                }
            });

        });

        function findTax() {
            return parseFloat($('#product_base_price').val()) + parseFloat(($('#product_base_price').val() * $('#product_tax').val() / 100));
        }

        $('#category_id').change(function () {
            var category_id = $('#category_id').val();
            var btn_action = 'load_brand';
            $.ajax({
                url: "product_action.php",
                method: "POST",
                data: {category_id: category_id, btn_action: btn_action},
                success: function (data)
                {
                    $('#brand_id').html(data);
                }
            });
        });

        $(document).on('submit', '#product_form', function (event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            // Find disabled inputs, and remove the "disabled" attribute
            var disabled = $(this).find(':input:disabled').removeAttr('disabled');
            var form_data = $(this).serialize();
            // re-disabled the set of inputs that you previously enabled
            disabled.attr('disabled', 'disabled');
            $.ajax({
                url: "product_action.php",
                method: "POST",
                data: form_data,
                success: function (data)
                {
                    if (data == "PCODE") {
                        $("#alert_action_model").html('<div class="alert alert-danger">' + "Product code is already exists!!" + '</div>');
                        $("#product_code").focus();
                        $('#action').removeAttr('disabled');
                    } else {
                        $('#product_form')[0].reset();
                        $('#productModal').modal('hide');
                        $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                        $('#action').attr('disabled', false);
                        productdataTable.ajax.reload();
                    }
                }
            })
        });

        $(document).on('click', '.view', function () {
            var product_id = $(this).attr("id");
            var btn_action = 'product_details';
            $.ajax({
                url: "product_action.php",
                method: "POST",
                data: {product_id: product_id, btn_action: btn_action},
                success: function (data) {
                    $('#productdetailsModal').modal('show');
                    $('#product_details').html(data);
                }
            })
        });

        $(document).on('click', '.update', function () {
            var product_id = $(this).attr("id");
            var btn_action = 'fetch_single';
            $.ajax({
                url: "product_action.php",
                method: "POST",
                data: {product_id: product_id, btn_action: btn_action},
                dataType: "json",
                success: function (data) {
                    $('#productModal').modal('show');
                    $('#category_id').val(data.category_id);
                    $('#brand_id').html(data.brand_select_box);
                    $('#brand_id').val(data.brand_id);
                    $('#product_code').val(data.product_code);
                    $('#product_code_other').val(data.product_code_other);
                    $('#product_name').val(data.product_name);
                    $('#product_description').val(data.product_description);
                    $('#product_quantity').val(data.product_quantity);
                    $('#product_unit').val(data.product_unit);
                    $('#product_base_price').val(data.product_base_price);
                    $('#product_tax').val(data.product_tax);
                    $('#bill_base_price').val(data.bill_base_price);
                    $('#bill_net_price').val(data.bill_net_price);
                    $('#product_net_price').val(data.product_net_price);
                    $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Product");
                    $('#product_id').val(product_id);
                    $('#action').val("Edit");
                    $('#btn_action').val("Edit");
                }
            })
        });

        $(document).on('click', '.delete', function () {
            var product_id = $(this).attr("id");
            var status = $(this).data("status");
            var btn_action = 'delete';
            if (confirm("Are you sure you want to change status?"))
            {
                $.ajax({
                    url: "product_action.php",
                    method: "POST",
                    data: {product_id: product_id, status: status, btn_action: btn_action},
                    success: function (data) {
                        $('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
                        productdataTable.ajax.reload();
                    }
                });
            } else
            {
                return false;
            }
        });

    });
</script>
