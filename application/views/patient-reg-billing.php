<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body{
        font-size:16px;
    }
    .navbar {
        background-color: rgb(41, 37, 97);
        padding: 1rem 1.5rem;
    }

    .navbar-brand {
        color: #fff;
        font-weight: bold;
        text-decoration: none;
    }

    .navbar-brand:hover {
        color: #fff;
    }

    .form-inline {
        display: flex;
        align-items: center;
    }

    /* Navigation links styles */
    .navbar li {
        list-style-type: none;
    }

    .navbar li a {
        color: #fff;
        text-decoration: none;
        margin-left: 10px;
    }

    .navbar li a:hover {
        color: #fff;
        text-decoration: underline;
    }
    ::placeholder {
    font-size: 0.75rem;
    color: gray;
  }
  .table td {
    padding: 0.4rem!important;
    vertical-align: middle;
    font-size:12px;
}

select.form-control option {
  font-size:10px;
  color: gray;
  }

  .backg{
    background-color: rgb(41, 37, 97) !important;
  }

 .grand-total-section {
  background-color: lightgray;
  padding: 10px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.grand-total-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}

.grand-total-section .grand-total {
  font-size: 18px;
  font-weight: bold;
  margin-right: 10px;
}

.grand-total-section .input-field {
  padding: 5px;
  border: 1px solid gray;
  border-radius: 4px;
  margin-right: 10px;
}

.grand-total-section .btn {
  margin-left: 10px;
  align-self: flex-end;
  margin-top:1rem;
}
</style>
</head>
<body>
  <!-- <p><?php echo $value?></p> -->
    <?php include('navbar.php'); ?>
    <section class="py-3">
    <h5 class="pl-4 text-capitalize">Billing and Reg</p>
    <div class="container-fluid mx-0 px-3">
      <!-- Insert Confirmation Modal -->
    <div class="modal fade" id="insertConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="insertConfirmationModalCenterTitle" aria-hidden="true" data-backdrop="static"  data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header border-none">
                <h5 class="modal-title" id="insertConfirmationModalLongTitle">Confirmation Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body preview-body" id="insertConfirmationModalBody">
              <span>Data Inserted Successfully.</span>
            </div>
            <div class="modal-footer border-none">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
  <table class="table table-bordered text-center">
    <thead class="backg">
      <tr>
      <th>
        <select id="test-item" class="form-control test-items" required>
          <option value="" disabled selected style="font-size: 12px;">Test Item</option>
        </select>
      </th>
      <th>
        <select id="unit-price" class="form-control" required>
          <option value="" disabled selected style="font-size: 12px;">Unit Price</option>
        </select>  
      </th>
      <th>
        <input type="number" id="quantity" class="form-control" placeholder="Quantity" required min="1" max="100" value="1">
      </th>
      <th>
        <input type="number" id="total-price" class="form-control" placeholder="Total Price" readonly required>
      </th>
      <th>
        <input type="number" id="discount-percent" class="form-control" placeholder="Discount Percent" min="0" value="0" max="100" required>
      </th>
      <th>
        <input type="number" id="discount-amount" class="form-control" placeholder="Discount Amount" readonly required>
      </th>
      <th>
        <input type="number" id="net-total" class="form-control" placeholder="Net Total" required readonly>
      </th>
      <th>
        <button type="submit" id="add-button" class="btn btn-primary">ADD</button>
      </th>
    </tr>
      <tr class="text-white">
        <td>Test Items</td>
        <td>Unit Price</td>
        <td>Quantity</td>
        <td>Total Price</td>
        <td>Discount Percent</td>
        <td>Discount Amount</td>
        <td>Net Total</td>
        <td>Action</td>
      </tr>
    </thead>
    <tbody  id="table-body">
    </tbody>
  </table>
  <section class="grand-total-section">
  <div class="grand-total-container">
    <div id="grand-total" class="grand-total">Grand Total:</div>
    <div class="input-field-container">
      <span>Rs.</span>
      <input type="number" class="input-field" id="grand-total-price" readonly>
    </div>    
  </div>
  <button class="btn btn-success" onclick="generateBill()">Save</button>
</section>
</div>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="/task/assets/javascript/patient-reg-billing.js"></script>
</body>
</html>