$(function () {
    const products = [
        {
            id: 1,
            name: "Laptop",
            category: "computadoras",
            categoryName: "Computadoras",
            price: 18999,
            tag: "Más vendido",
            filter: "nuevo",
            description: "Alto rendimiento para trabajo, programación y entretenimiento.",
            image: "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=800&q=80"
        },
        {
            id: 2,
            name: "Headphones",
            category: "audio",
            categoryName: "Audio",
            price: 2499,
            tag: "Oferta",
            filter: "oferta",
            description: "Audio envolvente con cancelación activa de ruido.",
            image: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=800&q=80"
        },
        {
            id: 3,
            name: "iPhone 15",
            category: "smartphones",
            categoryName: "Smartphones",
            price: 12999,
            tag: "Nuevo",
            filter: "nuevo",
            description: "Pantalla de alta resolución y cámara profesional.",
            image: "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=80"
        },
        {
            id: 4,
            name: "Smartwatch",
            category: "wearables",
            categoryName: "Wearables",
            price: 3999,
            tag: "Oferta",
            filter: "oferta",
            description: "Monitorea tu actividad física y recibe notificaciones desde tu muñeca.",
            image: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=800&q=80"
        },
        {
            id: 5,
            name: "Tablet",
            category: "tablets",
            categoryName: "Tablets",
            price: 7499,
            tag: "Más vendido",
            filter: "eco",
            description: "Ideal para leer, dibujar y ver contenido en una pantalla grande.",
            image: "https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?auto=format&fit=crop&w=800&q=80"
        },
        {
            id: 6,
            name: "Mouse gamer",
            category: "accesorios",
            categoryName: "Accesorios",
            price: 999,
            tag: "Eco",
            filter: "eco",
            description: "Sensor de alta precisión y botones programables para juegos.",
            image: "https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?auto=format&fit=crop&w=800&q=80"
        }
    ];
    let activeFilter = "todos";
    let activeCategory = "todos";
    let searchText = "";
    let selectedProduct = null;
    let cart = [];
    function money(value) {
        return "$" + value.toLocaleString("es-MX");
    }

    function getTagClass(filter) {
        if (filter === "oferta") return "bg-warning text-dark";
        if (filter === "eco") return "bg-success";
        return "bg-primary";
    }

    function renderProducts() {

        const filtered = products.filter(product => {

            const matchesSearch =
                product.name.toLowerCase().includes(searchText) ||
                product.description.toLowerCase().includes(searchText) ||
                product.categoryName.toLowerCase().includes(searchText);

            const matchesFilter =
                activeFilter === "todos" || product.filter === activeFilter;

            const matchesCategory =
                activeCategory === "todos" || product.category === activeCategory;

            return matchesSearch && matchesFilter && matchesCategory;
        });

        $("#productsGrid").empty();

        $("#resultsCount").text(
            filtered.length === 1
                ? "1 producto encontrado"
                : filtered.length + " productos encontrados"
        );

        if (filtered.length === 0) {
            $("#emptyProducts").show();
            return;
        }

        $("#emptyProducts").hide();

        $.each(filtered, function (_, product) {

            const card = `
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card product-card h-100 border rounded-4 overflow-hidden shadow-sm">

                        <div class="product-image-wrap bg-light" style="height:250px;overflow:hidden;">

                            <span class="badge ${getTagClass(product.filter)} product-badge">
                                ${product.tag}
                            </span>

                            <img src="${product.image}"
                                 alt="${product.name}"
                                 class="w-100 h-100 object-fit-cover product-image">

                        </div>

                        <div class="card-body p-4 d-flex flex-column">

                            <span class="text-primary fw-bold text-uppercase small">
                                ${product.categoryName}
                            </span>

                            <h3 class="card-title h5 my-2">
                                ${product.name}
                            </h3>

                            <p class="card-text text-secondary small mb-4">
                                ${product.description}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-auto">

                                <span class="fs-4 fw-bold text-dark">
                                    ${money(product.price)}
                                </span>

                                <button
                                    class="btn btn-primary d-flex align-items-center justify-content-center gap-2 rounded-3 view-product"
                                    data-id="${product.id}">
                                    <i data-lucide="eye" style="width:18px;"></i>
                                    Ver más
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            `;

            $("#productsGrid").append(card);
        });

        lucide.createIcons();
    }

    $("#searchInput").on("input", function () {

        searchText = $(this).val().trim().toLowerCase();

        $("#clearSearch").toggleClass("d-none", searchText === "");

        renderProducts();
    });

    $("#clearSearch").on("click", function () {
        $("#searchInput").val("").trigger("input");
        $("#searchInput").focus();
    });

    $(".filter-btn").on("click", function () {

        $(".filter-btn")
            .removeClass("active btn-primary")
            .addClass("btn-outline-primary");

        $(this)
            .removeClass("btn-outline-primary")
            .addClass("active btn-primary");

        activeFilter = $(this).data("filter");

        renderProducts();
    });

    $("#categoryFilter").on("change", function () {
        activeCategory = $(this).val();
        renderProducts();
    });

    $("#clearFilters").on("click", function () {

        activeFilter = "todos";
        activeCategory = "todos";
        searchText = "";

        $("#searchInput").val("");
        $("#categoryFilter").val("todos");

        $(".filter-btn")
            .removeClass("active btn-primary")
            .addClass("btn-outline-primary");

        $('.filter-btn[data-filter="todos"]')
            .removeClass("btn-outline-primary")
            .addClass("active btn-primary");

        $("#clearSearch").addClass("d-none");

        renderProducts();
    });
    $(document).on("click", ".view-product", function () {

        const id = Number($(this).data("id"));
        selectedProduct = products.find(product => product.id === id);

        if (!selectedProduct) return;

        $("#modalProductName").text(selectedProduct.name);
        $("#modalProductTitle").text(selectedProduct.name);
        $("#modalProductCategory").text(selectedProduct.categoryName);
        $("#modalProductDescription").text(selectedProduct.description);
        $("#modalProductPrice").text(money(selectedProduct.price));
        $("#modalProductTag").text(selectedProduct.tag);

        $("#modalProductImage")
            .attr("src", selectedProduct.image)
            .attr("alt", selectedProduct.name);

        $("#modalQuantity").val(1);

        bootstrap.Modal
            .getOrCreateInstance(document.getElementById("productModal"))
            .show();

        lucide.createIcons();
    });

    $("#modalPlus").on("click", function () {
        let quantity = Number($("#modalQuantity").val()) || 1;
        if (quantity < 99) $("#modalQuantity").val(quantity + 1);
    });

    $("#modalMinus").on("click", function () {
        let quantity = Number($("#modalQuantity").val()) || 1;
        if (quantity > 1) $("#modalQuantity").val(quantity - 1);
    });

    $("#modalQuantity").on("change", function () {
        let quantity = Number($(this).val()) || 1;
        quantity = Math.max(1, Math.min(99, quantity));
        $(this).val(quantity);
    });

    function addToCart(product, quantity) {

        const existing = cart.find(item => item.id === product.id);

        if (existing) {
            existing.quantity += quantity;
        } else {
            cart.push({
                ...product,
                quantity: quantity
            });
        }

        renderCart();
        showToast();
    }

    $("#modalAddCart").on("click", function () {

        if (!selectedProduct) return;

        const quantity = Number($("#modalQuantity").val()) || 1;

        addToCart(selectedProduct, quantity);

        bootstrap.Modal
            .getOrCreateInstance(document.getElementById("productModal"))
            .hide();
    });

    function renderCart() {

        $("#cartItems").empty();

        const totalItems = cart.reduce(
            (total, item) => total + item.quantity,
            0
        );

        $("#cartCount").text(totalItems);

        if (cart.length === 0) {

            $("#emptyCart").show();
            $("#cartSummary").addClass("d-none");
            return;
        }

        $("#emptyCart").hide();
        $("#cartSummary").removeClass("d-none");

        let total = 0;

        $.each(cart, function (_, item) {

            const subtotal = item.price * item.quantity;
            total += subtotal;

            const cartItem = `
                <div class="d-flex gap-3 border-bottom py-3">

                    <img src="${item.image}"
                         alt="${item.name}"
                         class="cart-item-image">

                    <div class="flex-grow-1">

                        <div class="d-flex justify-content-between">
                            <strong>${item.name}</strong>

                            <button class="btn btn-sm text-danger remove-cart"
                                    data-id="${item.id}"
                                    title="Eliminar">
                                <i data-lucide="trash-2" style="width:17px;"></i>
                            </button>
                        </div>

                        <span class="small text-secondary">
                            ${money(item.price)} c/u
                        </span>

                        <div class="d-flex align-items-center justify-content-between mt-2">

                            <div class="input-group input-group-sm" style="width:105px;">
                                <button class="btn btn-outline-secondary cart-minus"
                                        data-id="${item.id}">−</button>

                                <span class="form-control text-center">
                                    ${item.quantity}
                                </span>

                                <button class="btn btn-outline-secondary cart-plus"
                                        data-id="${item.id}">+</button>
                            </div>

                            <strong>${money(subtotal)}</strong>

                        </div>
                    </div>
                </div>
            `;

            $("#cartItems").append(cartItem);
        });

        $("#cartTotal").text(money(total));

        lucide.createIcons();
    }

    $(document).on("click", ".cart-plus", function () {

        const id = Number($(this).data("id"));
        const item = cart.find(product => product.id === id);

        if (item && item.quantity < 99) {
            item.quantity++;
            renderCart();
        }
    });

    $(document).on("click", ".cart-minus", function () {

        const id = Number($(this).data("id"));
        const item = cart.find(product => product.id === id);

        if (!item) return;

        if (item.quantity > 1) {
            item.quantity--;
        } else {
            cart = cart.filter(product => product.id !== id);
        }

        renderCart();
    });

    $(document).on("click", ".remove-cart", function () {

        const id = Number($(this).data("id"));

        cart = cart.filter(product => product.id !== id);

        renderCart();
    });

    $("#checkoutBtn").on("click", function () {

        if (cart.length === 0) return;

        const total = cart.reduce(
            (sum, item) => sum + item.price * item.quantity,
            0
        );

        alert(
            "Total: " + money(total) 
        );
    });

    function showToast() {

        const toast = bootstrap.Toast.getOrCreateInstance(
            document.getElementById("cartToast"),
            { delay: 1800 }
        );

        toast.show();
    }


    renderProducts();
    renderCart();
    lucide.createIcons();

});