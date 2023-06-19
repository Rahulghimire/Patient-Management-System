$(document).ready(function () {
	$("#myTable").DataTable({
		searching: true,
		ordering: true,
		paging: true,
		lengthMenu: [10, 25, 50, 100],
		pageLength: 10,
		responsive: true,
	});
});

function viewSample(sampleNo, subtotal, discountAmount, netTotal) {
	console.log(sampleNo, subtotal, discountAmount, netTotal);
	$("#invoiceModal").modal("show");
	$.ajax({
		url: "/task/index.php/Patient/invoiceDetails",
		type: "POST",
		data: { sampleNo: sampleNo },
		dataType: "json",
		success: function (response) {
			if (response) {
				var upperSection = $(".upper-section");
				upperSection.empty();
				var leftSection = $("<div class='left-section'></div>");
				leftSection.append(
					`<p><strong>Patient ID:</strong> ${response[0].PatientID}</p>`
				);
				leftSection.append(
					`<p><strong>Patient Name:</strong> ${response[0].Name}</p>`
				);
				leftSection.append(`<p><strong>Age:</strong> ${response[0].Age}</p>`);
				leftSection.append(
					`<p><strong>Gender:</strong> ${response[0].Gender}</p>`
				);
				leftSection.append(
					`<p><strong>Address:</strong> ${response[0].Address}</p>`
				);
				upperSection.append(leftSection);
				var rightSection = $("<div class='right-section'></div>");
				rightSection.append(
					`<p><strong>DateTime:</strong> ${response[0].DateTime}</p>`
				);
				upperSection.append(rightSection);

				var tableBody = $("#table-body");
				tableBody.empty();
				$.each(response, function (index, row) {
					var newRow = $("<tr></tr>");
					if (index === 0) {
						newRow.append(
							`<td rowspan="${response.length}">${row.SampleNo}</td>`
						);
					}
					newRow.append(`<td>${row.TestItems}</td>`);
					newRow.append(`<td>${row.Qty}</td>`);
					newRow.append(`<td>${row.UnitPrice}</td>`);
					newRow.append(`<td>${row.DiscountPercent}</td>`);
					tableBody.append(newRow);
				});
				var lowerSection = $(".lower-section");
				lowerSection.empty();
				lowerSection.append(
					`<h5><strong>Sub Total:</strong> Rs.${subtotal}</h5>`
				);
				lowerSection.append(
					`<h5><strong>Total Discount Amount:</strong> Rs.${discountAmount}</h5>`
				);
				lowerSection.append(
					`<h5><strong>Grand Total:</strong> Rs.${netTotal}</h5>`
				);
			}
		},
		error: function (xhr, status, error) {
			console.error(error);
		},
	});
}
