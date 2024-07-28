function increaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
};

function decreaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
};


// Sử dụng JavaScript để theo dõi sự kiện khi người dùng chọn size và submit form
document.getElementById("sizeForm").addEventListener("submit", function(event) {
    // Lấy giá trị size được chọn
    var selectedSize = document.querySelector('input[name="size"]:checked');
    if (!selectedSize) {
        alert("Vui lòng chọn size giày");
        event.preventDefault(); // Ngăn form submit nếu không có size được chọn
    }
});