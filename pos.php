<?php
include_once "includes/dbcon.php";
session_start();

if ($_SESSION['useremail'] == "") {

  header('location:../index.php');
}

include_once "includes/header.php";


function fil_product($pdo)
{

  $output = '';
  $select = $pdo->prepare("select * from tbl_product order by product asc");

  $select->execute();

  $result = $select->fetchAll();

  foreach ($result as $row) {

    $output .= '<option value="' . $row["pid"] . '">' . $row["product"] . '</option>';
  }

  return $output;;
}

$select = $pdo->prepare("select * from tbl_taxdis where taxdis_id =1");
$select->execute();
$row = $select->fetch(PDO::FETCH_OBJ);


?>



<style type="text/css">
  .tableFixHead {
    Overflow: scroll;
    height: 520px;
  }

  .tableFixHead thead th {
    position: fixed;
    top: 0;
    z-index: 1;
  }

  table {
    border-collapse: collapse;
    width: 100px;
  }

  th,
  td {
    padding: 8px 16px;
  }

  th {
    background: #eee;
  }
</style>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">Point Of Sale</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h5 class="m-0">POS</h5>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-md-8">

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Scan Barcode" id="txtbarcode_id">
                  </div>



                  <select class="form-control select2" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    <option>Select Or Search</option><?php echo fil_product($pdo); ?>

                  </select>


                  <div class="tableFixHead">

                    <table id="producttable" class="table table-bordered table-hover">

                      </br>

                      <tr>
                        <th>Product</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th> QTY</th>
                        <th>Total</th>
                        <th>Del</th>
                      </tr>





                      <tbody class="details" id="itemtable">
                        <tr data-widget="expandable-table" aria-expanded="false">

                        </tr>
                      </tbody>
                    </table>


                  </div>




                </div>

                <div class="col-md-4">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">SUBTOTAL(Rs)</span>
                    </div>
                    <input type="text" class="form-control" id="txtsubtotal_id" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">Rs</span>
                    </div>
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">DISCOUNT(%)</span>
                    </div>
                    <input type="text" class="form-control" id="txtdiscount_p" value="<?php echo $row->discount; ?>">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">DISCOUNT(Rs)</span>
                    </div>
                    <input type="text" class="form-control" id="txtdiscount_n" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">Rs</span>
                    </div>
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">SGST(%)</span>
                    </div>
                    <input type="text" class="form-control" id="txtsgst_id_p" value="<?php echo $row->sgst; ?>" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">CGST(%)</span>
                    </div>
                    <input type="text" class="form-control" id="txtcgst_id_p" value="<?php echo $row->cgst; ?>" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>


                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">SGST(Rs)</span>
                    </div>
                    <input type="text" class="form-control" id="txtsgst_id_n" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">Rs</span>
                    </div>
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">CGST(Rs)</span>
                    </div>
                    <input type="text" class="form-control" id="txtcgst_id_n" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">Rs</span>
                    </div>
                  </div>

                  <hr style="height: 2px; border-width:0; color:black; background-color:black;">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">TOTAL(Rs)</span>
                    </div>
                    <input type="text" class="form-control form-control-lg total" id="txttotal" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">Rs</span>
                    </div>
                  </div>

                  <hr style="height: 2px; border-width:0; color:black; background-color:black;">


                  <div class="icheck-success d-inline">
                    <input type="radio" name="r3" checked id="radioSuccess1">
                    <label for="radioSuccess1">CASH
                    </label>
                  </div>
                  <div class="icheck-primary d-inline">
                    <input type="radio" name="r3" id="radioSuccess2">
                    <label for="radioSuccess2">CARD
                    </label>
                  </div>
                  <div class="icheck-danger d-inline">
                    <input type="radio" name="r3" id="radioSuccess3">
                    <label for="radioSuccess3">
                      CHECK
                    </label>
                  </div>

                  <hr style="height: 2px; border-width:0; color:black; background-color:black;">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">DUE(Rs)</span>
                    </div>
                    <input type="text" class="form-control" id="txtdue" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">Rs</span>
                    </div>
                  </div>


                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">PAID(Rs)</span>
                    </div>
                    <input type="text" class="form-control" id="txtpaid">
                    <div class="input-group-append">
                      <span class="input-group-text">Rs</span>
                    </div>
                  </div>

                  <hr style="height: 2px; border-width:0; color:black; background-color:black;">

                  <div class="card-footer">
                    <input type="button" value="Save Order" class="btn btn-primary">
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<?php

