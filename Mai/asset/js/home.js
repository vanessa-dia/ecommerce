// $(document).ready(function() {
//   $baseUrl = window.location.origin + "/Mai";
//   $("#dialog").dialog({
//     modal: true,
//     autoOpen: false,
//     position: {
//       at: "top"
//     },
//     show: {
//       effect: "blind",
//       duration: 400
//     },
//     hide: {
//       effect: "fold",
//       duration: 400
//     }
//   });
//   function openDialog(text) {
//     $("#dialog p").text(text);
//     $("#dialog").dialog("open");
//   }
//   function filterByType($idType) {
//     let data = { idType: $idType };
//     $.ajax({
//       url: $baseUrl + "/Product/filterByType",
//       data: data
//     }).done(function(e) {
//       $("#product-content").html(e);
//     });
//   }

//   // Quay lại danh sách sản phẩm trang admin
//   $(document).on("click", "#backListProducts", function() {
//     $idType = $("#typeProduct-show").val();
//     if (!$idType) $idType = "all";
//     filterByType($idType);
//   });
//   $("#dialog-editProduct").dialog({
//     modal: true,
//     autoOpen: false,
//     position: {
//       at: "top"
//     },
//     show: {
//       effect: "blind",
//       duration: 400
//     },
//     hide: {
//       effect: "fold",
//       duration: 400
//     }
//   });
//   $("#cart").click(function() {
//     $data = { request: "cart" };
//     $.ajax({
//       data: $data,
//       dataType: "html",
//       url: $baseUrl + "/Home/login"
//     }).done(function(response) {
//       $("#content").html(response);
//     });
//   });
//   $("#signin").click(function() {
//     $data = { request: "signin" };
//     $.ajax({
//       data: $data,
//       dataType: "html",
//       url: $baseUrl + "/Home/Login"
//     }).done(function(response) {
//       $("#content").html(response);
//     });
//   });
//   // khi click vô nút đăng ký thì tạo ajax để lấy cục đăng ký
//   $("#signup").click(function() {
//     $data = { request: "signup" };
//     $.ajax({
//       data: $data,
//       dataType: "html",
//       url: $baseUrl + "/Home/login"
//     }).done(function(response) {
//       $("#content").html(response);
//     });
//   });
//   // Đăng nhập
//   $(document).on("click", "#dangnhap", function() {
//     let url = $baseUrl + "/Profile/signIn";
//     let data = $("#form-signin").serialize();
//     $.ajax({
//       url: url,
//       data: data,
//       type: "POST"
//     }).done(function(e) {
//       if (e) {
//         $("#dialog p").text("Đăng nhập thành công");
//         $("#dialog").dialog("option", "buttons", [
//           {
//             text: "Trang chủ",
//             icon: "ui-icon-home",
//             click: function() {
//               window.location.replace($baseUrl);
//             }
//           }
//         ]);
//         $("#dialog").dialog("open");
//       } else {
//         $("#dialog p").text("Đăng nhập thất bại");
//         $("#dialog").dialog("open");
//       }
//     });
//   });
//   // Đăng ký
//   $(document).on("click", "#dangky", function() {
//     let url = $baseUrl + "/Profile/signUp";
//     let data = $("#form-signup").serialize();
//     $.ajax({
//       url: url,
//       data: data,
//       type: "POST"
//     }).done(function(e) {
//       switch (e) {
//         case "402":
//           $("#dialog p").text("Vui lòng điền đủ thông tin");
//           $("#dialog").dialog("open");
//           break;
//         case "400":
//           $("#dialog p").text("Tài khoản đã tồn tại");
//           $("#dialog").dialog("open");
//           break;
//         case "401":
//           $("#dialog p").text("Nhập lại mật khẩu không khớp");
//           $("#dialog").dialog("open");
//           break;
//         default:
//           $("#dialog p").text("Đăng ký thành công");
//           $("#dialog").dialog("option", "buttons", [
//             {
//               text: "Trang chủ",
//               icon: "ui-icon-home",
//               click: function() {
//                 window.location.replace($baseUrl);
//               }
//             }
//           ]);
//           $("#dialog").dialog("open");
//           break;
//       }
//     });
//   });

//   // định nghĩa các input:date là kiểu datepicker của jquery ui
//   $(".input-date").datepicker({
//     dateFormat: "dd-mm-yy"
//   });

