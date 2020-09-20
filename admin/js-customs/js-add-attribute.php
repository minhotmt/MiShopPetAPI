<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm1').validate({
    rules: {
      color_name: {
        required: true,
      }
    },
    messages: {
      color_name: {
        required: "Vui lòng nhập tên màu sắc",
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('#quickForm2').validate({
    rules: {
      size_name: {
        required: true,
      }
    },
    messages: {
      size_name: {
        required: "Vui lòng nhập size",
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      "language": {
        "emptyTable": "Không có dữ liệu"
      }
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
      "language": {
        "emptyTable": "Không có dữ liệu"
      }
    });
  });
</script>