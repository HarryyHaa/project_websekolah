<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript" src="<?php echo base_url('');?>stephan_cbt/js/jquery-3.3.1.js"></script>

<script type="text/javascript" src="<?php echo base_url('');?>stephan_cbt/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('');?>stephan_cbt/js/materialize.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('');?>stephan_cbt/js/select2.min.js"></script>
<!-- <script type="text/javascript" src="https://rawgit.com/nikitasnv/materialize-select2/master/select2-materialize.js"></script> -->
<!-- Chart Js -->
<script type="text/javascript" src="<?php echo base_url('');?>stephan_cbt/js/Chart.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('');?>stephan_cbt/js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('');?>stephan_cbt/js/sweetalert2.all.min.js"></script>

<script>

    var baseUrl = '<?=base_url();?>';

    (function (document, $, undefined) {
        $.fn.sm_select = function (options) {
            var defaults = $.extend({
                input_text: 'Select option...',
                duration: 200,
                show_placeholder: false
            }, options);
            return this.each(function (e) {
                $(this).select2(options);
                var select_state;
                var drop_down;
                var obj = $(this);
                $(this).on('select2:open', function (e) {
                    drop_down = $('body>.select2-container .select2-dropdown');
                    drop_down.find('.select2-search__field').attr('placeholder', (($(this).attr('placeholder') != undefined) ?
                        $(this).attr('placeholder') : defaults.input_text));
                    drop_down.hide();
                    setTimeout(function () {
                        if (defaults.show_placeholder == false) {
                            var out_p = obj.find('option[placeholder]');
                            out_p.each(function () {
                                drop_down.find('li:contains("' + $(this).text() + '")').css('display', 'none');
                            });
                        }
                        drop_down.css('opacity', 0).stop(true, true).slideDown(defaults.duration, 'easeOutCubic', function () {
                            drop_down.find('.select2-search__field').focus();
                        }).animate(
                        {opacity: 1},
                        {queue: false, duration: defaults.duration}
                        )
                    }, 10);
                    select_state = true;
                });
                $(this).on('select2:closing', function (e) {
                    if (select_state) {
                        e.preventDefault();
                        drop_down = $('body>.select2-container .select2-dropdown');
                        drop_down.slideUp(defaults.duration, 'easeOutCubic', function () {
                            obj.select2('close');
                        }).animate(
                        {opacity: 0},
                        {queue: false, duration: defaults.duration, easing: 'easeOutSine'}
                        );
                        select_state = false;
                    }
                });
            });
        };
    })(document, jQuery);

    const sideNav = document.querySelectorAll('.sidenav');
    M.Sidenav.init(sideNav,{
      draggable: true,
      inDuration:  200
  });  

    const popup = document.querySelectorAll('.modal');
    M.Modal.init(popup);

    const materialbox = document.querySelectorAll('.materialboxed');
    M.Materialbox.init(materialbox);

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems,{
            format : 'yyyy-mm-dd'
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(elems, {
            twelveHour : false,
        });
    });
    
    $(document).ready(function() {
        $(".button-collapse").sidenav();
        $('.collapsible').collapsible();

        $('#dataTables').DataTable( {
         columnDefs: [
         {
            targets: [ 0, 1, 2 ],
            className: 'mdl-data-table__cell--non-numeric'
        }
        ]
    } );
    } );


    var table;

    <?php if (($this->uri->segment(1) == 'admin') OR ($this->uri->segment(1) == 'teacher')) { ?>

        $(document).ready(function() {

         $('#classroom_list').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order"      : [],
            "ajax"       : {
                "url"   : "<?php echo site_url($this->uri->segment(1).'/classroom/get_classroom_json');?>",
                "type"  : "POST"
            },
            "columnDefs" : [
            {
                "targets"   : [ 0 ],
                "orderable" : true
            }
            ],
        });

         $('#classroom_list_kartu').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order"      : [],
            "ajax"       : {
                "url"   : "<?php echo site_url($this->uri->segment(1).'/student_card/get_classroom_json');?>",
                "type"  : "POST"
            },
            "columnDefs" : [
            {
                "targets"   : [ 0 ],
                "orderable" : true
            }
            ],
        });

          $('#classroomArchiveList').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order"      : [],
            "ajax"       : {
                "url"   : "<?php echo site_url($this->uri->segment(1).'/classroom/get_classroom_json_archive');?>",
                "type"  : "POST"
            },
            "columnDefs" : [
            {
                "targets"   : [ 0 ],
                "orderable" : true
            }
            ],
        });

         $('#quizName').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order"      : [],
            "ajax"       : {
                "url"   : "<?php echo site_url($this->uri->segment(1).'/quiz/get_quiz_name_json');?>",
                "type"  : "POST"
            },
            "columnDefs" : [
            {
                "targets"   : [ 0 ],
                "orderable" : true
            }
            ],
        });

         $('#quizNameArchive').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order"      : [],
            "ajax"       : {
                "url"   : "<?php echo site_url($this->uri->segment(1).'/quiz/get_quiz_name_archive_json');?>",
                "type"  : "POST"
            },
            "columnDefs" : [
            {
                "targets"   : [ 0 ],
                "orderable" : true
            }
            ],
        });

         $('#scoreList').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order"      : [],
            "ajax"       : {
                "url"   : "<?php echo site_url($this->uri->segment(1).'/classroom/get_presensi_json/'.(isset($classroom_id) ? $classroom_id : NULL).'/'.$this->uri->segment(4).'/'.(isset($essay_total) ? $essay_total : NULL));?>",
                "type"  : "POST"
            },
            "columnDefs" : [
            {
                "targets"   : [ 0 ],
                "orderable" : true
            }
            ],
        });

         $("#multiple_choice_percentage").on('input propertychange change', function() {
            var multiple_choice_percentage = $("#multiple_choice_percentage").val();
            var essay_percentage = 0;
            if ((multiple_choice_percentage > 100) || (multiple_choice_percentage < 0) ) {
                multiple_choice_percentage = 100;
            } 
            essay_percentage = 100 - multiple_choice_percentage;
            $("#essay_percentage").val(essay_percentage);
            $("#multiple_choice_percentage").val(multiple_choice_percentage);
        });

          $("#essay_percentage").on('input propertychange change', function() {
            var essay_percentage = $("#essay_percentage").val();
            var multiple_choice_percentage = 0;
            if ((essay_percentage > 100) || (essay_percentage < 0) ) {
                essay_percentage = 100;
            } 
            multiple_choice_percentage = 100 - essay_percentage;
            $("#multiple_choice_percentage").val(multiple_choice_percentage);
            $("#essay_percentage").val(essay_percentage);
        });

     } );
    <?php } ?>

    <?php if ($this->uri->segment(1) == 'admin') { ?>

      var group_id = <?=(isset($group_id) ? $group_id : '0');?>;

      $(document).ready(function() {

    //datatables
    table = $('#studentTable').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/student/ajax_student_list/'.(isset($group_id) ? $group_id : '0'))?>",
            "type": "POST"
        },
        
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": true, //set not orderable
        },
        ],
        
    });

    table = $('#teacherTable').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order"      : [],
        "ajax"       : {
            "url"   : "<?php echo site_url('admin/teacher/ajax_teacher_list');?>",
            "type"  : "POST"
        },
        "columnDefs" : [
        {
            "targets"   : [ 0 ],
            "orderable" : true
        }
        ],
    });

    
    
});

      function edit_person(id)
      {
        save_method = 'update';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error');
        $('.help-block').empty(); 

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('admin/student/student_ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.firstName);
            $('[name="lastName"]').val(data.lastName);
            $('[name="gender"]').val(data.gender);
            $('[name="address"]').val(data.address);
            $('[name="dob"]').datepicker('update',data.dob);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}



function getRandomColor() {
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
}
return color;
}

