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
        required: true
      },
      thumbnail: {
        required: true
      },
      select: {
        required: true
      }
    },
    messages: {
      category_name: {
        required: "Vui lòng nhập tên danh mục",
      },
      thumbnail: {
        required: "Vui lòng chọn 1 hình ảnh",
      },
      select: {
        required: "Vui lòng chọn loại danh mục",
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
      category_name: {
        required: true
      }
    },
    messages: {
      category_name: {
        required: "Vui lòng nhập tên danh mục",
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
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>