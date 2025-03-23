$(document).ready(function () {
    // Add to Cart
    $(".add-to-cart").click(function (e) {
        e.preventDefault();

        let $button = $(this);
        let $icon = $button.find("i");
        let originalIconClass = $icon.attr("class");

        // Show loading spinner inside icon
        $icon.attr("class", "spinner-border spinner-border-sm");

        let productId = $button.data("id");
        let price = $button.data("price");

        $.ajax({
            url: "/cart/add",
            type: "POST",
            data: {
                product_id: productId,
                price: price,
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // Open the offcanvas after adding to cart
                let offcanvasElement = document.getElementById("cart");
                let offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();

                loadCart();
            },
            complete: function () {
                // Restore original icon once the AJAX call is complete
                $icon.attr("class", originalIconClass);
            },
        });
    });

    // Load Cart Items
    function loadCart() {
        // Show loading indicator while fetching data
        $(".cart-items").html(
            '<div class="text-center my-3"><span class="spinner-border" role="status" aria-hidden="true"></span></div>'
        );
        $.ajax({
            url: "/cart",
            type: "GET",
            success: function (cartItems) {
                let cartHtml = "";
                let total = 0;

                cartItems.forEach((item) => {
                    total += item.price * item.quantity;
                    cartHtml += `
                        <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                            <div class="cart-item-info d-flex align-items-center">
                                <img src="${
                                    item.product.firstimage.img
                                }" alt="Product Image" class="img-fluid rounded" width="80">
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold">${
                                        item.product.name
                                    }</h6>
                                    <small class="text-muted d-block">RS. ${
                                        item.price
                                    }</small>
                                </div>
                            </div>
                            <div class="cart-item-price d-flex align-items-center">
                                <button class="btn btn-sm border px-2 update-cart" data-id="${
                                    item.id
                                }" data-quantity="${
                        item.quantity - 1
                    }">-</button>
                                <span class="fw-bold mx-2">${
                                    item.quantity
                                }</span>
                                <button class="btn btn-sm border px-2 update-cart" data-id="${
                                    item.id
                                }" data-quantity="${
                        item.quantity + 1
                    }">+</button>
                                <button class="btn btn-sm text-danger ms-3 delete-cart" data-id="${
                                    item.id
                                }"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>`;
                });

                $(".cart-items").html(cartHtml);
                $(".cart-total span:last-child").text("RS. " + total);
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
                    } else if (data.status === "removed") {
                        icon.className = "bi bi-heart";
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
