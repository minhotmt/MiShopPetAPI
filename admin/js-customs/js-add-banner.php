<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm').validate({
    rules: {
      banner: {
        required: true,
      }
    },
    messages: {
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