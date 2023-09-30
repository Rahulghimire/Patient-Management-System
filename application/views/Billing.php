<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    <link rel="stylesheet" href="../../assets/styles/billing.css">
    <link rel="stylesheet" href="../../assets/styles/navbar.css">
<?php include('header.php'); ?>
</head>
<body>
<?php include('navbar.php'); ?>
<h4 class="m-3 text-uppercase">billing list</h5>
<section class="main-container">
    <div class="table-responsive-sm table-responsive-md text-center">
    <table class="table display"  id="myTable">
    <thead>
        <tr>
            <th>Patient ID</th>
            <th>Sample No</th>
            <th>Billing Date</th>
            <th>Subtotal</th>
            <th>Discount Percent</th>
            <th>Discount Amount</th>
            <th>Net Total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($rows)) {
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>".$row['PatientID']."</td>";
            echo "<td>".$row['SampleNo']."</td>";
            echo "<td>".$row['BillingDate']."</td>";
            echo "<td>".$row['Subtotal']."</td>";
            echo "<td>".$row['DiscountPercent']."</td>";
            echo "<td>".$row['DiscountAmount']."</td>";
            echo "<td>".$row['NetTotal']."</td>";
            echo "<td><button onclick='viewSample(".$row['SampleNo'].", ".$row['Subtotal'].", ".$row['DiscountAmount'].", ".$row['NetTotal'].")' class='btn btn-primary'>View</button></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data available</td></tr>";
    }
    ?>
    </tbody>
</table>
<!-- viewInvoiceModal-------------------------- -->
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLongTitle">Invoice Details</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
                </button> -->
                <div>
                <button id="printButton"  style="background-color: #000; color: #fff; border: none; padding: 5px 10px; border-radius: 5px;">Print</button>
                </div>
            </div>
            <div class="modal-body">
            <div class="upper-section"></div>
            <div class="table-section">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>SampleNo</th>
                            <th>Test Item</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Discount %</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">

                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="lower-section"></div>
            <!-- <div class="modal-footer border-none">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> -->
            </div>
        </div>
</div>
</div>   
</section>
<script>
    $("#printButton").on("click", function () {
    var printableContent = $("#invoiceModal .modal-content").clone();

    var screenWidth = window.screen.width;
    var screenHeight = window.screen.height;

    var printWindow = window.open("", "", "width=" + screenWidth + ",height=" + screenHeight);
    printWindow.document.open();
    printWindow.document.write("<html><head><title>Print</title></head><body>");
    printWindow.document.write(printableContent.html());
    printWindow.document.write("</body></html>");
    printWindow.document.close();

    printWindow.print();
    printWindow.close();
});
</script>
<script src="../../assets/javascript/billing.js"></script>

</body>
</html>