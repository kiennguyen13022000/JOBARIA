$(function () {
  
  // Start wow js
  new WOW().init();
  if ($("#price_total_products").length > 0) {
    renderProduct();
  }
  if ($(".billing_order_form").length > 0) {
    renderPriceCheckout();
  }
  //owl-carousel
  $(".select_country").select2({ dropdownCssClass: "select_country", width: "100%" });
  $(".select_cat").select2({ dropdownCssClass: "select_box" });
  $(".product_size").select2({ dropdownCssClass: "per_page_css", width: "100%" });
  $(".per_page_select").select2({ dropdownCssClass: "per_page_css", width: "100%" });
  $(".select_sort").select2({ dropdownCssClass: "select_sort_css", width: "100%" });
  if ($(".jorbaria_slider").length > 0) {
    var $owl = $(".jorbaria_slider");
    $owl.owlCarousel({
      loop: true,
      autoplay: 1000,
      nav: false,
      dots: true,
      items: 1,
      animateOut: "fadeOut",
      animateIn: "fadeIn",
    });
    
  }
  if ($(".list_item_product").length > 0) {
    var $owl = $(".list_item_product");
    $owl.owlCarousel({
      loop: false,
      nav: false,
      dots: true,
      // autoPlay: 2500,
      smartSpeed: 1000,
      items: 1,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: 3,
        },
        1200: {
          items: 4,
        },
      },
    });
  }
  if ($(".product_style_mall").length > 0) {
    var $owl = $(".product_style_mall");
    $owl.owlCarousel({
      loop: false,
      nav: false,
      dots: true,
      // autoPlay: 2500,
      smartSpeed: 1200,
      items: 1,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: 2,
        },
        992: {
          items: 1,
        },
      },
    });
  }
  if ($(".slide_discount").length > 0) {
    var $owl = $(".slide_discount");
    $owl.owlCarousel({
      loop: false,
      nav: false,
      dots: true,
      // autoPlay: 2500,
      smartSpeed: 1500,
      items: 2,
      responsiveClass: true,
      responsive: {
        0: {
          items: 1,
        },
        768: {
          items: 2,
        },
      },
    });
  }

  // Back top top
  $(window).scroll(function () {
    if ($(this).scrollTop()) {
      $("#backTop").fadeIn();
    } else {
      $("#backTop").fadeOut();
    }
  });
  $("#backTop").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1000);
  });
  // Add slideUp animation
  $(".dropdown").on("show.bs.dropdown", function () {
    $(this).find(".dropdown-menu").first().stop(true, true).slideDown();
  });
  $(".dropdown").on("hide.bs.dropdown", function () {
    $(this).find(".dropdown-menu").first().stop(true, true).slideUp();
  });

  $(".check_ship_defferent_address").click(function () {
    $(".defferent_address_block").slideToggle();
    if ($(".check_ship_defferent_address:checked").length > 0) {
      $('.defferent_address .required').attr('required','required');
    }else{
      $('.defferent_address .required').removeAttr('required');
    }
  });

  //change number
  $(".quantity-up").click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);
  });
  $(".quantity-down").click(function () {
    if ($(this).next().val() > 1)
      $(this).next().val(+$(this).next().val() - 1);
  });
  //change number cart page
  $(".quantity_up_cart").click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);

    var product_id = $(this).data("product-id");
    number_product = $(".number_product[data-product-id=" + product_id + "]").val();
    unit_price_product = $(".unit_price_product_val[data-product-id=" + product_id + "]").val();

    pricingProduct(product_id, number_product, unit_price_product);
  });
  $(".quantity_down_cart").click(function () {
    if ($(this).next().val() > 1)
      $(this)
        .next()
        .val(+$(this).next().val() - 1);
    var product_id = $(this).data("product-id");
    number_product = $(".number_product[data-product-id=" + product_id + "]").val();
    unit_price_product = $(".unit_price_product_val[data-product-id=" + product_id + "]").val();

    pricingProduct(product_id, number_product, unit_price_product);
  });
  $(document).on("keydown", ":input:not(textarea)", function (event) {
    return event.key != "Enter";
  });
  $(document).on("keyup", ".number_product", function () {
    var $this = $(this);
    if ($this.val() > 99) {
      alert("You can only order up to 99 products");
      $this.val("99");
    }
    if ($this.val() < 1) {
      alert("Quantity must be at least 1");
      $this.val("1");
    }
    var product_id = $(this).data("product-id");
    number_product = $(".number_product[data-product-id=" + product_id + "]").val();
    unit_price_product = $(".unit_price_product_val[data-product-id=" + product_id + "]").val();

    pricingProduct(product_id, number_product, unit_price_product);
  });
  $(document).on("click", ".btn_proceed_checkout", function () {
    var $this = $(this);
    $form = $this.closest("form");
   
    // let checkout = localStorage.getItem("checkout") ? JSON.parse(localStorage.getItem("checkout")) : [];
    // let data_form = getFormData($form);
    // checkout.push(data_form);
    let data_form =  [getFormData($form)];
    localStorage.setItem("checkout", JSON.stringify(data_form));
    window.location.href = 'checkout.html';
  });
  $(document).on("click", ".btn_add_cart", function () {
    var $this = $(this);
    $form = $this.closest("form");
    let products = localStorage.getItem("products") ? JSON.parse(localStorage.getItem("products")) : [];
    let data_form = getFormData($form);
    products.push(data_form);
   
    localStorage.setItem("products", JSON.stringify(products));
    renderCart();
    $.confirm({
      title: 'Product added to cart!',
      content: 'Do you want to go to cart page?',
      maxHeight: '200',
      buttons: {
          confirm: function () {
              $.alert('Confirmed!');
              
              window.location.href = 'cart.html';
          },
          cancel: function () {
              
          }
          
      }
    });
   
  });
  $(".btn_check_coupon").click(function () {
    var $this = $(this);
    $form = $this.closest('form');
     coupon_code = $(".coupon_input").val().trim();
    if (coupon_code === "" || coupon_code === null) {
      $(".notification_promotion").html("<i class='fas fa-times text-danger'></i> Please enter coupon code");
      $(".promotion_text").text("");
      $(".promotion").val(0);
      $(".remaining_totals_box").hide();
      if($form.hasClass('checkout_form')){
        pricingTotalProducts();
        return false;
      }
      
      
    }
    if (coupon_code == "MUACUCDA") {
      if($this.hasClass('btn_check_coupon_checkout')) renderPriceCheckout();
      $(".notification_promotion").html("<i class='fas fa-check text-success'></i> Coupon codes available");
      $(".remaining_totals_box").slideDown();
      $(".promotion_text").text("-20%");
      $(".promotion").val(20);
      if($this.hasClass('btn_check_coupon_checkout')) return false;
      
    } else {
      if($this.hasClass('btn_check_coupon_checkout')) renderPriceCheckout();
      $(".promotion_text").text("");
      $(".promotion").val(0);
      $(".remaining_totals_box").hide();
      $(".notification_promotion").html("<i class='fas fa-times text-danger'></i> Coupon code is invalid");
      if($this.hasClass('btn_check_coupon_checkout')) return false;
    }
    if($form.hasClass('checkout_form'))  pricingTotalProducts();
    
  });
});
//splide
if (document.querySelector("#slide__brand") !== null) {
  new Splide("#slide__brand", {
    perPage: 6,
    arrows: false,
    padding: 0,
    speed: 1400,
    pagination: false,
    rewind: true,
    breakpoints: {
      992: {
        perPage: 5,
      },
      768: {
        perPage: 4,
      },
      576: {
        perPage: 3,
      },
      414: {
        perPage: 2,
      },
      1: {
        perPage: 2,
      },
    },
  }).mount();
}
if (document.querySelector(".splide_modal") !== null) {
  document.addEventListener("DOMContentLoaded", function () {

  });
}
if (document.querySelector(".splide_detail") !== null) {
  document.addEventListener("DOMContentLoaded", function () {
    var main = new Splide(".splide_detail", {
      type: "fade",
      sliderSize: 350,
      rewind: true,
      pagination: false,
      classes: {
        arrows: "splide__arrows your-class-arrows",
        arrow: "splide__arrow your-class-arrow",
        prev: "splide__arrow--prev your-class-prev",
        next: "splide__arrow--next your-class-next",
      },
    });

    var thumbnails = new Splide(".thumbnail_splide_detail", {
      fixedWidth: 90,

      rewind: true,
      pagination: false,
      focus: "center",
      arrows: false,
      isNavigation: true,
      gap: 20,
    });

    main.sync(thumbnails);
    main.mount();
    thumbnails.mount();
  });
}

