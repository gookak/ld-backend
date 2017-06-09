
//get filename
function getfilename(filename) {
    //var file = path.substr(path.lastIndexOf('\\') + 1);
    var name = filename.split('.');
    return name[0];
}

//get filetype
function getfiletype(filename) {
    var name = filename.split('.');
    return name[1];
}

//get filename
//function getfilename(path) {
//    var file = path.substr(path.lastIndexOf('\\') + 1);
//    var filename = file.split('.');
//    return filename[0];
//}

//get filetype
//function getfiletype(path) {
//    var file = path.substr(path.lastIndexOf('\\') + 1);
//    var filename = file.split('.');
//    return filename[1];
//}

//Convert Array to Sting Json
$.fn.serializeObject = function ()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

//คำนวณหา total จำนวนชั่วโมง 
function caltotalnumhr(sector) {
    var total = 0;
    $(sector).each(function () {
        total = total + parseFloat($(this).val());
    });
    return total.toFixed(2);
}

//คำนวณหา จำนวนชั่วโมง
function calnumhr(t1, t2, hrdel) {
    var t1mt = calmt(t1);
    var t2mt = calmt(t2);
    var del = parseFloat(hrdel) * 60;
    var numhr = (t2mt - t1mt - del) / 60;

    var rstime = showtime(numhr.toString());
    //console.log(t1 + ":" + t2);
    //console.log(rstime);
    return rstime;
}

function calmt(strtime) {       //หาจำนวนชั่วโมงที่ใช้
    var i = strtime.split(".");
    var d = new Date();
    d.setHours(i[0]);
    d.setMinutes(i[1]);
    //console.log(d);
    var hr = d.getHours();
    var mt = d.getMinutes();
    //console.log(hr + ":" + mt);
    var rs = (hr * 60) + mt;
    //console.log(rs);
    return rs;
}
function showtime(numhr) {      //แปลงจำนวนชั่วโมงที่ใช้ เป็นรูปแบบของเวลา (2.30 -> สองชั่วโมงสามสิบนาที)
    var j = numhr.split(".");
    var hr = j[0];
    var rsmod = parseFloat(numhr) % hr;
    //console.log(hr + ":" + rsmod);
    var mt = rsmod * 60;
    //console.log(mt);
    var rs = hr.toString() + ".";
    if (mt.toFixed(0) < 10) {
        rs += "0" + mt.toFixed(0).toString();
    } else {
        rs += mt.toFixed(0).toString();
    }
    //console.log(rs);
    return rs;
}
//end คำนวณหา จำนวนชั่วโมง

//คำนวณหา จำนวนชั่วโมง ไม่แปลงนาที
function calnumhrnotconvertmt(t1, t2, hrdel) {
    var sum = ((parseFloat(t2) - parseFloat(t1)) - parseFloat(hrdel)).toFixed(2);
    return sum;
}

//เลือกเวลา select time
function selecttime(selector) {
    var str = '';
    for (i = 7; i <= 17; i++) {
        var j = i + 0.30;
        str += '<option value="' + i.toFixed(2) + '">' + i.toFixed(2) + '</option>';
        str += '<option value="' + j.toFixed(2) + '">' + j.toFixed(2) + '</option>';
    }
    $(selector).append(str);
}

//หา total แต่ละ column
function fnTotal(ele) {
    var total = 0;
    $(ele).each(function () {
        total += Number($(this).val());
    });
    return total.toFixed(2);
    //$("#tbdatetrain input[name=timeTotal]").val(dateTimeSum.toFixed(2));
}

//ConvertDateToNumber: dateSt>> 20/11/2014 return>> 20141125
function fnConvertDateToNumber(dateSt) {
    var ar = dateSt.split("/");
    var rs = ar[2] + ar[1] + ar[0];
    return Number(rs);
}

//ConvertStToDate: st>>20141125 return>> 20/11/2014
function fnConvertStToDate(st) {
    var y = Number(st.substring(0, 4));
    var m = Number(st.substring(4, 6));
    var d = Number(st.substring(6, 8));
    var rs = (d < 10 ? "0" : "") + d + "/" +
            (m < 10 ? "0" : "") + m + "/" +
            y;
    //alert(d + " : " + m + " : " + y);
    //alert( (d < 10 ? "0" : "") + d );
    //alert(rs);
    return rs;
}

//GetCurrentDate: return>> dd/mm/yy
function getCurrentDate_ddmmyy() {
    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var year = d.getFullYear();
    var output = (day < 10 ? '0' : '') + day + '/' +
            (month < 10 ? '0' : '') + month + '/' +
            year;
    return output;
}


//clear form
function clearform(ele) {       //ex>> ele = "form[name=form-edit]"
    $(ele).find(':input').each(function () {
        switch (this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}



//checkBoxAllMutiTablePerPage
function checkBoxAllMutiTablePerPage(idCheckAll, idCheck) {
    $(idCheckAll).click(function () {
        if ($(this).is(':checked')) {
            $(idCheck).each(function () {
                $(this).prop("checked", true);
                // $(this).parent().parent().parent().addClass("success");
            });
        } else {
            $(idCheck).each(function () {
                $(this).prop("checked", false);
                // $(this).parent().parent().parent().removeClass("success");
            });
        }
    });

    $(idCheck).click(function () {
        $(idCheck).each(function () {
            if ($(this).is(':checked')) {
                // $(this).parent().parent().parent().addClass("success");
            } else {
                $(idCheckAll).prop("checked", false);
                // $(this).parent().parent().parent().removeClass("success");
            }
        });
    });
}


//Check Box All
function checkBoxAll(idCheckAll) {
    $(idCheckAll).click(function () {
        if ($(this).is(':checked')) {
            $("tbody input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
        } else {
            $("tbody input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });

    $("tbody input[type=checkbox]").click(function () {
        $("tbody input[type=checkbox]").each(function () {
            if ($(this).prop("checked") === false) {
                $(idCheckAll).prop("checked", false);
            }
        });
    });
}

//show MsgSuccess
function showMsgSuccess(sectorForShow, msg) {  //"sector"
    $(sectorForShow).prepend('<div id="msgError" class="alert alert-success" role="alert">'
            + '<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>'
            + '<strong>Success : </strong> ' + msg + '<br></div>');
}

//show MsgError
function showMsgError(sectorForShow, msg) {  //"sector"
    $(sectorForShow).prepend('<div id="msgError" class="alert alert-danger" role="alert">'
            + '<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>'
            + '<strong>Error : </strong> ' + msg + '<br></div>');
}

//show MsgWarning
function showMsgWarning(sectorForShow, msg) {  //"sector"
    $(sectorForShow).prepend('<div id="msgError" class="alert alert-warning" role="alert">'
            + '<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>'
            + '<strong>Warning : </strong> ' + msg + '<br></div>');
}

//keyup toUpperCase
function validatKeyupToUpperCase(stSector) {
    $(stSector).bind("keyup", function () {    //กรอกได้เฉพาะตัวพิมพ์ใหญ่เท่านั้น
        $(this).val($(this).val().toUpperCase());
    });
}