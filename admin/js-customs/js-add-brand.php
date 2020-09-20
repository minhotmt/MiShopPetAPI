<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm').validate({
    rules: {
      brand_name: {
        required: true
      },
      thumbnail: {
        required: true
      }
    },
    messages: {
      brand_name: {
        required: "Vui lòng nhập tên thương hiệu",
      },
      thumbnail: {
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
  });
</script>