function format2(n, currency = "") {
  if (currency === "" || currency === null || currency === undefined) {
    return n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
  }
  return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}
// function cho đơn vị tiền ra sau
// function format3(n, currency = "") {
//   if (currency === "" || currency === null || currency === undefined) {
//     return addCommas(n);
//   }
//   return new Intl.NumberFormat("ru", {
//     style: "currency",
//     currency: currency,
//   }).format(n);
// }
function renderProduct() {
  let getlocalStorage = localStorage.getItem("products") ? JSON.parse(localStorage.getItem("products")) : [];
  if(getlocalStorage.length === 0){
    $(".checkout_form_box").html("");
    return false;
  }
  $("#empty_product").hide();
  let productsContent = `<thead>
  <tr>
    <th class=" th_remove">Remove</th>
    <th class="th_image">Images</th>
    <th class="th_name">Product</th>
    <th class="th_price">Unit Price</th>
    <th class="th_quantity">Quantity</th>
    <th class="th_total">Total</th>
  </tr>
</thead>`;
  productsContent += `<tbody>`;
  
  let  number_type = 0;
  getlocalStorage.forEach((product, index) => {
    key = index;
    index ++;
    number_type ++;
    price_product_by_num = format2(product.new_price *  product.number_product);
    productsContent += `
    <tr class="product_cart" data-product-id="${index}">
    <td>
      <a href="javascript:void(0)" onclick="delProduct(${key})" data-product-id="${index}" class="_remove_product"><i
          class="fas fa-trash" aria-hidden="true"></i></a>
    </td>
    <td>
      <a href="">
        <img class="img_product" src="${product.url_image}" alt="">
        <input name="img_product_${index}" type="hidden" value="${product.url_image}">
      </a>
    </td>
    <td class="product_name_td">
        <a href="detail.html" class="product_name">${product.product_name}</a>
        <input name="product_name_${index}" type="hidden" value="${product.product_name}">
    </td>
    <td class="text-bold">
      <span class="unit_price_product_text">$${product.new_price}</span>
      <input type="hidden" data-product-id="${index}" value="${product.new_price}"
        class="unit_price_product_val">
    </td>
    <td class="">
      <p class="mb-0 font_size_15">Quantity</p>
      <div class="d-flex  justify-content-center">
        <div class="quantity border-right position-relative">
          <button type="button" data-product-id="${index}"
            class="quantity-button down  quantity_down_cart"><i
              class="fas fa-angle-down"></i></button>
          <input type="number" data-product-id="${index}" min="1" max="99" value="${product.number_product}"
            class="number_product" name="number_product_${index}">
          <button type="button" data-product-id="${index}"
            class="quantity-button up quantity_up_cart"><i
              class="fas fa-angle-up"></i></button>
        </div>
      </div>
    </td>
    <td class="text-bold">
      <span class="total_price_product_text" data-product-id="${index}">$${price_product_by_num}</span>
      <input name="price_product_by_num_${index}" type="hidden" class="total_price_product" data-product-id="${index}"
        value="${price_product_by_num}">
    </td>
  </tr>
    `; 
  });
  productsContent += `</tbody>`;
  $('input[name="number_type"]').val(number_type);
  $('#cart_table').html(productsContent);
  pricingTotalProducts();
}
function renderPriceCheckout() {
  var getlocalStorage = localStorage.getItem("checkout") ? JSON.parse(localStorage.getItem("checkout")) : [];
  if (getlocalStorage.length === 0)  window.location.href = 'index.html';

  let checkOutContent = ` <tr class="text-center text-uppercase">
  <td class="w-50">Product</td>
  <td class="w-50">Total</td>
</tr>`;
  number_type = getlocalStorage[0]['number_type'];
  promotion = getlocalStorage[0]['promotion'] ? getlocalStorage[0]['promotion'] : 0;
  coupon_input = getlocalStorage[0]["coupon_input"] ? getlocalStorage[0]["coupon_input"] : 0;
  getlocalStorage.forEach((product,index)=>{
    index ++;
   
    for (let i = 1; i <= number_type; i++) {
      // console.log(product.product_name_+i);
      checkOutContent +=`
        <tr>
            <td><span class="product_name">${product['product_name_' + i]} </span> <span
                class="text-bold number_product"> x${product['number_product_' + i]}</span></td>
            <td> <span class="unit_price_product_text">$${product['price_product_by_num_' + i]} </span></td>
      </tr>
    `;
    }
   
  });
  checkOutContent += `
    <tr class="text-bold d-none ">
      <td><span class="text-bold">Card subtotal</span></td>
      <td><span class="sub_total_products_text">$${getlocalStorage[0].sub_total_products}</span> </td>
  </tr>
  <tr>
    <td><span class="text-bold order_total ">Order
        total</span></td>
    <td><span class="price_total_products_text">$${getlocalStorage[0].sub_total_products}</span></td>
  </tr>
  <tr class="remaining_totals_box text-danger">
    <td><span class="text-bold  ">Promotion</span></td>
    <td>
    <span class="text-bold promotion_text">-${promotion}%</span>
    <input type="hidden" name="promotion" value="${promotion}" class="promotion">
    </td>
  </tr>
  <tr class="remaining_totals_box">
    <td><span class="text-bold  font_size_20">Remaining total</span></td>
    <td><span class="remaining_totals_text">$${getlocalStorage[0].remaining_totals}</span></td>
  </tr>
  `;
  $('#checkout_table').html(checkOutContent);
  if(parseInt(promotion) > 0 ){
    $('.remaining_totals_box').show();
  }
  if(coupon_input) $(".coupon_input").val(coupon_input);



}
function delProduct(id){
  if(!confirm("The data is non-refundable. Are you sure you want to delete ?")) return false;
  let products = localStorage.getItem("products") ? JSON.parse(localStorage.getItem("products")) : [];
  
  products.splice(id, 1);
  localStorage.setItem("products", JSON.stringify(products));
  renderProduct();
  if(products.length === 0)  window.location.reload();
}
function pricingProduct(product_id, number_product, unit_price_product) {
  price_product = format2(unit_price_product * number_product, "$");
  price_product_val = format2(unit_price_product * number_product, "");
  $(".total_price_product_text[data-product-id=" + product_id + "]").text(price_product);
  $(".total_price_product[data-product-id=" + product_id + "]").val(price_product_val);
  pricingTotalProducts();
}
function pricingTotalProducts() {
  var calculated_total_sum = 0;
  promotion = parseInt($('input[name="promotion"]').val());

  $(".cart_table .total_price_product").each(function () {
    var get_textbox_value = $(this).val();
    if ($.isNumeric(get_textbox_value)) {
      calculated_total_sum += parseFloat(get_textbox_value);
    }
  });
  $("#price_total_products").text(format2(calculated_total_sum, "$"));
  $("#sub_total_products_text").text(format2(calculated_total_sum, "$"));
  $('input[name="price_total_products"]').val(format2(calculated_total_sum, ""));
  $('input[name="sub_total_products"]').val(format2(calculated_total_sum, ""));
  if (promotion > 0) {
    calculated_total_sum = calculated_total_sum - (calculated_total_sum * promotion) / 100;
  }

  $("#remaining_totals_text").text(format2(calculated_total_sum, "$"));
  $('input[name="remaining_totals"]').val(format2(calculated_total_sum, ""));
}

