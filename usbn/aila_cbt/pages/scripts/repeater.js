var FormRepeater = function () {
  base_url = 'http://localhost/eAkademik/';
  base_url1 = 'http://e-akademik.com/eAkademik/';
  base_url2 = 'http://www.eakademik.com/eAkademik/';

    return {
        //main function to initiate the module
        init: function () {
            $('.mt-repeater').each(function(){
                $(this).repeater({
                    show: function () {
                        $(this).slideDown();
                        $('.date-picker').datepicker({
                            rtl: App.isRTL(),
                            orientation: "left",
                            autoclose: true
                        });
                        $(document).ready(function() {
                            $(".swsnism").select2({
                                placeholder : "Pilih NIS"
                            });
                        });
                        $(document).ready(function() {
                            $(".nmswsm").select2({
                                placeholder : "Pilih Siswa"
                            });
                        });
                        $(document).ready( function() {
                            $(".jeniskelm").selectpicker({
                                placeholder: "Jenis Kelamin"
                            });
                        });
                        $(document).ready( function() {
                            $(".jabatanm").selectpicker({
                                placeholder: "- Jabatan -"
                            });
                        });
                        $(".swsnism").change(function(){
                            var index = $(this).parents(".mt-repeater-item").index();
                            index = index + 1;
                            var nis = $('#repeater-sws .mt-repeater-item:nth-child('+index+') .swsnism option:selected').val();
                            $.ajax({
                                type: 'post',
                                url: base_url+'siswa/siswa_per_kelas/nama_model',
                                data : {nis : nis},
                                cache : false,
                                dataType: 'json',
                                success : function(result){
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .nmswsm').val(result['nama']).change();
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .nmswsm').prop("disabled", true);
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .jeniskelm').val(result['jenis_klm']).change();
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .jeniskelm').prop("disabled", true);
                                }
                            });
                        });
                        $(".swsnism").change(function(){
                            var index = $(this).parents(".mt-repeater-item").index();
                            index = index + 1;
                            var nis = $('#repeater-sws .mt-repeater-item:nth-child('+index+') .swsnism option:selected').val();
                            $.ajax({
                                type: 'post',
                                url: base_url1+'siswa/siswa_per_kelas/nama_model',
                                data : {nis : nis},
                                cache : false,
                                dataType: 'json',
                                success : function(result){
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .nmswsm').val(result['nama']).change();
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .nmswsm').prop("disabled", true);
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .jeniskelm').val(result['jenis_klm']).change();
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .jeniskelm').prop("disabled", true);
                                }
                            });
                        });
                        $(".swsnism").change(function(){
                            var index = $(this).parents(".mt-repeater-item").index();
                            index = index + 1;
                            var nis = $('#repeater-sws .mt-repeater-item:nth-child('+index+') .swsnism option:selected').val();
                            $.ajax({
                                type: 'post',
                                url: base_url2+'siswa/siswa_per_kelas/nama_model',
                                data : {nis : nis},
                                cache : false,
                                dataType: 'json',
                                success : function(result){
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .nmswsm').val(result['nama']).change();
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .nmswsm').prop("disabled", true);
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .jeniskelm').val(result['jenis_klm']).change();
                                    $(' #repeater-sws .mt-repeater-item:nth-child('+index+') .jeniskelm').prop("disabled", true);
                                }
                            });
                        });
                    },

                    hide: function (deleteElement) {
                            $(this).slideUp(deleteElement);
                    },

                    ready: function (setIndexes) {

                    }

                });
            });
        }

    };

}();

jQuery(document).ready(function() {
    FormRepeater.init(); 
});
