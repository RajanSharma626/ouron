document.addEventListener("DOMContentLoaded", function () {
    const ticker = document.querySelector(".ticker");
    const items = document.querySelectorAll(".ticker-item");

    if (!ticker || items.length === 0) return; // ✅ Safeguard

    const itemHeight = 40;
    const totalItems = items.length;

    const style = document.createElement("style");
    const duration = totalItems * 2.5;
    const percentPerItem = 100 / totalItems;

    let keyframes = "@keyframes tick {\n";
    for (let i = 0; i < totalItems; i++) {
        const top = i * -itemHeight;
        const startPercent = i * percentPerItem;
        const midPercent = startPercent + percentPerItem * 0.9;
        const endPercent = (i + 1) * percentPerItem;

        keyframes += `  ${startPercent}% { top: ${top}px; }\n`;
        keyframes += `  ${midPercent}% { top: ${top}px; }\n`;
        keyframes += `  ${endPercent}% { top: ${(i + 1) * -itemHeight}px; }\n`;
    }
    keyframes += "}";

    style.innerHTML = keyframes;
    document.head.appendChild(style);

    ticker.style.animation = `tick ${duration}s infinite cubic-bezier(0.23, 1, 0.32, 1)`;
});

function CancelOrder(title, text, redirectUrl = null, callback = null) {
    Swal.fire({
        title: title || 'Are you sure?',
        text: text || 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, proceed',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            if (redirectUrl) {
                window.location.href = redirectUrl;
            } else if (typeof callback === 'function') {
                callback();
            }
        }
    });
}


