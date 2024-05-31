//  ======>>>  https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-cloudServices_tokenUrl
// URL-адрес конечной точки токена безопасности в вашем приложении.
//Роль этой конечной точки заключается в безопасной авторизации конечных пользователей
// вашего приложения для использования облачных сервисов CKEditor только в том случае,
// если у них должен быть доступ, например, для загрузки файлов с помощью Easy Image.
/* Дополнительную информацию о конечных точках токенов можно найти в документации Easy Image
 — Quick Start :
   https://ckeditor.com/docs/cs/latest/guides/easy-image/quick-start.html#create-token-endpoint
 and Cloud Services — Создание конечных точек токенов:
   https://ckeditor.com/docs/cs/latest/guides/token-endpoints/tokenendpoint.html
 Без правильно работающей конечной точки токена (URL токена) плагины CKEditor не смогут
   подключаться к облачным службам CKEditor.
      В ТАКОМ СЛУЧАЕ  НУЖНО ДОБАВИТЬ ЭТОТ КОД::*/
//  CKEDIКTOR.replace( 'editor1', {
//     extraPlugins: 'easyimage',
//     cloudServices_tokenUrl: 'https://example.com/cs-token-endpoint',
//     cloudServices_uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
// } );
//CKEDITOR.replace('editor1');

// $("#editor1").ckeditor();
// $('#editor2').ckeditor();
// $('#editor3').ckeditor();
// $('#editor4').ckeditor();

//  var editor = CKEDITOR.replace( 'editor1' );
//  CKFinder.setupCKEditor( editor );


$('.delete').on("click", function () {
    var res = confirm('Confirm  deletion');
    if (!res) return false;

});

$('.del-img').on('click', function () {
    var res = confirm('Confirm  deletion');
    if (!res) return false;
    var $this = $(this),
        id = $this.data('id'),
        src = $this.data('src');
    $.ajax({
        url: adminpath + '/product/delete-img ',
        data: { id: id, src: src },
        type: 'POST',
        beforeSend: function () {
            $this.closest('.file-upload').find('.overlay').css({ 'display': 'block' });
        },
        success: function (res) {
            setTimeout(function () {
                $this.closest('.file-upload').find('.overlay').css({ 'display': 'none' });
                if (res == 1) {
                    $this.fadeOut();
                }
            }, 1000);
        },
        error: function () {
            setTimeout(function () {
                $this.closest('.file-upload').find('.overlay').css({ 'display': 'none' });
                alert('Error');
            }, 1000);
        }
    });
});


$('.del-item').on('click', function () {
    var res = confirm('Confirm  deletion');
    if (!res) return false;
    var $this = $(this),
        id = $this.data('id'),
        src = $this.data('src');
    $.ajax({
        url: adminpath + '/product/delete-gallery',
        data: { id: id, src: src },
        type: 'POST',
        beforeSend: function () {
            $this.closest('.file-upload').find('.overlay').css({ 'display': 'block' });
        },
        success: function (res) {
            setTimeout(function () {
                $this.closest('.file-upload').find('.overlay').css({ 'display': 'none' });
                if (res == 1) {
                    $this.fadeOut();
                }
            }, 1000);
        },
        error: function () {
            setTimeout(function () {
                $this.closest('.file-upload').find('.overlay').css({ 'display': 'none' });
                alert('Error');
            }, 1000);
        }
    });
});