<?php if (isset($groups_grafik)) {?>

    var ctx = document.getElementById('studentReport').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
            <?php foreach ($groups_grafik as $group_name) {
               echo '"'.$group_name->name.'",';
           }?>],
           datasets: [{
            label: 'Terbanyak',
            data: [
            <?php foreach ($groups_grafik as $group_name) {
                echo $group_name->total.',';
            }?>],
            backgroundColor: [
            <?php foreach ($groups_grafik as $group_name) {?>
                getRandomColor(),
            <?php }?>
            ]
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

<?php } } ?>



$(document).ready(function(){
    $('.select2').sm_select({
      show_placeholder:true,
      duration: 500,
      input_text: 'Cari disini...'
  });
})

showClock();
var timeout = setInterval(showClock, 1000);   
function showClock () {
    $('#clock').load(baseUrl + 'main/server_time');
}

// Listen for click on toggle checkbox
$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});


const flashSuccess = $('#flashSuccess').data('success');
if (flashSuccess) {
    Swal.fire({
      icon: 'success',
      title : 'Sukses',
      text  : flashSuccess.replace( /(<([^>]+)>)/ig, '')
  });
}

const flashFailed = $('#flashFailed').data('failed');
if (flashFailed) {
    Swal.fire({
      icon: 'error',
      title : 'Gagal',
      text  : flashFailed.replace( /(<([^>]+)>)/ig, '')
  });
}

$('#totalTeacher').load(baseUrl + 'admin/home/get_total_teacher');
$('#totalStudent').load(baseUrl + 'admin/home/get_total_student');
$('#totalClassroom').load(baseUrl + 'admin/home/get_total_classroom');
$('#totalQuizName').load(baseUrl + 'admin/home/get_total_quiz_name');

</script>

</body>
</html>