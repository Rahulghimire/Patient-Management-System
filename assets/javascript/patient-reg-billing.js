let testItems;
var testItemNames;
var unitPrices;
var billingInfoData = new Array();
var billItems = new Array();
var currentURL = window.location.href;
var parts = currentURL.split("/");
var patientId = parts[parts.length - 1];

$(document).ready(function () {
	$.ajax({
		url: "http://localhost/task/index.php/Patient/getTests",
		type: "GET",
		dataType: "json",
		success: function (response) {
			if (response) {
				testItems = response;
				console.log(testItems);
				if (testItems) {
					testItemNames = testItems.map((item) => item.TestItemName);
					unitPrices = testItems.map((item) => item.UnitPrice);
					var selectTestItem = $("#test-item");
					$.each(testItemNames, function (index, value) {
						selectTestItem.append(
							$("<option></option>").val(value).text(value)
						);
					});

					var selectUnitPrice = $("#unit-price");
					$.each(unitPrices, function (index, value) {
						selectUnitPrice.append(
							$("<option></option>").val(value).text(value)
						);
					});
				}
			}
		},
		error: function (xhr, status, error) {
			console.error(error);
		},
	});
});

// $(document).ready(function () {
// 	var selectPrice = $("#unit-price");
// 	$.each(unitPrices, function (index, value) {
// 		console.log(unitPrices);
// 		selectPrice.append($("<option></option>").val(value).text(value));
// 	});
// 	var selectItem = $("#test-item");

// 	$.each(testItemNames, function (index, value) {
// 		console.log(unitPrices);
// 		selectItem.append($("<option></option>").val(value).text(value));
// 	});
// });

var grandTotal = 0;
var totalPrice;
var discountAmount;
var totalDiscountAmount = 0;
var netTotal;
var totalDiscountPercent = 0;

$("#unit-price, #quantity, #discount-percent").on("input", function () {
	// if (!($("#quantity").val() >= 0 && $("#quantity").val() <= 9)) {
	// 	e.target.value = "";
	// 	return;
	// }

	$("#quantity").keypress(function (e) {
		var keycode = e.which;
		console.log(keycode);
		if (keycode < 48 || keycode > 57) {
			e.preventDefault();
		}
	});
	$("#discount-percent").keypress(function (e) {
		var keycode = e.which;
		if (keycode < 48 || keycode > 57) {
			e.preventDefault();
		}
	});

	var unitPrice = $("#unit-price").val();
	var quantity = $("#quantity").val();
	var discountPercent = parseFloat($("#discount-percent").val());

	totalPrice = unitPrice * quantity;
	discountAmount = (totalPrice * discountPercent) / 100;

	netTotal = totalPrice - discountAmount;
	if (netTotal < 0) {
		netTotal = 0;
	}

	$("#total-price").val(totalPrice.toFixed(2));
	$("#discount-amount").val(discountAmount.toFixed(2));
	$("#net-total").val(netTotal.toFixed(2));
});

$("#add-button").on("click", function () {
	var testItem = $("#test-item").val();
	console.log("testItem", testItem);
	var unitPrice = parseFloat($("#unit-price").val());
	var quantity = parseInt($("#quantity").val());
	var discountPercent = parseFloat($("#discount-percent").val());
	var netTotal = parseFloat($("#net-total").val());
	console.log(quantity);
	if (
		testItem === null ||
		testItem === "" ||
		quantity === null ||
		quantity === ""
	) {
		alert("Values are empty or null");
		return;
	} else if (quantity > 100 || discountPercent > 100) {
		alert("Max value exceeded");
		$("input[type=text], input[type=number]").val("");
		$("#test-item").val("");
		$("#unit-price").val("");
		return;
	} else if (isNaN(unitPrice) || isNaN(quantity) || isNaN(netTotal)) {
		alert("Values are invalid!");
		return;
	} else {
		if (discountPercent == "") discountPercent = 0;
		var totalPrice = unitPrice * quantity;
		var discountAmount = (totalPrice * discountPercent) / 100;
		netTotal = totalPrice - discountAmount;
		// totalDiscountPercent += discountPercent;

		var rowData = {
			patientID: patientId,
			subTotal: totalPrice,
			discountPercent: discountPercent,
			discountAmount: discountAmount,
			netTotal: netTotal,
		};

		billingInfoData.push(rowData);

		var rowData2 = {
			sampleNo: "",
			patientID: patientId,
			testItems: testItem,
			qty: quantity,
			unitPrice: unitPrice,
			discountPercent: discountPercent,
		};

		billItems.push(rowData2);

		var newRow = $("<tr></tr>");
		newRow.append("<td>" + testItem + "</td>");
		newRow.append("<td>" + unitPrice.toFixed(2) + "</td>");
		newRow.append("<td>" + quantity + "</td>");
		newRow.append("<td>" + totalPrice.toFixed(2) + "</td>");
		newRow.append("<td>" + discountPercent.toFixed(2) + "%" + "</td>");
		newRow.append("<td>" + discountAmount.toFixed(2) + "</td>");
		newRow.append("<td>" + netTotal.toFixed(2) + "</td>");
		var clearButton = $(
			"<td><button class='btn btn-sm btn-danger clear-button'>Clear</button></td>"
		);
		newRow.append(clearButton);
		$("#table-body").append(newRow);
		$("input[type=text], input[type=number]").val("");
		$("#test-item").val("");
		$("#unit-price").val("");

		grandTotal += netTotal;
		totalDiscountAmount += discountAmount;
		$("#grand-total-price").val(grandTotal.toFixed(2));
		return;
	}
});

$(document).on("click", ".clear-button", function () {
	var row = $(this).closest("tr");
	var netTotal = parseFloat(row.find("td:nth-child(7)").text());
	grandTotal -= netTotal;
	$("#grand-total-price").val(grandTotal.toFixed(2));
	row.remove();
});

function generateBill() {
	console.log("generateBill");
	if (grandTotal >= 0) {
		// console.log(grandTotal);
		// console.log(totalDiscountAmount);
		var totalCount = billingInfoData.length;

		var average = {
			subTotal:
				billingInfoData.reduce((sum, item) => sum + item.subTotal, 0) /
				totalCount,
			discountPercent:
				billingInfoData.reduce((sum, item) => sum + item.discountPercent, 0) /
				totalCount,
			discountAmount:
				billingInfoData.reduce((sum, item) => sum + item.discountAmount, 0) /
				totalCount,
			netTotal:
				billingInfoData.reduce((sum, item) => sum + item.netTotal, 0) /
				totalCount,
		};
		console.log(average);
		var billData = {
			patientID: patientId,
			subTotal: average.subTotal,
			discountPercent: average.discountPercent,
			discountAmount: average.discountAmount,
			netTotal: average.netTotal,
		};

		console.log(billItems);

		var data = {
			rowData: billData,
			rowData2: billItems,
		};

		$.ajax({
			url: "http://localhost/task/index.php/Patient/saveBillingData",
			type: "POST",
			data: data,
			dataType: "json",
			success: function (response) {
				console.log(response);
				if (response == "success") {
					console.log(data);
					// alert(
					// 	"Data Inserted Successfully: You will be redirect to the billing section "
					// );
					$("#insertConfirmationModal").modal("show");
					setTimeout(function () {
						window.location.href =
							"http://localhost/task/index.php/Patient/billing";
					}, 1500);
				}
			},
			error: function (error) {
				console.log(error);
			},
		});
	} else {
		alert("Please select the tests and associated values empty");
	}
}