//   // Kiểm tra nếu thông tin người dùng chưa điền đủ thì hiện border màu đỏ
//   // Duyện từng input trong profile
//   $(".input-profile").each(function() {
//     // Đặt input là $this
//     $this = $(this);
//     // Lấy giá trị của input
//     $val = $this.val();
//     // Kiểm tra
//     if ($val == "") {
//       $this.addClass("missInfo");
//       $this.css({ "border-width": "medium", "border-color": "#dc3545" });
//     }
//   });

//   // Chỉnh sửa hô sơ
//   $("#edit-profile").click(function() {
//     $(".input-profile").prop("disabled", false);
//   });

//   // Lưu hồ sơ
//   $("#save-profile").click(function() {
//     let check = false;
//     $("#form-profile input").each(function(k, v) {
//       if (!v.value) {
//         check = true;
//         return false;
//       }
//     });
//     if (check) {
//       $("#dialog p").text("Vui lòng điền đủ thông tin");
//       $("#dialog").dialog("open");
//       return;
//     }
//     $data = $("#form-profile").serialize();
//     if ($data == "") {
//       $("#dialog p").text("Thành công");
//       $("#dialog").dialog("open");
//       return;
//     }
//     $.ajax({
//       url: $baseUrl + "/Profile/update",
//       data: $data,
//       type: "POST"
//     }).done(function(response) {
//       if (response == 1) {
//         $("#dialog p").text("Thành công");
//         $("#dialog").dialog("open");
//         $(".missInfo").css({ "border-width": "", "border-color": "" });
//         $(".input-profile").prop("disabled", true);
//       } else {
//         $("#dialog p").text("Xảy ra lỗi");
//         $("#dialog").dialog("open");
//       }
//     });
//   });

//   // Thêm giỏ hàng - add a new item to cart
//   $(document).on("click", ".btn-addCart", function() {
//     $product = $(this).parents(".product");
//     $id = $(this)
//       .closest(".product-item")
//       .attr("id");
//     $name = $product.find(".product-name").text();
//     $price = $product.find(".product-price").text();
//     $img = $product.find(".product-img").attr("src");
//     $amount = 1;
//     $data = {
//       id: $id,
//       name: $name,
//       price: $price,
//       img: $img,
//       amount: 1,
//       money: $price
//     };
//     $.ajax({
//       url: $baseUrl + "/home/addCart",
//       data: $data,
//       type: "post"
//     }).done(function(e) {
//       $("#iconcart").attr("data-count", e);
//       openDialog("Thêm thành công");
      
//     });
//   });

//   // thêm sản phẩm
//   $("#addProductForm").on("submit", function(e) {
//     e.preventDefault();
//     $check = false;
//     $("#addProductForm .inputRequire").each(function() {
//       $val = $(this).val();
//       if ($val == "") {
//         openDialog("Vui lòng nhập đủ thông tin");
//         $check = true;
//       }
//     });
//     if ($check == true) return;
//     $.ajax({
//       type: "post",
//       url: $baseUrl + "/Product/addProduct",
//       data: new FormData(this),
//       contentType: false,
//       processData: false
//     }).done(function(a) {
//       if (a == "1") {
//         $("#dialog").dialog("option", "buttons", [
//           {
//             text: "ok",
//             icon: "ui-icon-home",
//             click: function() {
//               window.location.replace(window.location.href);
//             }
//           }
//         ]);
//         openDialog("Thêm sản phẩm thành công");
//       } else {
//         openDialog("Xảy ra lỗi");
//       }
//     });
//   });

//   // Load sản phẩm trang admin - Load Product to Admin page
//   $("#nav-listProduct-tab").click(function() {
//     filterByType("all");
//   });

//   // Thêm loại sp
//   $("#addTypetBtn").click(function() {
//     $val = $("#addTypeForm input").val();
//     $data = $("#addTypeForm").serialize();
//     $.ajax({
//       url: $baseUrl + "/Product/addType",
//       type: "post",
//       data: $data
//     }).done(function() {
//       $("#dialog p").text("Đã thêm loại: " + $val);
//       $("#dialog").dialog("option", "buttons", [
//         {
//           text: "Ok",
//           click: function() {
//             window.location.replace(window.location.href);
//           }
//         }
//       ]);
//       $("#dialog").dialog("open");
//     });
//   });