$('.sidebar-menu a').each(function () {
    var location = window.location.protocol + '//' + window.location.host + window.location.pathname;
    var link = this.href;
    if (link == location) {
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
})

// $('#tab').on("click", function(){
//     if(!$('#tab').on("click")) return false;
//     else $('#filter input[type=radio]').prop('checked', false);
//     return false;  // ЧТОБЫ НЕ БЫЛ ПЕРЕХОД ПО ССЫЛКЕ, т.к. ЭТА КНОПКА ИМЕЕТ ССЫЛКУ
//   });

$('#reset-filter').on("click", function () {
    $('#filter input[type=radio]').prop('checked', false);
    return false;  // ЧТОБЫ НЕ БЫЛ ПЕРЕХОД ПО ССЫЛКЕ, т.к. ЭТА КНОПКА ИМЕЕТ ССЫЛКУ
});

$(".select2").select2();

// $(".select2").select2({
//     placeholder: "Start entering the product name",
//     //minimumInputLength: 2,
//     cache: true,
//     ajax: {
//         url: adminpath + "/posts/",
//         delay: 250,
//         dataType: 'json',
//         data: function (params) {
//             return {
//                 q: params.term,
//                 page: params.page
//             };
//         },
//         processResults: function (data, params) {
//             return {
//                 results: data.items,
//             };
//         }
//     }
// });


if ($('div').is('#multi')) {
    var buttonSingle = $("#single"),
        buttonMulti = $("#multi"),
        file;
}
if (buttonSingle) {
    new AjaxUpload(buttonSingle, {
        action: adminpath + buttonSingle.data('url') + "?upload=1",
        data: { name: buttonSingle.data('name') },
        name: buttonSingle.data('name'),
        onSubmit: function (file, ext) {
            if (!(ext && /^(jpg|png|jpeg|gif)$/i.test(ext))) {
                alert('Error! Allowed only Images');
                return false;
            }  // ИЩЕМ РОДИТ.БЛОК file-upload, НАХОДИМ ЭЛЕМ С КЛАС overlay И ПОКАЗЫВАЕМ БЛОК ЗАГРУЗКИ ЛОАДЕРА см. add.php СТРОКИ 120 и 135
            buttonSingle.closest('.file-upload').find('.overlay').css({ 'display': 'block' });

        },
        onComplete: function (file, response) {
            setTimeout(function () {
                buttonSingle.closest('.file-upload').find('.overlay').css({ 'display': 'none' });
                // ТЕПЕРЬ СКРЫВАЕМ БЛОК ЗАГРУЗКИ ЛОАДЕРА

                response = JSON.parse(response);
                $('.' + buttonSingle.data('name')).html('<img src="/images/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}


if (buttonMulti) {
    new AjaxUpload(buttonMulti, {
        action: adminpath + buttonMulti.data('url') + "?upload=1",
        data: { name: buttonMulti.data('name') },
        name: buttonMulti.data('name'),
        onSubmit: function (file, ext) {
            if (!(ext && /^(jpg|png|jpeg|gif)$/i.test(ext))) {
                alert('Error! Allowed only Images');
                return false;
            }
            buttonMulti.closest('.file-upload').find('.overlay').css({ 'display': 'block' });

        },
        onComplete: function (file, response) {
            setTimeout(function () {
                buttonMulti.closest('.file-upload').find('.overlay').css({ 'display': 'none' });

                response = JSON.parse(response);
                $('.' + buttonMulti.data('name')).append('<img src="/images/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}

/*  modification of the products===================================  */
/*
$('#btn_for_modification').on("click", function(){

    $(this).before('<div class="form-group modification">\
    <label for="modification_title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Modification product: &nbsp;</label>\
                <input type="text" name="modification_title[]" class="form-control modification_title" id="modification_title"\
                value="" placeholder="Modification product">\
                <label for="modification_price">&nbsp;&nbsp;Modification price: &nbsp;</label>\
                <input type="text" name="modification_price[]" class="form-control modification_price" id="modification_price"
                value="" placeholder="Modification price" pattern="^[0-9.]{1,}$"  data-error="Numbers and decimals are allowed">
                <div class="help-block with-errors mod"></div>\
    </div>'
    );
    $('form').validator('update');

});
===================================================================*/

$('#add').on('submit', function () {
    if (!isNumeric($('#category_id').val())) {
        alert('Select category');
        return false;
    }
})

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}


