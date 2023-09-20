<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript" src="<?php echo base_url('');?>aila_cbt/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="<?php echo base_url('');?>aila_cbt/js/materialize.min.js"></script>

<!-- Chart Js -->
<script type="text/javascript" src="<?php echo base_url('');?>aila_cbt/js/Chart.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('');?>aila_cbt/js/datatables.min.js"></script>

<script>
	const sideNav = document.querySelectorAll('.sidenav');
	M.Sidenav.init(sideNav,{
		draggable: true,
		inDuration:  200
	});  

	const popup = document.querySelectorAll('.modal');
	M.Modal.init(popup);

	const Select = document.querySelectorAll('select');
	M.FormSelect.init(Select);
	
	const materialbox = document.querySelectorAll('.materialboxed');
	M.Materialbox.init(materialbox);
	
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

    <?php if ($this->uri->segment(1) == 'admin') { ?>

      var table;
      var group_id = <?=(isset($group_id) ? $group_id : '0');?>;

      $(document).ready(function() {

    //datatables
    table = $('#studentTable').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": false, //Feature control DataTables' server-side processing mode.
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
            "orderable": false, //set not orderable
        },
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

</script>

</body>
</html>