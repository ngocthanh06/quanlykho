$(document).ready(function() {
    $('#datetimepicker1').datetimepicker({
        format: "mm-Y",
        // weekStart: 0,
        // calendarWeeks: true,
        // autoclose: true,
        // todayHighlight: true,
        // rtl: true,
        // orientation: "auto"
    });


    /**
     * onload page
     */
    setValue();

    // !selected Add input
    $('.js-example-tags').select2({
        tags: true
    });

    /**
     * table Search
     */

    $('.dataTables-example').DataTable({
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy' },
            { extend: 'csv' },
            { extend: 'excel', title: 'ExampleFile' },
            { extend: 'pdf', title: 'ExampleFile' },

            {
                extend: 'print',
                customize: function(win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ]

    });
    /* Init DataTables */
    var oTable = $('#editable').DataTable();

    /* Apply the jEditable handlers to the table */
    oTable.$('td').editable('../example_ajax.php', {
        'callback': function(sValue, y) {
            var aPos = oTable.fnGetPosition(this);
            oTable.fnUpdate(sValue, aPos[0], aPos[1]);
        },
        'submitdata': function(value, settings) {
            return {
                'row_id': this.parentNode.getAttribute('id'),
                'column': oTable.fnGetPosition(this)[2]
            };
        },

        'width': '90%',
        'height': '100%'
    });

    /**
     * add them xuat kho
     */
    $('#addBtn').on('click', function() {
        var quatati = Number($(this).parentsUntil().find('.detainProd:last input').attr('class')) + 1;
        var here = $(this).parentsUntil().find('.addProduct');
        $.ajax({
                url: `/api/allProduct`,
                type: 'get',
            })
            .done(function(data) {
                var option = data.map(res => {
                    return "<option value='" + res.id + "' >" + res.name + "</option> ?>"
                })
                here.append("<div class='detainProd row' style='padding: 0 15px'><input class=" + quatati + " style='display:none'><div class='form-group col-sm-3'> <label class='col-sm-4 control-label'>Tên sản phẩm</label><div class='col-sm-8'><select name='idSP" + quatati + "' class='form-control'> " + option + " </select><span id='errorid_SP" + quatati + "' ></span> </div></div><div class='form-group col-sm-3'><label class='col-sm-4 control-label'>Số lượng</label><div class='col-sm-8'><input type='number' name='sl" + quatati + "' placeholder='Số lượng' onchange='setValue()' class='form-control' min='1' value='1'><span id='errorsoluong" + quatati + "' ></span></div></div><div class='form-group col-sm-3'><label class='col-sm-4 control-label'>Giá nhập</label><div class='col-sm-8'><input type='number' onchange='setValue()' class='form-control' name='gianhap" + quatati + "' placeholder='Giá nhập' min='1' value='10000'><span id='errorgianhap" + quatati + "' ></span> </div> </div><div class='form-group col-sm-2'><label class='col-sm-4 control-label'>ĐVT</label><div class='col-sm-8'><input required type='text' name='dvt" + quatati + "' class='form-control' placeholder='Đơn vị tính'><span id='error' ></span> </div> </div><div class=' col-sm-1 form-group removeBtn'><input type='button' class='btn btn-danger RmBtn' id='rmBtn' value='Xóa'></div></div>");
                setValue();
            })
    });

    /**
     * remove add nhap kho
     */
    $('.addProduct').on('click', '.detainProd .removeBtn .RmBtn', function() {
        var count = $(this).parentsUntil().find('.detainProd').length;
        if (count > 1) {
            var content = $(this).parent().parent();
            content.remove();
            setValue();
        }
    });

    /**
     * remove edit nhap kho
     */
    $('.addProduct').on('click', '.detainProd .removeBtn .rmBtnEdit', function() {
        var count = $('.addProduct').parentsUntil().find('.detainProd').length;
        if (count > 1) {
            let id = $(this).attr('name');
            let number = $(this).attr('id');
            let validSP = $("select[name*='idSP" + number + "']").val();
            let valsl = $("input[name*='sl" + number + "']").val();
            let valgianhap = $("input[name*='gianhap" + number + "']").val();
            let valdvt = $("input[name*='dvt" + number + "']").val();
            var ischeck = confirm('Bạn muốn xóa? Thao tác sẽ không được thu hồi');
            if (ischeck == true) {
                var content = $(this).parent().parent();
                content.remove();
                var tongtien = SetvalueEdit(valgianhap * valsl);
                $.post('/api/removeDetailProduct', { id: id, idSP: validSP, sl: valsl, gianhap: valgianhap, dvt: valdvt, tongtien: tongtien }, function(res) {
                    res.code == 200 ? location.reload() : alert('Không thể xóa');
                })
            }
        }

    });

    /**
     * remove edit chưa load xuất kho
     */
    $('.addProduct').on('click', '.detainProd .removeBtn .RmBtnXuat', function() {
        var count = $(this).parentsUntil().find('.detainProd').length;
        if (count > 1) {
            var content = $(this).parent().parent();
            content.remove();
            setTienXuat($(this));
        }

    });

    /**
     * remove edit đã load dữ liệu xuất kho
     */
    $('.addProduct').on('click', '.detainProd .removeBtn .RmBtnXuatEdit', function() {
        var count = $('.addProduct').parentsUntil().find('.detainProd').length;
        if (count > 1) {
            let id = $(this).attr('name');
            let number = $(this).attr('id');
            let validSP = $("select[name*='idSP" + number + "']").val();
            let valsl = $("input[name*='sl" + number + "']").val();
            let valgiaxuat = $("input[name*='giaxuat" + number + "']:checked").val();
            var ischeck = confirm('Bạn muốn xóa? Thao tác sẽ không được thu hồi');
            if (ischeck == true) {
                var content = $(this).parent().parent();
                var tongtien = SetvalueXuatEdit(valgiaxuat * valsl);
                content.remove();
                $.post('/api/removeDetaiXuatkho', { id: id, idSP: validSP, sl: valsl, giaxuat: valgiaxuat, tongtien: tongtien }, function(res) {
                    res.code == 200 ? location.reload() : alert('Không thể xóa');

                })
            }
        }
    })
});


/**
 * Xuất kho
 */

$(document).ready(function() {
    // add xuất kho
    $('#addBtnXuat').on('click', function() {
        var number = Number($(this).parentsUntil().find('.detainProd:last').find('.radio input').attr('class')) + 1;
        var here = $(this).parentsUntil().find('.addProduct');
        $.ajax({
                url: `/api/allProduct`,
                type: 'get',
            })
            .done(function(data) {
                var option = data.map(res => {
                    return "<option value='" + res.id + "' >" + res.name + "</option> ?>"
                })
                here.append("<div class='detainProd row' style='padding: 0 15px'><div class='form-group col-sm-3'> <label class='col-sm-4 control-label'>Tên sản phẩm</label><div class='col-sm-8'><select required name='idSP" + number + "' id='idProduct" + number + "' onchange='loadProducts(this)' class='form-control idProduct'> <option value='' selected disabled style='background: #eee'>Chọn sản phẩm</option>" + option + " </select><span id='errorid_SP" + number + "' ></span> </div></div><div class='form-group col-sm-3'><label class='col-sm-4 control-label'>Số lượng</label><div class='col-sm-8'><input id='idProducts" + number + "' type='number' name='sl" + number + "' placeholder='Số lượng' onchange='loadChangeProduct(this)' class='form-control' min='1' value='1'><span id='errorsoluong" + number + "' ></span></div></div><div class='form-group col-sm-3 radio-giaxuat'><div onchange='changePrice(this)' class='" + number + "'style='display: flex; justify-content: space-around'><div class='radio radio-danger radioXuat" + number + "'><input type='text' class=" + number + " style='display:none'><input type='radio' name='giaxuat" + number + "' id='rdio" + number + "' value='' class='gianhap'> <label for='rdio" + number + "'>Giá nhập</label></div><div class='radio radio-danger  radioXuat" + number + "'> <input type='radio' class='giaxuat' name='giaxuat" + number + "' id='radio" + number + "' value='' checked><label for='radio" + number + "'>Giá xuất</label></div> </div></div><div class=' col-sm-1 form-group removeBtn'><input type='button' class='btn btn-danger RmBtnXuat' id='rmBtn' value='Xóa'></div></div>");

            })
    });
});

function changePrice(value) {
    setTienXuat(value);
}


//load infomation client xuat kho
function loadClient() {
    var idname = $('#nameClient').val();
    $.get(`/api/loadClient/${idname}`).then((res) => {
        if (res) {
            $('#phoneClient').val(res.phone);
            $('#addressClient').val(res.address);
            $('#emailClient').val(res.email);
            $('#phoneClient').attr('disabled', 'disabled');
            $('#addressClient').attr('disabled', 'disabled');
            $('#emailClient').attr('disabled', 'disabled');
        } else {
            $('#phoneClient').val('');
            $('#addressClient').val('');
            $('#emailClient').val('');
            $('#phoneClient').removeAttr('disabled');
            $('#addressClient').removeAttr('disabled');
            $('#emailClient').removeAttr('disabled');
        }
    })
}


//load change value gia xuat kho
function loadChangeProduct(value) {
    var idProduct = $(value).parent().parent().parent().find('select').val();
    var idgianhap = $(value).parent().parent().parent().find('.gianhap').attr('id');
    var idgiaxuat = $(value).parent().parent().parent().find('.giaxuat').attr('id');
    var idsl = $(value).parent().parent().parent().find('.soluong').attr('id');
    $.get(`/api/loadProduct/${idProduct}`).then((res) => {
        if (res.mess) {
            $('#addBtnxuatkho').attr('disabled', 'disabled');
            alert('Sản phẩm đã hết nên không thể xuất hàng');
        } else {
            $('#addBtnxuatkho').removeAttr('disabled');
            $(`#${idgianhap}`).val(res.price_before);
            $(`#${idgiaxuat}`).val(res.price_after);
            $(`#${idsl}`).removeAttr('readonly')
        }
    })
    setTienXuat(value)
}
// load tongtien xuat kho
function setTienXuat(value) {
    var id = $(value).parent().parent().parent().find('select').val();
    if (!id) id = 0;
    var count = Number($('.addProduct').find('.detainProd:last').find('.radio input').attr('class')) + 1;
    var total = 0;
    for (var i = 0; i < count; i++) {
        if ($("input[name='sl']").val() && i == 0) {
            var nameSl = 'sl';
            var nameGia = 'giaxuat';
        } else {
            var nameSl = 'sl' + i;
            var nameGia = 'giaxuat' + i;
        }
        let valueSL = $("input[name='" + nameSl + "']").val();
        let valueGia = $("input[name='" + nameGia + "']:checked").val();
        console.log(valueSL, valueGia)
        valueGia == null ? valueGia = 0 : valueGia;
        valueSL == null ? valueSL = 0 : valueSL;
        $.get(`/api/checkProduct/${id}`).then((res) => {
            if (Number(res) < valueSL) {
                $("input[name='" + nameSl + "']").val(res);
            }
        });
        total = Number(total) + (valueSL * valueGia);
    }
    $('#totalTienXuat').val(total);
}

// load tongtien using edit
function SetvalueXuatEdit(value) {
    var total = $('#totalTienXuat').val();
    var tongtien = total - value
    $('#totalTienXuat').val(tongtien);
    return tongtien;
}

// load tongtien using edit
function SetvalueEdit(value) {
    var total = $('#totalTien').val();
    var tongtien = total - value
    $('#totalTien').val(total - tongtien);
    return tongtien;
}

// load tongtien
function setValue() {
    var count = Number($('.addProduct').parentsUntil().find('.detainProd:last input').attr('class')) + 1;
    var total = 0;
    for (var i = 0; i < count; i++) {
        if ($("input[name='sl']").val() && i == 0) {
            var nameSl = 'sl';
            var nameGia = 'gianhap';
        } else {
            var nameSl = 'sl' + i;
            var nameGia = 'gianhap' + i;
        }
        let valueSL = $("input[name='" + nameSl + "']").val();
        let valueGia = $("input[name='" + nameGia + "']").val();
        valueGia == null ? valueGia = 0 : valueGia;
        valueSL == null ? valueSL = 0 : valueSL;
        total = Number(total) + (valueSL * valueGia);
    }
    $('#totalTien').val(total);
}

//load change value gia xuat kho
function loadProducts(value) {
    var idProduct = $(value).attr('id');
    var idgianhap = $(value).parent().parent().parent().find('.gianhap').attr('id');
    var idgiaxuat = $(value).parent().parent().parent().find('.giaxuat').attr('id');
    var idsl = $(value).parent().parent().parent().find('.soluong').attr('id');
    var idVal = $(`#${idProduct}`).val();
    $.get(`/api/loadProduct/${idVal}`).then((res) => {
        if (res.mess) {
            $('#addBtnxuatkho').attr('disabled', 'disabled');
            alert('Sản phẩm đã hết nên không thể xuất hàng');
        } else {
            $('#addBtnxuatkho').removeAttr('disabled');
            $(`#${idgianhap}`).val(res.price_before);
            $(`#${idgiaxuat}`).val(res.price_after);
            $(`#${idsl}`).removeAttr('readonly')
            setTiensXuat();
        }
    })
}

// load tongtien xuat kho
function setTiensXuat() {
    var id = $('.detainProd').parent().find('select').val();
    if (!id) id = 0;
    var count = Number($('.addProduct').find('.detainProd:last').find('.radio input').attr('class')) + 1;
    var total = 0;
    for (var i = 0; i < count; i++) {
        if ($("input[name='sl']").val() && i == 0) {
            var nameSl = 'sl';
            var nameGia = 'giaxuat';
        } else {
            var nameSl = 'sl' + i;
            var nameGia = 'giaxuat' + i;
        }
        let valueSL = $("input[name='" + nameSl + "']").val();
        let valueGia = $("input[name='" + nameGia + "']:checked").val();
        valueGia == null ? valueGia = 0 : valueGia;
        valueSL == null ? valueSL = 0 : valueSL;
        $.get(`/api/checkProduct/${id}`).then((res) => {
            if (Number(res) + 1 < valueSL) {
                $("input[name='" + nameSl + "']").val(res);
            }
        });
        total = Number(total) + (valueSL * valueGia);
    }
    $('#totalTienXuat').val(total);
}