//   // Xem sản phẩm
//   $(document).on("click", ".item", function() {
//     $id = $(this)
//       .parents(".product-item")
//       .attr("id");
//     $data = { id: $id };
//     $.ajax({
//       url: $baseUrl + "/product/getById",
//       data: $data
//     }).done(function(e) {
//       $("#product-content").html(e);
//     });
//   });

//   // Tìm kiếm sản phẩm
//   $("#typeProduct-show").on("change", function() {
//     $idType = this.value;
//     filterByType($idType);
//   });

//   $(".filterProductHome").click(function() {
//     $id = $(this)
//       .parents("li")
//       .attr("id");
//     let data = { idType: $id };
//     $.ajax({
//       url: $baseUrl + "/Product/filterByTypeHome",
//       data: data
//     }).done(function(e) {
//       $("#product-content").html(e);
//     });
//   });

//   // Xóa sản phẩm - Delete Product
//   $(document).on("click", ".btn-deleteProduct", function() {
//     // Xác định id của sản phẩm
//     $id = $(this)
//       .closest(".product-item")
//       .attr("id");
//     $data = { idProduct: $id };
//     // Tạo món ăn
//     $("#dialog").dialog("option", "buttons", [
//       {
//         text: "Đồng ý",
//         click: function() {
//           $.ajax({
//             url: $baseUrl + "/Product/deleteProduct",
//             data: $data
//           }).done(function(e) {
//             if (e == "1") {
//               $("#dialog").dialog("option", "buttons", [
//                 {
//                   text: "Ok",
//                   click: function() {
//                     $("#dialog").dialog("close");
//                     if ($("#typeProduct-show").val() == "") {
//                       filterByType("all");
//                       return;
//                     }
//                     filterByType($("#typeProduct-show").val());
//                   }
//                 }
//               ]);
//               openDialog("Xóa thành công !");
//             } else {
//               openDialog("Xảy ra lỗi =((");
//             }
//           });
//         }
//       },
//       {
//         text: "Hủy",
//         click: function() {
//           $("#dialog").dialog("close");
//         }
//       }
//     ]);
//     // Bưng ra
//     openDialog("Nếu xóa dữ liệu của sản phẩm sẽ mất !!!");
//   });

//   // Tìm sản phẩm Admin - Searching product Admin page
//   $("#formSearchAdmin input").keyup(function() {
//     $name = $(this).val();
//     $idType = $("#formSearchAdmin select").val();
//     if ($idType == "") $idType = "all";
//     $data = {
//       name: $name,
//       idType: $idType
//     };
//     $.ajax({
//       url: $baseUrl + "/product/searchProduct",
//       data: $data
//     }).done(function(e) {
//       $("#product-content").html(e);
//     });
//   });

//   // Chọn sản phẩm để sửa - Choose Product which wanna edit
//   $(document).on("click", ".btn-editProduct", function() {
//     $productItem = $(this).closest(".product-item");
//     $id = $productItem.attr("id");
//     $data = { id: $id };
//     $.ajax({
//       url: $baseUrl + "/product/loadToEdit",
//       data: $data,
//       dataType: "json"
//     }).done(function(e) {
//       $('#formEditProduct [name="id"').val(e["id"]);
//       $('#formEditProduct [name="name"').val(e["name"]);
//       $('#formEditProduct [name="price"').val(e["price"]);
//       $('#formEditProduct [name="amount"').val(e["amount"]);
//       $('#formEditProduct [name="description"').text(e["description"]);
//       $('#formEditProduct [name="idType"').val(e["idType"]);
//       $("#nav-editProduct-tab").click();
//     });
//   });

//   // Sửa sản phẩm
//   $("#btnProductEdit").click(function(e) {
//     e.preventDefault();
//     let data = $("#formEditProduct").serialize();
//     $.ajax({
//       data: data,
//       url: $baseUrl + "/Product/Update"
//     }).done(function(e) {
//       if (e == "1") {
//         $("#dialog p").text("Thay đổi sản phẩm thành công");
//         $("#dialog").dialog("option", "buttons", [
//           {
//             text: "Ok",
//             click: function() {
//               $("#dialog").dialog("close");
//               $val = $("#typeProduct-show").val();
//               if (!$val) $val = "all";
//               filterByType($val);
//             }
//           }
//         ]);
//         $("#dialog").dialog("open");
//       } else {
//         $("#dialog p").text(e);
//         $("#dialog").dialog("open");
//       }
//     });
//   });