function renderCart(){
  var products = localStorage.getItem("products") ? JSON.parse(localStorage.getItem("products")) : [];
  total_products= 0 ;
  total_price_cart = 0 ;
  
  if (products.length != 0){
    total_products =products.length;
    renderCart = `
    <ul class="nav flex-column ">
    `;
    products.forEach((product,index)=>{
        price = product.new_price;
        number_product = product.number_product;
        
        total_price_cart += price * number_product;
       
        renderCart += `
        <li class="py-3 border-bottom ">
        <div class="row ">
          <div class="col-3 pr-0 ">
            <div class="position-relative ">
              <span
                class="d-inline-block px-1 rounded-circle text-white position-absolute ">1x</span>
              <img src="${product.url_image}" alt=" ">
            </div>
  
          </div>
          <div class="col-9 text-left ">
            <a href="" class="font-weight-bold cart__title__product__name ">Xall
            ${product.product_name}</a>
            <div class="text-danger py-1">$${price}</div>
            <span class="font-weight-light">Demension: 40cm x 60cm</span>
          </div>
        </div>
      </li>
        `;
    });
    renderCart += `
    </ul>
    <table class="table table-sm w-100 table-borderless ">
      <tr>
        <td class="text-left">Subtotal</td>
        <td class="text-right">$${total_price_cart}</td>
      </tr>
      <tr>
        <td class="text-left">Shipping</td>
        <td class="text-right">$0.00</td>
      </tr>
      <tr>
        <td class="text-left">Taxes</td>
        <td class="text-right">$00.0</td>
      </tr>
      <tr>
        <td class="text-left">Total</td>
        <td class="text-right">$${total_price_cart}</td>
      </tr>
    </table>
    <a href="checkout.html" class="btn btn-secondary btn-block mb-3">Checkout</a>
    `;
    $('.product_cart_header').html(renderCart);
    $('.empty_cart_header').hide();
    $('.hidden__cart').removeClass('empty');
  }  
 
  $('.total__cart').text(total_products);
  $('.total_price_cart').text('$'+format2(total_price_cart));
}
renderCart();
function getFormData($form) {
  var unindexed_array = $form.serializeArray();
  var indexed_array = {};

  $.map(unindexed_array, function (n, i) {
    indexed_array[n["name"]] = n["value"];
  });

  return indexed_array;
}
function isJson(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }
  return true;
}

