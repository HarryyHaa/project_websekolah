<?php
require "config/database.php";
require "config/function.php";
require "config/functions.crud.php";
?>
<div class="row ">
    <div class="col-md-6 animated bounceInLeft">
        <div class="card">
            <div class="card-header">
                <h5>LOGIN MASUK</h5>
            </div>
            <form id="form-login">
                <div class="card-body">

                    <div class="form-group">
                        <label for="username">Masukan No Pendaftaran</label>
                        <input type="text" onkeyup="this.value = this.value.toUpperCase()" class="form-control" name="username" placeholder="username" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="inputPassword4">Masukan Password</label>
                        <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
                    </div>

                    <div class="form-group mb-0">
                        <p>* Masukan sesuai username dan password yang diberikan</p>
                        <p>* jika belum dapat password silahkan hubungi panitia</p>

                    </div>
                </div>
                <div class="card-footer">
                    <button id='btnsimpan' type="submit" class="btn btn-lg btn-primary">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 animated bounceInRight">
        <div class="card">
            <div class="card-header">
                <h4>Info Lebih Lanjut</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled user-details list-unstyled-border list-unstyled-noborder">
                    <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png">
                        <div class="media-body">
                            <div class="media-title">Ernasari</div>
                            <div class="text-job text-muted"></i>+62 822-1839-7431</div>
                        </div>

                    </li>
                    <li class="media">
                        <img alt="image" class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-5.png">
                        <div class="media-body">
                            <div class="media-title">Nita Susanti</div>
                            <div class="text-job text-muted"></i>+62 821-2000-4562</div>
                        </div>

                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $('#form-login').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'crud_web.php?pg=login',
            data: $(this).serialize(),
            beforeSend: function() {
                $('#btnsimpan').prop('disabled', true);
            },
            success: function(data) {
                var json = $.parseJSON(data);
                $('#btnsimpan').prop('disabled', false);
                if (json.pesan == 'ok') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Login Berhasil',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.href = "user";
                    }, 2000);

                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: json.pesan,
                        position: 'topCenter'
                    });
                }
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });
    if (jQuery().daterangepicker) {
        if ($(".datepicker").length) {
            $('.datepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
            });
        }
        if ($(".datetimepicker").length) {
            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD hh:mm'
                },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        }
        if ($(".daterange").length) {
            $('.daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                drops: 'down',
                opens: 'right'
            });
        }
    }
    if (jQuery().select2) {
        $(".select2").select2();
    }
</script>