include_once "includes/footer.php"


?>


<script>
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap5'
  })


  var productarr = [];
  $(function() {
    $('#txtbarcode_id').on('change', function() {

      var barcode = $("#txtbarcode_id").val();

      $.ajax({
        url: "getproduct.php",
        method: "get",
        dataType: "json",
        data: {
          id: barcode
        },
        success: function(data) {
          //alert("pid");

          //console.log(data);

          if (jQuery.inArray(data["pid"], productarr) !== -1) {

            var actualqty = parseInt($('#qty_id' + data["pid"]).val()) + 1;
            $('#qty_id' + data["pid"]).val(actualqty);

            var saleprice = parseInt(actualqty) * data["saleprice"];

            $('#saleprice_id' + data["pid"]).html(saleprice);
            $('#saleprice_idd' + data["pid"]).val(saleprice);

            $("#txtbarcode_id").val("");



          } else {

            addrow(data["pid"], data["product"], data["saleprice"], data["stock"], data["barcode"]);

            productarr.push(data["pid"]);

            $("#txtbarcode_id").val("");

            function addrow(pid, product, saleprice, stock, barcode) {

              var tr = '<tr>' +
                '<td style="text-align:left; vertical-align:middle; font-size:17px;"><class= "form-control product_c" name="product_arr[]" <span class="badge badge-dark">' + product + '</span><input type="hidden" class="form-control pid" name="pid_arr[]" value="' + pid + '"><input type="hidden" class="form-control product" name="product_arr[]" value="' + product + '" ></td>' +

                '<td style="text-align:left; vertical-align:middle; font-size:17px;"><span class="badge badge-primary stocklbl" name="stock_arr[]" id="stock_id' + pid + '">' + stock + '</span><input type="hidden" class="form-control stock_c" name="stock_c_arr[]" id="stock_idd' + pid + '" value= "' + stock + '"></td>' +

                '<td style="text-align:left; vertical-align:middle; font-size:17px;"><span class="badge badge-warning price" name="price_arr[]" id="price_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control price_c" name="price_c_arr[]" id="price_idd' + pid + '" value= "' + saleprice + '"></td>' +

                '<td><input type="text" class="form-control qty" name="quantity_arr[]" id="qty_id' + pid + '" value="' + 1 + '" size="1"></td>' +

                '<td style="text-align:left; vertical-align:middle; font-size:17px;"><span class="badge badge-danger totalamt" name="netamt_arr[]" id="saleprice_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control saleprice" name="saleprice_arr[]" id="saleprice_idd' + pid + '" value= "' + saleprice + '"></td>' +

                //remove button code

                '<td style="text-align:left; vertical-align:middle;"><name="remove" class="btnremove" data-id="' + pid + '"><span class="fas fa-trash" style="color:red"></span></center></td>' +
                '</tr>';


              $('.details').append(tr);


            } // end function addrow
          }



        } //end of the success function

      }) //end of the ajax request


    }) //end of the onchange function

  }); //end of the main function






  // fatching deta in scroll bar start



  var productarr = [];
  $(function() {
    $('.select2').on('change', function() {

      var productid = $(".select2").val();

      $.ajax({
        url: "getproduct.php",
        method: "get",
        dataType: "json",
        data: {
          id: productid
        },
        success: function(data) {
          //alert("pid");

          console.log(data);

          if (jQuery.inArray(data["pid"], productarr) !== -1) {

            var actualqty = parseInt($('#qty_id' + data["pid"]).val()) + 1;
            $('#qty_id' + data["pid"]).val(actualqty);

            var saleprice = parseInt(actualqty) * data["saleprice"];

            $('#saleprice_id' + data["pid"]).html(saleprice);
            $('#saleprice_idd' + data["pid"]).val(saleprice);

            $("#txtbarcode_id").val("");

            calculate();

          } else {

            addrow(data["pid"], data["product"], data["saleprice"], data["stock"], data["barcode"]);

            productarr.push(data["pid"]);

            $("#txtbarcode_id").val("");

            function addrow(pid, product, saleprice, stock, barcode) {

              var tr = '<tr>' +
                '<td style="text-align:left; vertical-align:middle; font-size:17px;"><class= "form-control product_c" name="product_arr[]" <span class="badge badge-dark">' + product + '</span><input type="hidden" class="form-control pid" name="pid_arr[]" value="' + pid + '"><input type="hidden" class="form-control product" name="product_arr[]" value="' + product + '" ></td>' +

                '<td style="text-align:left; vertical-align:middle; font-size:17px;"><span class="badge badge-primary stocklbl" name="stock_arr[]" id="stock_id' + pid + '">' + stock + '</span><input type="hidden" class="form-control stock_c" name="stock_c_arr[]" id="stock_idd' + pid + '" value= "' + stock + '"></td>' +

                '<td style="text-align:left; vertical-align:middle; font-size:17px;"><span class="badge badge-warning price" name="price_arr[]" id="price_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control price_c" name="price_c_arr[]" id="price_idd' + pid + '" value= "' + saleprice + '"></td>' +

                '<td><input type="text" class="form-control qty" name="quantity_arr[]" id="qty_id' + pid + '" value="' + 1 + '" size="1"></td>' +

                '<td style="text-align:left; vertical-align:middle; font-size:17px;"><span class="badge badge-danger totalamt" name="netamt_arr[]" id="saleprice_id' + pid + '">' + saleprice + '</span><input type="hidden" class="form-control saleprice" name="saleprice_arr[]" id="saleprice_idd' + pid + '" value= "' + saleprice + '"></td>' +

                //remove button code

                '<td style="text-align:left; vertical-align:middle;"><name="remove" class="btnremove" data-id="' + pid + '"><span class="fas fa-trash" style="color:red"></span></center></td>' +
                '</tr>';


              $('.details').append(tr);
              calculate();


            } // end function addrow
          }



        } //end of the success function

      }) //end of the ajax request


    }) //end of the onchange function

  }); //end of the main function

  // fatching deta in scroll bar end












  $("#itemtable").delegate(".qty", "keyup change", function() {

    var quantity = $(this);
    var tr = $(this).parent().parent();

    if ((quantity.val() - 0) > (tr.find(".stock_c").val() - 0)) {

      Swal.fire("WARNING!", "SORRY This Much Of Qyantity Is Not Available", "warning");
      quantity.val(1);

      tr.find(".totalamt").text(quantity.val() * tr.find(".price").text());

      tr.find(".saleprice").val(quantity.val() * tr.find(".price").text());

    } else {

      tr.find(".totalamt").text(quantity.val() * tr.find(".price").text());

      tr.find(".saleprice").val(quantity.val() * tr.find(".price").text());

    }


  });

  // calculating subtotal start 

  function calculate() {

    var subtotal = 0;
    var discount = 0;
    var sgst = 0;
    var cgst = 0;
    var total = 0;
    var paid_amt = 0;
    var due = 0;

    $(".saleprice").each(function() {

      subtotal = subtotal + ($(this).val() * 1);

    });

    $("#txtsubtotal_id").val(subtotal.toFixed(2));

    sgst = parseFloat($("#txtsgst_id_p").val());

    cgst = parseFloat($("#txtcgst_id_p").val());

    discount = parseFloat($("#txtdiscount_p").val());

    sgst = sgst / 100;
    sgst = sgst * sutotal;

    cgst = cgst / 100;
    cgst = cgst * sutotal;

    discount = discount / 100;
    discount = discount * sutotal;

    $("#txtsgst_id_n").val(sgst.toFixed(2));

    $("#txtcgst_id_n").val(cgst.toFixed(2));

    $("#txtdiscount_id_n").val(discount.toFixed(2));

    total=sgst+cgst+subtotal-discount;
    due=total-paid_amt;

    $("#txttotal").val(total.toFixed(2));

    $("#txtdue").val(due.toFixed(2));

    

    










  }

  // calculating subtotal end 
</script>