window.addEventListener('load', function() {
  // Get the forms we want to add validation styles to
  var forms = document.getElementsByClassName('needs-validation');
  // Loop over them and prevent submission
  var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
}, false);
if (document.querySelector(".zoom__plus") !== null) {
  var openPhoto = function() {
    var pswpElement = document.querySelectorAll('.pswp')[0];
  
    // build items array
    var items = [{
            src: 'assets/images/product/large-size/1.jpg',
            w: 600,
            h: 600
        },
        {
            src: 'assets/images/product/large-size/3.jpg',
            w: 600,
            h: 600
        },
        {
            src: 'assets/images/product/large-size/4.jpg',
            w: 600,
            h: 600
        },
        {
            src: 'assets/images/product/large-size/5.jpg',
            w: 600,
            h: 600
        }
  
    ];
  
    // define options (if needed)
    var options = {
        // optionName: 'option value'
        // for example:
        index: 0 // start at first slide
    };
  
    // Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
  }
  
  document.getElementsByClassName('zoom__plus')[0].onclick = openPhoto;
}


// modal
$('.btnModalProduct').click(function (){
  var id = $(this).attr('data-id');
  var url = 'index.php?module=default&controller=index&action=info';
  $('.hereModal').load(url , { id: id }, function (data){
      var main = new Splide(".splide_modal", {
        type: "fade",
        fixedHeight: 250,
        padding: '1rem',
        rewind: true,
        pagination: false,
        arrows: false,
      });

      var thumbnails = new Splide(".thumbnail_splide_modal", {
        fixedWidth: 90,
        rewind: true,
        pagination: false,
        focus: "center",
        arrows: false,
        isNavigation: true,
      });

      main.sync(thumbnails);
      main.mount();
      thumbnails.mount();
      $('#modal_product').modal();
  })
});

