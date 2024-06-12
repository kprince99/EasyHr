function time() {
  const date = new Date(Date.now());
  return date.toLocaleString("en-US", {
    hour: "numeric",
    minute: "numeric",
    second: "numeric",
    hour12: true,
  });
}

function date() {
  const date = new Date(Date.now());
  const currDate = date.getDate();
  const currMonth = date.toLocaleString("en-IN", { month: "long" });
  const currYear = date.getFullYear();

  return { day: currDate, month: currMonth, year: currYear };
}

if (!window.location.hash && window.location.pathname.endsWith("zp.php")) {
  window.location.href = window.location.pathname + "#dashboard";
}

$(document).ready(() => {
  if (window.location.hash) {
    var hash = window.location.hash.substring(1);
    if (hash) {
      var targetUrl = hash + ".php";
      $(".content-wrapper").load(targetUrl);
    }
  }

  $(".todayDate").text(
    date().currDate + "th " + " " + date().currMonth + " " + date().currYear
  );

  setInterval(() => {
    time();
    $(".time").text(time);
  }, 1000);

  $(document).on(
    "click",
    ".content-wrapper .bx-chevron-left, .content-wrapper .bx-x, #formReset",
    function () {
      $(".employee-list").removeClass("d-none").addClass("d-block");
      $(".employee-form-update").addClass("d-none");
    }
  );

  $(document).on("click", ".content-wrapper #edit-profile", function () {
    $(".content-wrapper .rounded-lg-extra").addClass("user-edit");
    $(".content-wrapper .staticData").css("display", "none");
    $(".content-wrapper .save-btn").addClass("d-block");
    $(".content-wrapper .editable-input").addClass("active");
  });

  //to check the checkbox using jquery
  $(".btn-close-sidebar").click(function () {
    $("#checkbox").prop("checked", !$("#checkbox").prop("checked"));
  });

  $(document).on("click", "#cancelDelete", function () {
    $("#deleteConfirmation").modal("hide");
  });

  //to load the page on event trigger

  $(document).on("click", ".nav-item .nav-links", function (e) {
    e.preventDefault();
    var customName = $(this).data("url");
    $(".content-wrapper").load(e.target.href, function (response, status, xhr) {
      if (status === "error") {
        console.error("Error loading content from " + xhr.statusText);
      } else {
        window.location.hash = customName;
      }
    });
  });

  $(document).on("click", ".content-wrapper a[data-role=delete]", function (e) {
    e.preventDefault();

    var row = $(this).closest("tr");
    var id = $(this).data("id");
    $("#deleteConfirmation").modal("show");
    $("#confirmDelete").off("click").click(function () {
        $.ajax({
          type: "GET",
          url: "/includes/commonFunction.php",
          data: { deleteId: id },
          success: function (data) {
            row.fadeOut(500, function () {
              $(this).remove();
            });
          },
          complete: function () {
            $("#deleteConfirmation").modal("hide");
          },
        });
      });
  });

  $(document).on("click", ".content-wrapper a[data-role=update]", function (e) {
    e.preventDefault();

    $(".employee-list").addClass("d-none").removeClass("d-block");
    $(".employee-form-update").removeClass("d-none");
    var id = $(this).data("id");

    $.ajax({
      type: "GET",
      url: "/includes/commonFunction.php",
      data: { editId: id },
      success: function (data) {
        var userId = JSON.parse(data);

        $("#employeeID").val(userId.EmployeeID);
        $("#FullName").val(userId["Full Name"]);
        $("#Department").val(userId.Department);
        $("#Email").val(userId.Email);
        $("#Title").val(userId.Position);
        $("#MobileNumber").val(userId.Mobile_no);
        $("#Joining").val(userId["Joining Date"]);
        $("#SourceOfHire").val(userId["Source_of_Hire"]);
      },
      error: function (error) {
        console.error("Error:- ", error);
      },
    });
  });

  $(document).on("submit", ".content-wrapper #editForm", function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "/includes/commonFunction.php",
      data: $(this).serialize(),
      success: function (data) {
        console.log(data);
        window.location.reload();
      },
      error: function () {
        alert("There was an error updating your profile.");
      },
    });
  });

  $(document).on("click", ".content-wrapper #formSubmit", function (e) {
    e.preventDefault();
    var data = $("#editFormSubmit").serialize();

    $.ajax({
      type: "POST",
      url: "/includes/commonFunction.php",
      data: { updateUser: data },
      success: function (data) {
        console.log(data);
      },
    });
  });
});
