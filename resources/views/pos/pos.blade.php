@extends('layouts._app')

@section('content')
    <div class="container"
        style="margin-top: 30px !important; background-color: #f8f9fa; padding: 20px; border-radius: 10px;">

        <h2 class="mb-4 text-center"
            style="background-color: #007bff; color: white; padding: 10px; border-radius: 5px; margin-top: 20px;">
            Point of Sale (POS)
        </h2>

        <!-- Select Customer with Search -->
        <div class="form-group">
            <label for="customer">Select Customer:</label>
            <select id="customer" class="form-control select2">
                <option value="">-- Select Customer --</option>
                @foreach ($getCustomer as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Select Products with Search -->
        <div class="form-group">
            <label for="product">Select Products:</label>
            <select id="product" class="form-control select2">
                <option value="">-- Select Product --</option>
                @foreach ($getProduct as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->sell_price }}">
                        {{ $product->name }} - ৳{{ number_format($product->sell_price, 2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Table for Selected Products -->
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price (৳)</th>
                    <th>Quantity</th>
                    <th>Total (৳)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="productTable">
            </tbody>
        </table>

        <!-- Total Price -->
        <h4 class="text-right">Total: ৳<span id="totalPrice">0.00</span></h4>

        <!-- Submit Button -->
        <button class="btn btn-success btn-block mt-3" id="submitOrder">Submit Order</button>
    </div>

    <!-- Include jQuery & Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 with search
            $('.select2').select2({
                width: '100%',
                placeholder: "Select an option",
                allowClear: true
            });
        });

        let selectedProducts = [];

        document.getElementById("product").addEventListener("change", function() {
            let productId = this.value;
            let productName = this.options[this.selectedIndex].text;
            let productPrice = parseFloat(this.options[this.selectedIndex].getAttribute("data-price"));

            if (productId && !selectedProducts.some(p => p.id == productId)) {
                selectedProducts.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: 1
                });
                updateProductTable();
            }
        });

        function updateProductTable() {
            let tableBody = document.getElementById("productTable");
            tableBody.innerHTML = "";

            let total = 0;

            selectedProducts.forEach((product, index) => {
                let row = `<tr>
                <td>${product.name}</td>
                <td>৳${product.price.toFixed(2)}</td>
                <td><input type="number" min="1" value="${product.quantity}" class="form-control quantity-input" data-index="${index}"></td>
                <td>৳${(product.price * product.quantity).toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm remove-btn" data-index="${index}">Remove</button></td>
            </tr>`;
                tableBody.innerHTML += row;
                total += product.price * product.quantity;
            });

            document.getElementById("totalPrice").innerText = total.toFixed(2);
        }

        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("remove-btn")) {
                let index = event.target.getAttribute("data-index");
                selectedProducts.splice(index, 1);
                updateProductTable();
            }
        });

        document.addEventListener("input", function(event) {
            if (event.target.classList.contains("quantity-input")) {
                let index = event.target.getAttribute("data-index");
                selectedProducts[index].quantity = parseInt(event.target.value);
                updateProductTable();
            }
        });

        document.getElementById("submitOrder").addEventListener("click", function() {
            let customerId = document.getElementById("customer").value;
            if (!customerId) {
                alert("Please select a customer!");
                return;
            }

            if (selectedProducts.length === 0) {
                alert("Please select at least one product!");
                return;
            }

            fetch("{{ route('pos.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        customer_id: customerId,
                        products: selectedProducts
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Order placed successfully!");
                        location.reload();
                    } else {
                        alert("Error: " + data.message);
                    }
                });
        });
    </script>
@endsection