//   function checkCart() {
//     $soluong = $("#iconcart").attr("data-count");
//     if ($soluong == "0") {
//       $("#iconcart").addClass("hidden");
//     } else {
//       $("#iconcart").removeClass("hidden");
//     }
//   }

//   checkCart();

//   // Xóa sản phẩm trong giỏ hàng - Delete item cart
//   $(document).on("click", ".delItemCart", function(a) {
//     a.preventDefault();
//     $id = $(this)
//       .parents(".itemCart")
//       .attr("id");
//     $data = { id: $id };
//     $name = $(this)
//       .parents(".itemCart")
//       .find(".itemCart-name")
//       .text();
//     $("#dialog").dialog("option", "buttons", [
//       {
//         text: "Xóa",
//         click: function() {
//           $.ajax({
//             url: $baseUrl + "/home/delItemCart",
//             data: $data
//           }).done(function(e) {
//             $("#iconcart").attr("data-count", e);
//             checkCart();
//             $("#cart").click();
//             $("#dialog").dialog("close");
//           });
//         }
//       },
//       {
//         text: "Hủy",
//         click: function() {
//           $("#dialog").dialog("close");
//         }
//       }
//     ]);
//     // Bưng ra
//     openDialog("Bạn có muốn xóa : " + $name);
//   });

//   // Update cart - thay đổi giỏ hàng
//   $(document).on("input", ".itemCart-amount", function() {
//     $parent = $(this).parents(".itemCart");
//     $id = $parent.attr("id");
//     $val = $(this).val();
//     $price = $parent.find(".itemCart-price").text();
//     $price = parseInt($price.replace(".", "")) * $val;
//     $money = addCommas($price);
//     $parent.find(".itemCart-money").text($money);
//     $data = {
//       id: $id,
//       money: $money,
//       amount: $val
//     };
//     $.ajax({
//       url: $baseUrl + "/home/updateCart",
//       data: $data
//     }).done(function(e) {
//       $("#iconcart").attr("data-count", e);
//       tongtien();
//     });
//   });
//   tongtien();
//   function tongtien() {
//     $money = 0;
//     $(".itemCart-money").each(function() {
//       $val = parseInt(
//         $(this)
//           .text()
//           .replace(".", "")
//       );
//       $money += $val;
//     });
//     $temp = $money;
//     $money = addCommas($money);
//     $("#totalMoney").text("Tổng tiền : " + $money);
//     return $temp;
//   }
//   var totalMoney;


  
//   // Thanh toán
//   $(document).on("click", "#btnCheckOut", function() {
//     $.ajax({
//       url: $baseUrl + "/home/checkOut"
//     }).done(function(e) {
//       switch (e) {
//         case "201":
//           openDialog("Lỗi : Bạn chưa đăng nhập!");
//           break;
//         case "202":
//           $("#dialog").dialog("option", "buttons", [
//             {
//               text: "Điền thông tin",
//               click: function() {
//                 window.location.replace($baseUrl + "/Profile");
//               }
//             },
//             {
//               text: "Hủy",
//               click: function() {
//                 $("#dialog").dialog("close");
//               }
//             }
//           ]);
//           openDialog("Bạn chưa điền đủ thông tin hồ sơ !");
//           break;
//         default:
//           totalMoney = tongtien();
//           $data = { request: "checkout" };
//           $.ajax({
//             data: $data,
//             dataType: "html",
//             url: $baseUrl + "/Home/Login"
//           }).done(function(response) {
//             $("#content").html(response);
//           });
//           break;
//       }
//     });
//   });

//   // Tính tiền
//   $(document).on("click", "#thanhtoan", function() {
    
