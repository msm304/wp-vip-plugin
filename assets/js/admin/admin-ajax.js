jQuery(document).ready(function ($) {
  $(".find-transaction").on("click", function (e) {
    e.preventDefault();
    let el = $(this);
    let t_id = el.data("id");
    $.ajax({
      type: "POST",
      url: vip_ajax.ajax_url,
      dataType: "JSON",
      data: {
        action: "findById",
        t_id: t_id,
        _nonce: vip_ajax._nonce,
      },
      beforeSend: function () {
        $(".vip-loading-icon").addClass("active-loading");
        $(".vip-pencil").hide();
      },
      success: function (response) {
        if (response.success) {
          $(".t-price").val(response.price);
          $(".t-plan-type").val(response.plan_type);
          $(".t-order-number").val(response.order_number);
          $(".t-refNumber").val(response.refNumber);
          $(".t-status").val(response.status);
          $(".t-id").val(response.id);
        }
      },
      error: function (error) {
        if (error.responseJSON.message) {
          if (error) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Something went wrong!",
              footer: '<a href="#">Why do I have this issue?</a>',
            });
          }
        }
      },
      complete: function () {
        $(".vip-loading-icon").removeClass("active-loading");
        $(".vip-pencil").show();
      },
    });
  });

  $(".update-transaction").on("submit", function (e) {
    e.preventDefault();
    // let el = $(this);
    let t_price = $(".t-price").val();
    let t_plan_type = $(".t-plan-type").val();
    let t_order_number = $(".t-order-number").val();
    let t_refNumber = $(".t-refNumber").val();
    let t_status = $(".t-status").val();
    let t_id = $(".t-id").val();
    $.ajax({
      type: "POST",
      url: vip_ajax.ajax_url,
      dataType: "JSON",
      data: {
        action: "updateById",
        t_price: t_price,
        t_plan_type: t_plan_type,
        t_order_number: t_order_number,
        t_refNumber: t_refNumber,
        t_status: t_status,
        t_id: t_id,
        _nonce: vip_ajax._nonce,
      },
      success: function (response) {
        if (response.success) {
          Swal.fire({
            title: "انجام شد",
            text: "بروزرسانی اطلاعات با موفقیت انجام شد",
            icon: "success",
            confirmButtonText: "تایید",
          });
        }
      },
      error: function (error) {
        if (error.responseJSON.error) {
          if (error) {
            Swal.fire({
              icon: "error",
              title: "توجه !",
              text: error.responseJSON.message,
              confirmButtonText: "تایید",
            });
          }
        }
      },
    });
  });

  $(".add-transaction").on("submit", function (e) {
    e.preventDefault();
    // let el = $(this);
    let plan_type = $(".plan-type").val();
    let first_name = $(".first-name").val();
    let last_name = $(".last-name").val();
    let email = $(".email").val();
    let order_number = $(".order-number").val();
    let refNumber = $(".refNumber").val();
    let price = $(".price").val();
    let status = $(".status").val();
    $.ajax({
      type: "POST",
      url: vip_ajax.ajax_url,
      dataType: "JSON",
      data: {
        action: "saveTransactionByAdmin",
        plan_type: plan_type,
        first_name: first_name,
        last_name: last_name,
        email: email,
        order_number: order_number,
        refNumber: refNumber,
        price: price,
        status: status,
        _nonce: vip_ajax._nonce,
      },
      success: function (response) {
        if (response.success) {
          $(".show-message")
            .show()
            .addClass("uk-alert-success")
            .removeClass("uk-alert-danger")
            .text(response.message);
        }
      },
      error: function (error) {
        if (error.responseJSON.error) {
          if (error) {
            $(".show-message")
              .show()
              .addClass("uk-alert-danger")
              .removeClass("uk-alert-success")
              .text(error.responseJSON.message);
          }
        }
      },
    });
  });
});
