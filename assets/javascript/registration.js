var selectedProvince;
var municipalities = new Array();
var jsonData = new Array();
var districts = new Array();
var allCountries = new Array();
var provinceSelect = document.getElementById("province");
var districtSelect = document.getElementById("district");
var municipalitySelect = document.getElementById("municipality");
var countrySelect = document.getElementById("country");
var patientData;

//fetch districts starts here------->
fetch("../../assets/provinces-districts.json")
	.then((response) => response.json())
	.then((data) => {
		districts = data;
	})
	.catch((error) => {
		console.error("Error fetching JSON data:", error);
	});

//fetch municipalities starts here------->
fetch(
	"https://raw.githubusercontent.com/rubek-joshi/districts-and-municipalities-of-nepal/master/districts-municipalities_metropolis_sub-metropolis_rural-municipalities.json"
)
	.then((response) => response.json())
	.then((data) => {
		jsonData = data;
	})
	.catch((error) => {
		console.error("Error fetching JSON data:", error);
	});

//fetch countries starts here------->
fetch("https://restcountries.com/v3.1/all")
	.then((response) => response.json())
	.then((data) => {
		const countries = data.map((country) => country.name.common);
		allCountries = countries;
		console.log(allCountries);
		countries.forEach((country) => {
			const option = document.createElement("option");
			option.value = country;
			option.text = country;
			countrySelect.appendChild(option);
		});
	})
	.catch((error) => {
		console.error("Error:", error);
	});

function populateDistricts() {
	districtSelect.innerHTML = "";
	var selectedProvince = provinceSelect.value;

	if (selectedProvince == "none") {
		console.log(selectedProvince);
		for (let i = 0; i < 2; i++) {
			var naOption = document.createElement("option");
			if (i === 0) {
				naOption.value = "";
				naOption.text = "Select a District";
				naOption.selected = true;
			} else {
				naOption.text = "N/A";
				naOption.value = "none";
			}
			districtSelect.appendChild(naOption);
		}
	} else {
		var selectedData = districts.find(function (data) {
			return data.province === selectedProvince;
		});

		if (selectedData) {
			selectedData.districts.forEach(function (district) {
				var option = document.createElement("option");
				option.value = district;
				option.text = district;
				districtSelect.appendChild(option);
			});
		}
	}
}

// function populateMunicipalities() {
// 	const selectedDistrict = districtSelect.value;
// 	console.log("running populateMunicipalities");
// 	console.log(selectedDistrict);
// 	const districtData = jsonData.find(
// 		(district) => district.district === selectedDistrict
// 	);

// 	municipalitySelect.innerHTML = "";

// 	districtData.municipalities.forEach((municipality) => {
// 		const option = document.createElement("option");
// 		option.value = municipality;
// 		option.text = municipality;
// 		municipalitySelect.appendChild(option);
// 	});
// }

function populateMunicipalities() {
	municipalitySelect.innerHTML = "";
	console.log("running populateMunicipalities");
	const selectedDistrict = districtSelect.value;
	console.log(selectedDistrict);
	console.log("from selected district::", selectedDistrict);

	if (selectedDistrict == "") {
		$("#municipalityError").text("Select District First");
		return false;
	} else if (selectedDistrict == "none") {
		$("#municipalityError").text("");
		console.log("selcted none district", selectedDistrict);
		const naOption = document.createElement("option");
		naOption.value = "none";
		naOption.text = "N/A";
		municipalitySelect.appendChild(naOption);
	} else {
		console.log("selcted none district", selectedDistrict);

		const districtData = jsonData.find(
			(district) => district.district === selectedDistrict
		);
		districtData.municipalities.forEach((municipality) => {
			const option = document.createElement("option");
			option.value = municipality;
			option.text = municipality;
			municipalitySelect.appendChild(option);
		});
	}
}

//front end form validation starts here------->