//     console.log("a")
//     let fullName = $("#formTinhTien input[name='fullName']").val();
//     let address = $("#formTinhTien input[name='address']").val();
//     let phone = $("#formTinhTien input[name='phone']").val();
//     let info = {
//       fullName: fullName,
//       address: address,
//       phone: phone,
//       totalMoney: totalMoney
//     };
//     $.ajax({
//       url: $baseUrl + "/home/thanhtoan",
//       data: info,
//       type: "post"
//     }).done(function(e) {
//       console.log("e",e)
//       if (e == "1") {
//         checkCart();
//         $("#dialog").dialog("option", "buttons", [
//           {
//             text: "Trang chủ",
//             icon: "ui-icon-home",
//             click: function() {
//               $("#iconcart").removeClass("hidden");
//              // window.location.replace($baseUrl);
//             }
//           },
//           {
//             text: "Lịch sử mua hàng",
//             icon: "ui-icon-calendar",
//             click: function() {
//               $("#iconcart").removeClass("hidden");
//               // window.location.replace($baseUrl + "/profile");
//             }
//           }
//         ]);
        
        
//         openDialog("Thanh toán thành công !");
//       } else openDialog("Xảy ra lỗi =((");
//     });
//   });
//   $(document).on("click", "#nextPageOrders", function(e) {
//     e.preventDefault();
//     $cur = $(this).attr("page");
//     $data = { current: $cur };
//     $.ajax({
//       url: $baseUrl + "/profile/nextOrders",
//       data: $data
//     }).done(function(e) {
//       $("#listOrder").html(e);
//     });
//   });
//   $(document).on("click", "#prevPageOrders", function(e) {
//     e.preventDefault();
//     $cur = $(this).attr("page");
//     $data = { current: $cur };
//     $.ajax({
//       url: $baseUrl + "/profile/nextOrders",
//       data: $data
//     }).done(function(e) {
//       $("#listOrder").html(e);
//     });
//   });
//   $(document).on("click", ".orderDetail", function() {
//     $id = $(this).attr("id");
//     $data = {
//       id: $id
//     };
//     $.ajax({
//       url: $baseUrl + "/profile/orderDetail",
//       data: $data
//     }).done(function(e) {
//       $("#listOrder").html(e);
//     });
//   });
//   function addCommas(nStr) {
//     nStr += "";
//     var x = nStr.split(".");
//     var x1 = x[0];
//     var x2 = x.length > 1 ? "." + x[1] : "";
//     var rgx = /(\d+)(\d{3})/;
//     while (rgx.test(x1)) {
//       x1 = x1.replace(rgx, "$1" + "." + "$2");
//     }
//     return x1 + x2;
//   }
//   $("#nav-listOrders-tab").css({ background: "#5DA8CD" });
//   $("#nav-listOrders-tab").click(function(){
//     $data = { current: 0 };
//     $.ajax({
//       url: $baseUrl + "/profile/nextOrders",
//       data: $data
//     }).done(function(e) {
//       $("#listOrder").html(e);
//     });
//   })
//   $(".nav-admin").click(function() {
//     $(".nav-admin").css({ background: "white" });
//     $(this).css({ background: "#5DA8CD" });
//   });
//   $("#nav-listOrders-tab").click();
//   $(document).on("click","#backListOrder",function(){
//     $("#nav-listOrders-tab").click();
//   })
//   $(document).on("click",".itemHome", function(){
//     $id = $(this).closest(".product-item").attr('id');
//     $.ajax({
//       url : $baseUrl + '/product/productById',
//       data : {id:$id},
//       dataType:'json'
//     }).done(function(e){
//       localStorage.setItem("name",e['name']);
//       localStorage.setItem("name",e['price']);
//       localStorage.setItem("name",e['description']);
//       localStorage.setItem("name",e['amount']);
//       localStorage.setItem("name",e['img']);
//       localStorage.setItem("name",e['type']);
//     })
//     // window.location.replace($baseUrl + '/product/index')
//   })
//   // Jquery Dependency
//   $("input[data-type='currency']").on({
//     keyup: function() {
//       formatCurrency($(this));
//     },
//     blur: function() {
//       formatCurrency($(this), "blur");
//     }
//   });
//   function formatNumber(n) {
//     return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//   }
//   function formatCurrency(input, blur) {
//     var input_val = input.val();
//     if (input_val === "") {
//       return;
//     }
//     var original_len = input_val.length;
//     var caret_pos = input.prop("selectionStart");
//     if (input_val.indexOf(".") >= 0) {
//       var decimal_pos = input_val.indexOf(".");
//       var left_side = input_val.substring(0, decimal_pos);
//       var right_side = input_val.substring(decimal_pos);
//       left_side = formatNumber(left_side);
//       right_side = formatNumber(right_side);
//       if (blur === "blur") {
//         right_side += "00 Đồng";
//       }
//       right_side = right_side.substring(0, 2);
//       input_val = +left_side + "." + right_side;
//     } else {
//       input_val = formatNumber(input_val);
//       if (blur === "blur") {
//         input_val += " Đồng";
//       }
//     }
//     input.val(input_val);
//     var updated_len = input_val.length;
//     caret_pos = updated_len - original_len + caret_pos;
//     input[0].setSelectionRange(caret_pos, caret_pos);
//   }
// });
