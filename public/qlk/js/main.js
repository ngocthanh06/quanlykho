$(document).ready(function() {
    // !selected Add input
    $('.js-example-tags').select2({
        tags: true
    });

    //   table Search
    $(document).ready(function() {
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
    });


});

// add product
$(document).ready(function() {
    setValue();
    $('#addBtn').on('click', function() {
        var quatati = $(this).parentsUntil().find('.detainProd').length;
        var here = $(this).parentsUntil().find('.addProduct');
        $.ajax({
                url: `/api/allProduct`,
                type: 'get',
            })
            .done(function(data) {
                var option = data.map(res => {
                    return "<option value='" + res.id + "' >" + res.name + "</option> ?>"
                })
                here.append("<div class='detainProd row' style='padding: 0 15px'><div class='form-group col-sm-3'> <label class='col-sm-4 control-label'>Tên sản phẩm</label><div class='col-sm-8'><select name='idSP" + quatati + "' class='form-control'> " + option + " </select><span id='errorid_SP" + quatati + "' ></span> </div></div><div class='form-group col-sm-3'><label class='col-sm-4 control-label'>Số lượng</label><div class='col-sm-8'><input type='number' name='sl" + quatati + "' placeholder='Số lượng' onchange='setValue()' class='form-control' min='1' value='1'><span id='errorsoluong" + quatati + "' ></span></div></div><div class='form-group col-sm-3'><label class='col-sm-4 control-label'>Giá nhập</label><div class='col-sm-8'><input type='number' onchange='setValue()' class='form-control' name='gianhap" + quatati + "' placeholder='Giá nhập' min='1' value='10000'><span id='errorgianhap" + quatati + "' ></span> </div> </div><div class='form-group col-sm-2'><label class='col-sm-4 control-label'>ĐVT</label><div class='col-sm-8'><input required type='text' name='dvt" + quatati + "' class='form-control' placeholder='Đơn vị tính'><span id='error' ></span> </div> </div><div class=' col-sm-1 form-group removeBtn'><input type='button' class='btn btn-danger RmBtn' id='rmBtn' value='Xóa'></div></div>");
                setValue();
            })

    });
    $('.addProduct').on('click', '.detainProd .removeBtn .RmBtn', function() {
        var count = $(this).parentsUntil().find('.detainProd').length;
        if (count > 1) {
            var content = $(this).parent().parent();
            content.remove();
            setValue();
        }
    });

});

// load tongtien
function setValue() {
    var count = $('.addProduct').parentsUntil().find('.detainProd').length;
    var total = 0;
    for (var i = 0; i < count; i++) {
        if (i == 0) {
            var nameSl = 'sl';
            var nameGia = 'gianhap';
        } else {
            var nameSl = 'sl' + i;
            var nameGia = 'gianhap' + i;
        }
        let valueSL = $("input[name='" + nameSl + "']").val();
        let valueGia = $("input[name='" + nameGia + "']").val();
        total = Number(total) + (valueSL * valueGia);
    }
    $('#totalTien').val(total);


}