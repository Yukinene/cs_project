<script>
function showDistrict() {
    var provinceId = $('#province').val();
    $('#district').html('<option value="">กรุณาเลือกเขต/อำเภอ</option>');
    $('#sub_district').html('<option value="">กรุณาเลือกแขวง/ตำบล</option>');
    $('#postal_code').val('');
    if (provinceId != '') {
        $.ajax({
            type: 'POST',
            data: {province_id: provinceId},
            url: '../../inc/get/get_district.php',
            success: function(data) {
                var result = JSON.parse(data);
                $.each(result, function(index, item){
                    $('#district').append(
                        $('<option></option>').val(item.id).html(item.name_th)
                    );
                });
            }
        });
    }
}
function freightCalculator_instant() {
    var instantAddress = $('#instant_address').val();
    var totalamount_afterdiscount = document.getElementById("totalamount_afterdiscount_instant").value;
    if (instantAddress != '') {
    $.ajax({
            type: 'POST',
            data: {instant_address: instantAddress},
            url: '../../inc/get/get_instant_freight.php',
            success: function(data) {
                var result = JSON.parse(data);
                $.each(result, function(index, item){
                    var freight_cost_label = (item.price.toString()) + " บาท";
                    $('#freight_cost_label').html(freight_cost_label);
                    let total_amount = parseInt(item.price) + parseInt(totalamount_afterdiscount);
                    var totalamount_final_label = (total_amount.toString()) + " บาท";
                    $('#totalamount_final_label').html(totalamount_final_label);
                    document.getElementById("amount_instant").value = total_amount;
                });
            }
        });
    }
    else {
        provinceId = 0;
        $.ajax({
            type: 'POST',
            data: {province_id: provinceId},
            url: '../../inc/get/get_freight.php',
            success: function(data) {
                var result = JSON.parse(data);
                $.each(result, function(index, item){
                    var freight_cost_label = (item.price.toString()) + " บาท";
                    $('#freight_cost_label').html(freight_cost_label);
                    let total_amount = parseInt(item.price) + parseInt(totalamount_afterdiscount);
                    var totalamount_final_label = (total_amount.toString()) + " บาท";
                    $('#totalamount_final_label').html(totalamount_final_label);
                    document.getElementById("amount_instant").value = total_amount;
                });
            }
        });
    }
}
function freightCalculator() {
    var provinceId = $('#province').val();
    var totalamount_afterdiscount = document.getElementById("totalamount_afterdiscount").value;
    if (provinceId == '') {
        provinceId = 0;
    }
    $.ajax({
            type: 'POST',
            data: {province_id: provinceId},
            url: '../../inc/get/get_freight.php',
            success: function(data) {
                var result = JSON.parse(data);
                $.each(result, function(index, item){
                    var freight_cost_label = (item.price.toString()) + " บาท";
                    $('#freight_cost_label').html(freight_cost_label);
                    let total_amount = parseInt(item.price) + parseInt(totalamount_afterdiscount);
                    var totalamount_final_label = (total_amount.toString()) + " บาท";
                    $('#totalamount_final_label').html(totalamount_final_label);
                    document.getElementById("amount").value = total_amount;
                });
            }
        });
}
function showSubDistrict() {
    var districtId = $('#district').val();
    $('#sub_district').html('<option value="">กรุณาเลือกแขวง/ตำบล</option>');
    $('#postal_code').val('');
    if (districtId != '') {
    $.ajax({
            type: 'POST',
            data: {district_id: districtId},
            url: '../../inc/get/get_subdistrict.php',
            success: function(data) {
                var result = JSON.parse(data);
                $.each(result, function(index, item){
                    if (item.zip_code != 0) {
                        $('#sub_district').append(
                            $('<option></option>').val(item.id).html(item.name_th)
                        );
                    }
                });
            }
    });  
    }
}
function showPostalcode() {
    var subdistrictId = $('#sub_district').val();
    if (subdistrictId != '') { 
    $.ajax({
            type: 'POST',
            data: {subdistrict_id: subdistrictId},
            url: '../../inc/get/get_postalcode.php',
            success: function(data) {
                var result = JSON.parse(data);
                $.each(result, function(index, item){
                    $('#postal_code').val(item.zip_code.toString());
                });
            }
    });
    }
    else {
        $('#postal_code').val('');
    }
}

function changeaddress() {
    var checkaddress = $("#Checkaddress").prop("checked");{
        is_show('address_page_input', !checkaddress);
        is_show('address_page_instant', checkaddress);
    }
}
function is_show(str, boolean){
    if(boolean){
        $("div[name='"+str+"']").removeClass('visually-hidden');
    } else {
        $("div[name='"+str+"']").addClass('visually-hidden');
    }
}

//EVENTS
document
    .querySelector("#province")
    .addEventListener("change", (event) => {
    showDistrict();
    freightCalculator();
    });
document
    .querySelector("#district")
    .addEventListener("change", (event) => {
    showSubDistrict();
    });
document
    .querySelector("#sub_district")
    .addEventListener("change", (event) => {
    showPostalcode();
    });
        $(document).ready(function () {
            changeaddress();
            $("#cartTable").DataTable({
              "order": [[ 0, "desc" ]],
        "responsive": true,
        "ordering": false,
        lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100]
          ],
        "pageLength": 25,
        language: 
        {
          url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/th.json'
        }
            });
        });
</script>