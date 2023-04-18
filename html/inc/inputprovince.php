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
                        $('<option></option>').val(item.id).html(item.name_th);
                    );
                });
            }
        });
    }
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
                            $('<option></option>').val(item.id).html(item.name_th);
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
//EVENTS
document
    .querySelector("#province")
    .addEventListener("change", (event) => {
    showDistrict();
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