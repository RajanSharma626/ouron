// document.addEventListener("DOMContentLoaded", function () {
//     document
//         .querySelectorAll(".dropdown-submenu > .dropdown-toggle")
//         .forEach(function (element) {
//             element.addEventListener("click", function (e) {
//                 e.preventDefault();
//                 e.stopPropagation();
//                 let submenu = this.nextElementSibling;
//                 if (submenu.style.display === "block") {
//                     submenu.style.display = "none";
//                 } else {
//                     submenu.style.display = "block";
//                 }
//             });
//         });
// });
document.addEventListener("DOMContentLoaded", function () {
    let cart = [];

    // Function to update cart UI
    function updateCartUI() {
        const cartContainer = document.querySelector(".cart-items");
        cartContainer.innerHTML = "";

        cart.forEach((item, index) => {
            cartContainer.innerHTML += `
                <div class="cart-item d-flex justify-content-between align-items-center mb-3">
                    <div class="cart-item-info d-flex align-items-center">
                        <img src="${item.image}" alt="Product Image" class="img-fluid rounded" width="80">
                        <div class="ms-3">
                            <h6 class="mb-1 fw-bold">${item.name}</h6>
                            <small class="text-muted d-block">RS. ${item.price}</small>
                            <small class="text-muted">Qty: ${item.quantity}</small>
                        </div>
                    </div>
                    <div class="cart-item-price d-flex align-items-center">
                        <button class="btn btn-sm border px-2 decrease-qty" data-index="${index}">-</button>
                        <span class="fw-bold mx-2">${item.quantity}</span>
                        <button class="btn btn-sm border px-2 increase-qty" data-index="${index}">+</button>
                        <button class="btn btn-sm text-danger ms-3 remove-item" data-index="${index}"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            `;
        });

        // Attach event listeners to update quantities
        document.querySelectorAll(".decrease-qty").forEach((button) => {
            button.addEventListener("click", function () {
                const index = this.getAttribute("data-index");
                if (cart[index].quantity > 1) {
                    cart[index].quantity--;
                } else {
                    cart.splice(index, 1);
                }
                updateCartUI();
            });
        });

        document.querySelectorAll(".increase-qty").forEach((button) => {
            button.addEventListener("click", function () {
                const index = this.getAttribute("data-index");
                cart[index].quantity++;
                updateCartUI();
            });
        });

        document.querySelectorAll(".remove-item").forEach((button) => {
            button.addEventListener("click", function () {
                const index = this.getAttribute("data-index");
                cart.splice(index, 1);
                updateCartUI();
            });
        });
    }

    // Event Listener for Add to Cart
    document.querySelectorAll(".add-to-cart").forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-id");
            const productName = this.getAttribute("data-name");
            const productPrice = this.getAttribute("data-price");
            const productImage = this.getAttribute("data-image");

            let existingItem = cart.find((item) => item.id === productId);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1,
                });
            }

            updateCartUI();
        });
    });
});
