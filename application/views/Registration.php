<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/styles/registration.css">
    <title>Patient Registration Form</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php include('navbar.php'); ?>
    <section class="main-container">
        <div class="mb-3">
            <button type="button" class="btn btn-primary button text-white" data-toggle="modal"
                data-target="#addPatientModal">Register Patient +</button>
        </div>
        <!-- addPatientModal -->
        <div class="modal fade" id="addPatientModal" tabindex="-1" role="dialog" aria-labelledby="addPatientModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-uppercase text-black" id="addPatientModalLabel">Patient Registration
                            Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form id="patient-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name<span class="required">*</span></label>
                                    <input type="text" class="form-control classy-input" id="name"
                                        placeholder="Enter name" name="name">
                                    <small id="nameError" class="form-text text-danger name"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="age">Age<span class="required">*</span></label>
                                    <input type="number" class="form-control classy-input" id="age"
                                        placeholder="Enter age" min="1" max="130" name="age">
                                    <small id="ageError" class="form-text text-danger age"></small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="gender">Gender<span class="required">*</span></label>
                                    <div class="form-check classy-radio">
                                        <input class="form-check-input" type="radio" name="gender" id="genderMale"
                                            value="Male">
                                        <label class="form-check-label" for="genderMale">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check classy-radio">
                                        <input class="form-check-input" type="radio" name="gender" id="genderFemale"
                                            value="Female">
                                        <label class="form-check-label" for="genderFemale">
                                            Female
                                        </label>
                                    </div>
                                    <div class="form-check classy-radio">
                                        <input class="form-check-input" type="radio" name="gender" id="genderOther"
                                            value="Other">
                                        <label class="form-check-label" for="genderOther">
                                            Other
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="language">Language<span class="required">*</span></label>
                                    <div class="form-check classy-checkbox">
                                        <input class="form-check-input" type="checkbox" id="languageEnglish"
                                            value="English" name="language">
                                        <label class="form-check-label" for="languageEnglish">
                                            English
                                        </label>
                                    </div>
                                    <div class="form-check classy-checkbox">
                                        <input class="form-check-input" type="checkbox" id="languageNepali"
                                            value="Nepali" name="language">
                                        <label class="form-check-label" for="languageNepali">
                                            Nepali
                                        </label>
                                    </div>
                                    <div class="form-check classy-checkbox">
                                        <input class="form-check-input" type="checkbox" id="languageOther" value="Other"
                                            name="language">
                                        <label class="form-check-label" for="languageOther">
                                            Other
                                        </label>
                                    </div>
                                    <small id="languageError" class="form-text text-danger language"></small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="country">Country<span class="required">*</span></label>
                                    <select class="form-control classy-select" id="country" name="country">
                                        <option value="">Select a country</option>
                                    </select>
                                    <small id="countryError" class="form-text text-danger country"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="province">Province<span class="required">*</span></label>
                                    <select class="form-control classy-select" id="province" name="province"
                                        onchange="populateDistricts()">
                                        <option value="">Select a province</option>
                                        <option value="Province No. 1">Province No. 1</option>
                                        <option value="Province No. 2">Province No. 2</option>
                                        <option value="Province No. 3">Bagmati Pradesh</option>
                                        <option value="Gandaki Pradesh">Gandaki Pradesh</option>
                                        <option value="Province No. 5">Province No. 5</option>
                                        <option value="Karnali Pradesh">Karnali Pradesh</option>
                                        <option value="Sudurpashchim Pradesh">Sudurpashchim Pradesh</option>
                                        <option value="none">N/A</option>
                                    </select>
                                    <small id="provinceError" class="form-text text-danger province"></small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="district">District<span class="required">*</span></label>
                                    <select class="form-control classy-select" id="district" name="district"
                                        onchange="populateMunicipalities()">
                                        <option value="">Select a District</option>
                                    </select>
                                    <small id="districtError" class="form-text text-danger district"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="municipality">Municipality<span class="required">*</span></label>
                                    <select class="form-control classy-select" name="municipality" id="municipality">
                                        <option value="">Select a municipality</option>
                                    </select>
                                    <small id="municipalityError" class="form-text text-danger municipality"></small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address<span class="required">*</span></label>
                                    <textarea class="form-control resize-none classy-textarea" id="address" rows="1"
                                        placeholder="Enter address"></textarea>
                                    <small id="addressError" class="form-text text-danger address"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mobileNumber">Mobile Number<span class="required">*</span></label>
                                    <input type="tel" class="form-control classy-input" id="mobileNumber"
                                        pattern="[0-9]{10}" placeholder="+977 9860842010" name="mobile" maxlength="10" required>
                                    <small id="mobileError" class="form-text text-danger mobile"></small>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary button classy-button">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- previewModal starts here -->

        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header button text-white">
                <h5 class="modal-title" id="previewModalLongTitle">Patients Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body preview-body" id="previewModalBody">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        <section>
            <div class="row">
                <div class="col">
                    <div class="table-responsive-sm table-responsive-md text-center">
                        <table class="table table-bordered table-striped display" id="patientModelList" id="myTable">
                            <thead class="button text-white">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Patient ID</th>
                                    <th scope="col">Patient Name</th>
                                    <th scope="col">Age / Gender</th>
                                    <th scope="col">District</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Registered Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>

                            <tbody id="tableBody">
                            <?php 
                            $sn = 1;
                            if (!empty($rows)) {
                                foreach ($rows as $row) { 
                            ?>
                                <tr id="row-<?php echo $row['PatientID'] ?>">
                                    <td scope="row" id="sn"><?php echo $sn ?></td> 
                                    <td scope="row"><?php echo $row['PatientID'] ?></td>
                                    <td scope="row"><?php echo $row['Name'] ?></td>
                                    <td><?php echo $row['Age'] ?><span>/</span><?php echo $row['Gender'] ?></td>
                                    <td><?php echo $row['District'] ?></td>
                                    <td><?php echo $row['Address'] ?></td>
                                    <td><?php echo $row['DateTime'] ?></td>
                                    <td>
                                    <button class="btn btn-secondary my-1" onclick="showPreview(<?php echo $row['PatientID'] ?>)" id="preview" data-toggle="modal" data-target="#previewModal">Preview</button>
                                    <button class="border-0 btn btn-outline-none py-0"> <a href="<?php echo base_url().'index.php/Patient/loadRegBilling/'.$row['PatientID']?>" id="update" class="btn btn-primary">Reg&Billing</a></button>
                                    </td>
                                </tr>
                            <?php 
                                    $sn++; 
                                }
                            } else {
                            ?>
                                <tr class="text-info"><td colspan="12">Records Not Found!!</td></tr>
                            <?php 
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script>
    $(document).ready(function () {
        $('#patientModelList').DataTable({
            searching: true,
            ordering: true,
            paging: true,
            lengthMenu: [10, 25, 50, 100],
            pageLength: 10,
            responsive: true
        });
    });
    
    
</script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/javascript/registration.js"></script>
</body>
</html>