<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm').validate({
    rules: {
      category_name: {
        required: true,
      },
      banner: {
        required: true,
      }
    },
    messages: {
      category_name: {
        required: "Vui lòng nhập tên danh mục",
      },
      banner: {
        required: "Vui lòng chọn 1 hình ảnh",
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
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>