$(document).ready(function () {

    function checkPincode(pin) {
        // console.log("Checking PIN code:", pin);
        if (pin.length === 6) {
            $.ajax({
                url: `/check-pincode/${pin}`,
                type: "GET",
                success: function (res) {
                    if (res.status) {
                        $("#pincode-message")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text("")
                            .show();

                        $("#pincode").removeClass("is-invalid");
                        $("#pincode").addClass("is-valid");

                        $("#checkpout").attr("disabled", false);
                    } else {
                        $("#pincode-message")
                            .removeClass("text-success")
                            .addClass("text-danger")
                            .text("Delivery is not available at this PIN code")
                            .show();

                        $("#pincode").removeClass("is-valid");
                        $("#pincode").addClass("is-invalid");
                        $("#checkpout").attr("disabled", true);
                    }
                },
                error: function () {
                    $("#pincode-message")
                        .removeClass("text-success")
                        .addClass("text-danger")
                        .text("Error checking PIN code")
                        .show();
                },
            });
        } else {
            $("#pincode-message").hide();
        }
    }

    // Check if old value exists
    const oldPin = $("#pincode").val();
    if (oldPin) {
        checkPincode(oldPin);
    }

    // Check on input
    $("#pincode").on("input", function () {
        // console.log("Input event triggered");
        const pin = $(this).val();
        checkPincode(pin);
    });

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

        let productId = $(this).data("id");

        $.ajax({
            url: "/product/details/" + productId,
            type: "GET",
            success: function (product) {
                // Check if all variant stock is 0
                let stockValues = Object.values(product.variantStock);
                let hasStock = stockValues.some((stock) => parseInt(stock) > 0);

                if (!hasStock) {
                    Swal.fire({
                        icon: "warning",
                        title: "Out of Stock",
                        text: "This product is currently out of stock.",
                    });
                    return;
                }

                // Update modal content
                $("#modalProductId").val(product.id);
                $("#modalProductTitle").text(product.name);
                $("#modalProductPrice").text(product.price);
                $("#modalProductImage").attr("src", product.image);

                // Show only available sizes
                let sizeHtml = "";
                $.each(product.variantStock, function (size, stock) {
                    if (parseInt(stock) > 0) {
                        sizeHtml += `
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="size" id="size-${size}" value="${size}">
                                <label class="form-check-label" for="size-${size}">${size}</label>
                            </div>`;
                    }
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
                    title: "",
                    showConfirmButton: false,
                    timer: 1500,
                    background: "transparent",
                    customClass: {
                        icon: "swal-icon-large", // Add a custom class for larger icon
                    },
                });
                let offcanvasElement = document.getElementById("cart");
                let offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();
                loadCart();
            },
        });
    });

    $(document).on("click", ".addToCartBtn", function (e) {
        e.preventDefault();

        let productId = $(this).data("id");
        let size = $("input[name='size']:checked").val();
        let color = $("input[name='color']:checked").val();

        // Step 1: Basic selection check
        if (!size || !color) {
            Swal.fire({
                icon: "warning",
                title: "Please select size and color",
                showConfirmButton: true,
            });
            return;
        }

        // Step 2: Fetch product details to validate stock
        $.ajax({
            url: "/product/details/" + productId,
            type: "GET",
            success: function (product) {
                let sizeStock = product.variantStock[size]; // Check selected size stock
                let isColorAvailable = product.colors.includes(color); // Check color exists

                if (!isColorAvailable) {
                    Swal.fire({
                        icon: "warning",
                        title: "Color Not Available",
                        text: "The selected color is not available for this product.",
                    });
                    return;
                }

                if (!sizeStock || parseInt(sizeStock) <= 0) {
                    Swal.fire({
                        icon: "warning",
                        title: "Out of Stock",
                        text: `The selected size (${size}) is currently out of stock.`,
                    });
                    return;
                }

                // Step 3: Proceed to add to cart
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
                            title: "",
                            showConfirmButton: false,
                            timer: 1500,
                            background: "transparent",
                            customClass: {
                                icon: "swal-icon-large",
                            },
                        });

                        let offcanvasElement = document.getElementById("cart");
                        let offcanvas = new bootstrap.Offcanvas(
                            offcanvasElement
                        );
                        offcanvas.show();

                        loadCart(); // Refresh cart
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong!",
                            text:
                                xhr.responseJSON?.message ||
                                "Please try again.",
                        });
                    },
                });
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Failed to fetch product info",
                    text: "Please try again later.",
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
                    let discountedPrice = item.product.discount_price;
                    let itemStock = item.available_stock || 0;
                    let isOutOfStock = itemStock < item.quantity;
                    let itemTotal = isOutOfStock
                        ? 0
                        : discountedPrice * item.quantity;

                    if (!isOutOfStock) {
                        total += itemTotal;
                    }

                    cartHtml += `
                        <div class="cart-item d-flex justify-content-between align-items-center py-2 p-md-3 border-bottom ${
                            isOutOfStock ? "opacity-50" : ""
                        }">
                            <div class="d-flex align-items-center">
                                <img src="${
                                    item.product.firstimage.img
                                }" alt="Product Image" class="img-fluid rounded" width="80">
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold cart_product_title">${
                                        item.product.name
                                    }</h6>
                                    <small class="text-muted d-block cart_product_price">RS. ${discountedPrice.toFixed(
                                        2
                                    )}</small>
                                    <small class="d-block cart_product_price">SIZE: ${
                                        item.size || "N/A"
                                    }</small>
                                    ${
                                        isOutOfStock
                                            ? '<small class="text-danger">Out of Stock</small>'
                                            : ""
                                    }
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center border px-2 rounded-pill">
                                            <button class="btn btn-sm border-0 px-2 update-cart" data-id="${
                                                item.id
                                            }" data-quantity="${
                        item.quantity - 1
                    }" ${isOutOfStock ? "disabled" : ""}>-</button>
                                            <span class="fw-bold mx-2">${
                                                item.quantity
                                            }</span>
                                            <button class="btn btn-sm border-0 px-2 update-cart" data-id="${
                                                item.id
                                            }" data-quantity="${
                        item.quantity + 1
                    }" ${isOutOfStock ? "disabled" : ""}>+</button>
                                        </div>
                                        <button class="btn btn-sm text-danger ms-md-3 delete-cart" data-id="${
                                            item.id
                                        }">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-end me-3 cart_product_title text-nowrap">
                                    RS. ${itemTotal.toFixed(2)}
                                </span>
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

    const editBtn = document.getElementById("editBtn");

    if (editBtn) {
        editBtn.addEventListener("click", function () {
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
    }
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

        // Validate email domain
        if (!email.endsWith("@gmail.com")) {
            Swal.fire({
                icon: "error",
                title: "Invalid Email",
                text: "Only @gmail.com email addresses are allowed.",
            });
            return;
        }

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

        let email = $(this).find('input[name="email"]').val();
        let phone = $(this).find('input[name="phone"]').val();

        // Validate email domain
        if (!email.endsWith("@gmail.com")) {
            Swal.fire({
                icon: "error",
                title: "Invalid Email",
                text: "Only @gmail.com email addresses are allowed.",
            });
            $btn.prop("disabled", false);
            $btn.find(".btn-text").text("Submit");
            return;
        }

        // Validate phone number format
        let formattedPhone = phone.startsWith("+91") ? phone.slice(3) : phone;
        const phoneRegex = /^\d{10}$/;

        if (formattedPhone.startsWith("91") && formattedPhone.length === 12) {
            formattedPhone = formattedPhone.slice(2);
        }

        console.log("Formatted Phone:", formattedPhone);

        if (!phoneRegex.test(formattedPhone)) {
            Swal.fire({
                icon: "error",
                title: "Invalid Phone Number",
                text: "Phone number must contain exactly 10 digits.",
            });
            $btn.prop("disabled", false);
            $btn.find(".btn-text").text("Submit");
            return;
        }

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

const logoutBtn = document.getElementById("logoutBtn");
if (logoutBtn) {
    logoutBtn.addEventListener("click", function () {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, logout!",
        }).then((result) => {
            if (result.isConfirmed) {
                this.closest("form").submit();
            }
        });
    });
}

const logoutBtn2 = document.getElementById("logoutBtn2");

if (logoutBtn) {
    logoutBtn2.addEventListener("click", function () {
        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, logout!",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("logoutForm").submit();
            }
        });
    });
}