$("#patient-form").submit(function (event) {
	event.preventDefault();
	var name = $("#name").val();
	var age = $("#age").val();
	var gender = $("input[name='gender']:checked").val();
	const selectedLanguages = $('input[type="checkbox"]:checked')
		.map(function () {
			return $(this).val();
		})
		.get();

	console.log(selectedLanguages);

	var country = $("#country").val();
	var province = $("#province").val();
	var district = $("#district").val();
	var municipality = $("#municipality").val();
	var address = $("#address").val();
	var mobile = $("#mobileNumber").val();
	console.log(
		name,
		age,
		gender,
		selectedLanguages,
		country,
		province,
		district,
		municipality,
		address,
		mobile
	);

	if (
		!name ||
		!age ||
		!gender ||
		selectedLanguages.length === 0 ||
		!country ||
		!province ||
		!district ||
		!municipality ||
		!address ||
		!mobile
	) {
		alert("Please fill in all the required fields.");
		// $("#patient-form")[0].reset();
	} else {
		console.log(
			name,
			age,
			gender,
			selectedLanguages,
			country,
			province,
			district,
			municipality,
			address,
			mobile
		);

		$.ajax({
			url: "registerData",
			type: "POST",
			dataType: "json",
			data: {
				name: name,
				age: age,
				gender: gender,
				languages: selectedLanguages,
				country: country,
				province: province,
				district: district,
				municipality: municipality,
				address: address,
				mobile: mobile,
			},
			success: function (response) {
				console.log(response);
				if (response["status"] == 0) {
					if (response["name"] !== "") {
						$("#nameError").html(response["name"]);
					}
					if (response["address"] !== "") {
						$("#addressError").html(response["address"]);
					}
					if (response["age"] !== "") {
						$("#ageError").html(response["age"]);
					}
					if (response["country"] !== "") {
						$("#countryError").html(response["country"]);
					}
					if (response["district"] !== "") {
						$("#districtError").html(response["district"]);
					}
					if (response["gender"] !== "") {
						$("#genderError").html(response["gender"]);
					}
					if (response["language"] !== "") {
						$("#languageError").html(response["language"]);
					}
					if (response["mobile"] !== "") {
						$("#mobileError").html(response["mobile"]);
					}
					if (response["province"] !== "") {
						$("#provinceError").html(response["province"]);
					}
					if (response["municipality"] !== "") {
						$("#municipalityError").html(response["municipality"]);
					}
				} else {
					// console.log(response["row"]);
					// $("#exampleModal").modal("hide");
					// $("#insertModal").modal("show");
					// $("#insertModal .modal-body").html("Record Inserted Successfully!!");
					console.log(response["row"]);
					fillNewRow(response["row"]);
					// $("#patientModelList").append(response["row"]);
					$("#addPatientModal").hide();
					$(".modal-backdrop").fadeOut();
					$("body").removeClass("modal-open");
					$("#patient-form")[0].reset();
				}
			},
			error: function (xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}
});

function fillNewRow(row) {
	const tableBody = document.getElementById("tableBody");
	const rowCount = tableBody.rows.length;

	const newRow = document.createElement("tr");
	newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td>${row.PatientID}</td>
        <td>${row.Name}</td>
        <td>${row.Age}/${row.Gender}</td>
        <td>${row.District}</td>
        <td>${row.Address}</td>
        <td>${row.DateTime}</td>
        <td>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#previewModal" onclick="showPreview(${
							row.PatientID
						})">Preview</button>
            <button class="border-0 btn btn-outline-none py-0">
                <a href="loadRegBilling/${
									row.PatientID
								}" id="update" class="btn btn-primary">Reg&Billing</a>
            </button>
        </td>
    `;

	tableBody.appendChild(newRow);
}

$(document).ready(function () {
	$("#mobileNumber").on("input", function () {
		var inputValue = $(this).val();
		var numbersOnly = inputValue.replace(/[^0-9]/g, "");
		$(this).val(numbersOnly);
	});
});

function showRegBilling(id) {
	console.log(id);
}

function showPreview(id) {
	var modalBody = $("#previewModalBody");
	modalBody.empty();
	console.log(id);
	$("previewModal").show();
	if (id) {
		$.ajax({
			url: "http://localhost/task/index.php/Patient/getSinglePatient",
			type: "POST",
			dataType: "json",
			data: { pid: id },
			success: function (response) {
				console.log(response);
				if (response) {
					patientData = response;
					var cardContainer = $('<div class="card-container"></div>');

					$.each(patientData, function (key, value) {
						var card = $('<div class="card mb-3"></div>');
						var cardBody = $('<div class="card-body"></div>');

						var cardTitle = $('<h5 class="card-title">' + key + "</h5>");

						var cardText = $('<p class="card-text"></p>');
						if (key === "Language") {
							var languages = JSON.parse(value);
							languages.forEach(function (language) {
								var languageElement = $(
									'<div class="language-rectangle">' + language + "</div>"
								);
								cardText.append(languageElement);
							});
						} else {
							cardText.text(value);
						}
						cardBody.append(cardTitle);
						cardBody.append(cardText);

						card.append(cardBody);
						cardContainer.append(card);
					});
					$(".preview-body").append(cardContainer);
				}
			},
			error: function (xhr, status, error) {
				console.error(error);
			},
		});
	}
}
