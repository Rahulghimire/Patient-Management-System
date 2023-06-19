<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Registration</title>
    <?php include('header.php'); ?>
    <link rel="stylesheet" href="/task/assets/styles/patient-reg-billing.css">
</head>
<body>
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
                </button>
            </div>
            <div class="modal-body preview-body" id="insertConfirmationModalBody">
              <span>Data Inserted Successfully.</span>
            </div>
            <div class="modal-footer border-none">
                <button type="button" class="btn btn-primary" ><a class="text-white" href="<?php echo base_url().'index.php/Patient/billing'?>">Go to billing</a></button>
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
<script src="/task/assets/javascript/patient-reg-billing.js"></script>
</body>
</html>