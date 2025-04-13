$(document).ready(function () {
    // Add to Cart
    // $(".add-to-cart").click(function (e) {
    //     e.preventDefault();

    //     let $button = $(this);
    //     let $icon = $button.find("i");
    //     let originalIconClass = $icon.attr("class");

    //     // Show loading spinner inside icon
    //     $icon.attr("class", "spinner-border spinner-border-sm");

    //     let productId = $button.data("id");
    //     let price = $button.data("price");

    //     $.ajax({
    //         url: "/cart/add",
    //         type: "POST",
    //         data: {
    //             product_id: productId,
    //             price: price,
    //             _token: $('meta[name="csrf-token"]').attr("content"),
    //         },
    //         success: function (response) {
    //             // Open the offcanvas after adding to cart
    //             let offcanvasElement = document.getElementById("cart");
    //             let offcanvas = new bootstrap.Offcanvas(offcanvasElement);
    //             offcanvas.show();

    //             loadCart();
    //         },
    //         complete: function () {
    //             // Restore original icon once the AJAX call is complete
    //             $icon.attr("class", originalIconClass);
    //         },
    //     });
    // });

    let navbars = document.querySelectorAll(".navbar");

    window.addEventListener("scroll", function () {
        navbars.forEach(function (navbar) {
            if (window.scrollY > 50) {
                navbar.classList.add("fixed-top");
            } else {
                navbar.classList.remove("fixed-top");
            }
        });
    });

    $(".add-to-cart").click(function (e) {
        e.preventDefault();

        let productId = this.getAttribute("data-id");

        // Fetch product details via AJAX
        $.ajax({
            url: "/product/details/" + productId,
            type: "GET",
            success: function (product) {
                // Update modal with product details
                $("#modalProductId").val(product.id);
                $("#modalProductTitle").text(product.name);
                $("#modalProductPrice").text(product.price);
                $("#modalProductImage").attr("src", product.image);

                // Populate sizes
                let sizeHtml = "";
                product.sizes.forEach((size) => {
                    sizeHtml += `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="size-${size}" value="${size}">
                                <label class="form-check-label" for="size-${size}">${size}</label>
                            </div>`;
                });
                $("#modalProductSizes").html(sizeHtml);

                // Populate colors
                let colorHtml = "";
                product.colors.forEach((color) => {
                    colorHtml += `
                            <div class="color">
                                <input class="form-check-input d-none" type="radio" name="color" id="color-${color}" value="${color}">
                                <label class="form-check-label" for="color-${color}">
                                    <span class="color-circle" style="background-color: ${color};"></span>
                                </label>
                            </div>`;
                });
                $("#modalProductColors").html(colorHtml);

                // Show modal
                $("#addToCartModal").modal("show");
            },
        });
    });

    // Handle Add to Cart button click
    $("#confirmAddToCart").click(function () {
        let productId = $("#modalProductId").val();
        let size = $("input[name='size']:checked").val();
        let color = $("input[name='color']:checked").val();

        if (!size || !color) {
            alert("Please select a size and color.");
            return;
        }

        $.ajax({
            url: "/cart/add",
            type: "POST",
            data: {
                product_id: productId,
                size: size,
                color: color,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function () {
                $("#addToCartModal").modal("hide");
                // Show success message
                Swal.fire({
                    icon: "success",
                    title: "Added to Cart",
                    showConfirmButton: false,
                    timer: 1500,
                });
                let offcanvasElement = document.getElementById("cart");
                let offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();
                loadCart();
            },
        });
    });

    $(document).on("click", ".addToCartBtn", function (e) {
        let productId = $(this).data("id");
        let size = $("input[name='size']:checked").val();
        let color = $("input[name='color']:checked").val();

        if (!size || !color) {
            Swal.fire({
                icon: "warning",
                title: "Please select size and color",
                showConfirmButton: true,
            });
            return;
        }

        $.ajax({
            url: "/cart/add",
            type: "POST",
            data: {
                product_id: productId,
                size: size,
                color: color,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Added to Cart",
                    showConfirmButton: false,
                    timer: 1500,
                });

                let offcanvasElement = document.getElementById("cart");
                let offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();

                loadCart(); // Refresh cart contents
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Something went wrong!",
                    text: xhr.responseJSON?.message || "Please try again.",
                });
            },
        });
    });

    // Load Cart Items
    function loadCart() {
        // Show loading indicator while fetching data
        // $(".cart-items").html(
        //     '<div class="text-center my-3"><span class="spinner-border" role="status" aria-hidden="true"></span></div>'
        // );

        $.ajax({
            url: "/cart",
            type: "GET",
            success: function (cartItems) {
                let cartHtml = "";
                let total = 0;

                if (cartItems.length === 0) {
                    $(".cart-items").addClass(
                        "vh-85 d-flex justify-content-center align-items-center"
                    );

                    $(".cart-items").html(`
                        <div class="text-center ">
                        <small>
                            <p class="text-muted">Your cart is currently empty <br> start adding your favorite items!</p>
                            </small>
                            <a href="/" class="btn primary-bg continue-shopping">Continue Shopping</a>
                        </div>
                    `);

                    $(".cart-total-hide, .checkout_btn_hide").hide(); // Hide total & checkout button
                    return;
                }

                $(".cart-total-hide, .checkout_btn_hide").show(); // Show total & checkout button

                cartItems.forEach((item) => {
                    let discountedPrice =
                        (item.product.price *
                            (100 - item.product.discount_price)) /
                        100;
                    let itemTotal = discountedPrice * item.quantity;
                    total += itemTotal;

                    cartHtml += `
                        <div class="cart-item d-flex justify-content-between align-items-center p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <img src="${
                                    item.product.firstimage.img
                                }" alt="Product Image" class="img-fluid rounded" width="80">
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold">${
                                        item.product.name
                                    }</h6>
                                    <small class="text-muted d-block">RS. ${discountedPrice.toFixed(
                                        2
                                    )}</small>
                                    <small class="d-block">SIZE: ${
                                        item.size || "N/A"
                                    }</small>
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center border px-2 rounded-pill">
                                            <button class="btn btn-sm border-0 px-2 update-cart" data-id="${
                                                item.id
                                            }" data-quantity="${
                        item.quantity - 1
                    }">-</button>
                                            <span class="fw-bold mx-2">${
                                                item.quantity
                                            }</span>
                                            <button class="btn btn-sm border-0 px-2 update-cart" data-id="${
                                                item.id
                                            }" data-quantity="${
                        item.quantity + 1
                    }">+</button>
                                        </div>
                                        <button class="btn btn-sm text-danger ms-3 delete-cart" data-id="${
                                            item.id
                                        }">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-end me-3">RS. ${itemTotal.toFixed(
                                    2
                                )}</span>
                            </div>
                        </div>`;
                });

                $(".cart-items").addClass("max-height60");
                $(".cart-items").removeClass(
                    "vh-85 d-flex justify-content-center align-items-center"
                );

                $(".cart-items").html(cartHtml);
                $(".cart-total span:last-child").text(
                    "RS. " + total.toFixed(2)
                );
            },
            error: function () {
                $(".cart-items").html(
                    '<div class="alert alert-danger">Failed to load cart. Please try again.</div>'
                );
            },
        });
    }

    // Update Cart Quantity
    $(document).on("click", ".update-cart", function () {
        let cartId = $(this).data("id");
        let quantity = $(this).data("quantity");

        $.ajax({
            url: "/cart/update",
            type: "POST",
            data: {
                cart_id: cartId,
                quantity: quantity,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function () {
                loadCart();
            },
        });
    });

    // Delete Cart Item
    $(document).on("click", ".delete-cart", function () {
        let cartId = $(this).data("id");

        $.ajax({
            url: "/cart/delete/" + cartId,
            type: "DELETE",
            data: { _token: $('meta[name="csrf-token"]').attr("content") },
            success: function () {
                loadCart();
            },
        });
    });

    loadCart(); // Load cart on page load
});

