<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    <link rel="stylesheet" href="../../assets/styles/billing.css">
    <link rel="stylesheet" href="../../assets/styles/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
                </button>
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
            <div class="modal-footer border-none">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
</div>
</div>   
</section>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            searching: true,  
            ordering: true,   
            paging: true,     
            lengthMenu: [10, 25, 50, 100],  
            pageLength: 10,
            responsive: true   
        });
    });

    function viewSample(sampleNo,subtotal,discountAmount,netTotal) {
    console.log(sampleNo,subtotal,discountAmount,netTotal);
    $("#invoiceModal").modal("show");
    $.ajax({
		url: "http://localhost/task/index.php/Patient/invoiceDetails",
		type: "POST",
        data:{ sampleNo: sampleNo },
		dataType: "json",
		success: function (response) {
            if(response){
                var upperSection = $(".upper-section");
                upperSection.empty();
                var leftSection = $("<div class='left-section'></div>");
                leftSection.append(`<p><strong>Patient ID:</strong> ${response[0].PatientID}</p>`);
                leftSection.append(`<p><strong>Patient Name:</strong> ${response[0].Name}</p>`);
                leftSection.append(`<p><strong>Age:</strong> ${response[0].Age}</p>`);
                leftSection.append(`<p><strong>Gender:</strong> ${response[0].Gender}</p>`);
                leftSection.append(`<p><strong>Address:</strong> ${response[0].Address}</p>`);
                upperSection.append(leftSection);
                var rightSection = $("<div class='right-section'></div>");
                rightSection.append(`<p><strong>DateTime:</strong> ${response[0].DateTime}</p>`);
                upperSection.append(rightSection);

            var tableBody = $("#table-body");
            tableBody.empty();
            $.each(response, function (index, row) {
            var newRow = $("<tr></tr>");
            if (index === 0) {
            newRow.append(`<td rowspan="${response.length}">${row.SampleNo}</td>`);
            }   
            newRow.append(`<td>${row.TestItems}</td>`);
            newRow.append(`<td>${row.Qty}</td>`);
            newRow.append(`<td>${row.UnitPrice}</td>`);
            newRow.append(`<td>${row.DiscountPercent}</td>`);
            tableBody.append(newRow);   
        });
        var lowerSection = $(".lower-section");
        lowerSection.empty();
        lowerSection.append(`<h5><strong>Sub Total:</strong> Rs.${subtotal}</h5>`);
        lowerSection.append(`<h5><strong>Total Discount Amount:</strong> Rs.${discountAmount}</h5>`);
        lowerSection.append(`<h5><strong>Grand Total:</strong> Rs.${netTotal}</h5>`);
        }
        },
        error: function (xhr, status, error) {
			console.error(error);
		},
    });
}
</script>
</body>
</html>