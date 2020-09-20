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

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<script>
  $(document).ready(function() {
  $('input[type="file"]').on("change", function() {
    let filenames = [];
    let files = document.getElementById("customFile").files;
    if (files.length > 0) {
      filenames.push("Hình ảnh (" + files.length + ")");
    }
    $(this)
      .next(".custom-file-label")
      .html(filenames.join(","));
  });
});
</script>

<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm').validate({
    rules: {
      name: {
        required: true,
      },
      price: {
        required: true,
      },
      "img[]": {
        required: true,
      },
      category: {
        required: true,
      }
    },
    messages: {
      name: {
        required: "Vui lòng nhập tên sản phẩm",
      },
      price: {
        required: "Vui lòng nhập giá sản phẩm",
      },
      "img[]": {
        required: "Vui lòng chọn hình ảnh cho sản phẩm",
      },
      category: {
        required: "Vui lòng chọn danh mục",
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
      name: {
        required: true,
      },
      price: {
        required: true,
      }
    },
    messages: {
      name: {
        required: "Vui lòng nhập tên sản phẩm",
      },
      price: {
        required: "Vui lòng nhập giá sản phẩm",
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