document.addEventListener("DOMContentLoaded", function () {
    // Function to display a Bootstrap alert on the top right
    function showAlert(message, type) {
        let alertContainer = document.getElementById("alert-container");
        if (!alertContainer) {
            alertContainer = document.createElement("div");
            alertContainer.id = "alert-container";
            alertContainer.style.position = "fixed";
            alertContainer.style.top = "20px";
            alertContainer.style.right = "20px";
            alertContainer.style.zIndex = "1050";
            document.body.appendChild(alertContainer);
        }
        let alertDiv = document.createElement("div");
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.role = "alert";
        alertDiv.innerHTML =
            message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';

        alertContainer.appendChild(alertDiv);

        // Auto dismiss after 3 seconds
        setTimeout(function () {
            alertDiv.classList.remove("show");
            alertDiv.classList.add("hide");
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    }

    document.querySelectorAll(".wishlist-btn").forEach((button) => {
        button.addEventListener("click", function () {
            let productId = this.getAttribute("data-id");
            let icon = this.querySelector("i");
            // Save original classes
            let originalClasses = icon.className;

            // Show loading state inside icon
            icon.className = "spinner-border spinner-border-sm";

            fetch("/wishlist/toggle", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ product_id: productId }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "added") {
                        icon.className = "bi bi-heart-fill text-danger";
                        showAlert("Added to wishlist", "success");
                    } else if (data.status === "removed") {
                        icon.className = "bi bi-heart";
                        showAlert("Removed from wishlist", "info");
                    } else {
                        // In case of an unexpected response, restore the original icon
                        icon.className = originalClasses;
                        showAlert("Unexpected response", "warning");
                    }
                })
                .catch(() => {
                    // On error, restore the original icon
                    icon.className = originalClasses;
                    showAlert("An error occurred, please try again", "danger");
                });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".wishlist-btn2").forEach((button) => {
        button.addEventListener("click", function () {
            let productId = this.getAttribute("data-id");
            let icon = this.querySelector("i");
            // Save original classes
            let originalClasses = icon.className;

            // Show loading state inside icon
            icon.className = "spinner-border spinner-border";

            fetch("/wishlist/toggle", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ product_id: productId }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "added") {
                        icon.className = "bi bi-heart-fill text-danger fs-3";
                    } else if (data.status === "removed") {
                        icon.className = "bi bi-heart fs-3";
                    } else {
                        // In case of an unexpected response, restore the original icon
                        icon.className = originalClasses;
                    }
                })
                .catch(() => {
                    // On error, restore the original icon
                    icon.className = originalClasses;
                });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const sizeLabels = document.querySelectorAll(".size-label");

    sizeLabels.forEach((label) => {
        label.addEventListener("click", function (event) {
            event.preventDefault();

            // Remove active class from all size images
            document
                .querySelectorAll(".size_img")
                .forEach((image) => image.classList.remove("active_size"));

            // Add active class to the clicked size image
            const sizeImage = this.querySelector(".size_img");
            if (sizeImage) {
                sizeImage.classList.add("active_size");
            }

            // Check the corresponding radio button
            const radioInput = this.previousElementSibling;
            if (radioInput && radioInput.type === "radio") {
                radioInput.checked = true;
            }
        });
    });

    const colorLabels = document.querySelectorAll(".color-label");

    colorLabels.forEach((label) => {
        label.addEventListener("click", function (event) {
            event.preventDefault();

            // Remove active class from all color circles
            document
                .querySelectorAll(".color-circle")
                .forEach((circle) => circle.classList.remove("active_color"));

            // Add active class to the clicked color circle
            const colorCircle = this.querySelector(".color-circle");
            if (colorCircle) {
                colorCircle.classList.add("active_color");
            }

            // Check the corresponding radio button
            const radioInput = this.previousElementSibling;
            if (radioInput && radioInput.type === "radio") {
                radioInput.checked = true;
            }
        });
    });

    let typingTimer;
    const delay = 300;

    $("#liveSearchInput").on("keyup", function (e) {
        clearTimeout(typingTimer);
        const query = $(this).val().trim();

        if (e.key === "Enter") {
            $("#searchForm").submit(); // Submit form normally
            return;
        }

        if (query.length >= 2) {
            typingTimer = setTimeout(function () {
                $.ajax({
                    url: "/live-search-suggestions",
                    method: "GET",
                    data: { query: query },
                    success: function (data) {
                        let suggestions = "";
                        if (data.length) {
                            data.forEach((item) => {
                                suggestions += `<a href="/product/${item.slug}" class="list-group-item list-group-item-action">${item.name}</a>`;
                            });
                        } else {
                            suggestions = `<div class="list-group-item">No results found</div>`;
                        }
                        $("#suggestionBox").html(suggestions).show();
                    },
                });
            }, delay);
        } else {
            $("#suggestionBox").hide();
        }
    });

    // Optional: Hide suggestion list on blur
    $("#liveSearchInput").on("blur", function () {
        setTimeout(() => $("#suggestionBox").hide(), 200);
    });

    document.getElementById("editBtn").addEventListener("click", function () {
        // Remove disabled attribute from text, email, and phone inputs
        this.closest("form")
            .querySelectorAll("input")
            .forEach(function (input) {
                input.removeAttribute("disabled");
            });
        // Hide edit button and show save button
        document.getElementById("editBtn").classList.add("d-none");
        document.getElementById("saveBtn").classList.remove("d-none");
    });
});

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // Handle newsletter subscription
    $("#newsletterForm").on("submit", function (e) {
        e.preventDefault();

        let email = $(this).find('input[name="email"]').val();

        $.ajax({
            url: "/subscribe", // Replace with your endpoint
            method: "POST",
            data: {
                email: email,
            },
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Subscribed!",
                        text: response.message,
                    });
                    $("#newsletterForm")[0].reset();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text:
                            response.message ||
                            "Something went wrong! Please try again.",
                    });
                }
            },
            error: function (xhr) {
                const errorMsg = xhr.responseJSON
                    ? xhr.responseJSON.message
                    : "Something went wrong! Please try again.";
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: errorMsg,
                });
            },
        });
    });
});

$(document).ready(function () {
    // CSRF Token Setup
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#contactForm").on("submit", function (e) {
        e.preventDefault();

        let $btn = $("#submitBtn");
        $btn.prop("disabled", true);
        $btn.find(".btn-text").text("Submitting...");

        $.ajax({
            url: "/contact",
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Message Sent!",
                    text: "Thank you for contacting us. We’ll get back to you shortly.",
                });
                $("#contactForm")[0].reset();
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Something went wrong. Please try again.",
                });
            },
            complete: function () {
                $btn.prop("disabled", false);
                $btn.find(".btn-text").text("Submit");
            },
        });
    });
});
