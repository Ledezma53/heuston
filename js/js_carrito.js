let cart = [];
// =====================================
// AGREGAR PRODUCTO AL CARRITO
// =====================================
document.addEventListener('click', (e) => {

    if (e.target.classList.contains('btn-carrito')) {
        const button = e.target;
        const product = {
            id: button.dataset.id,
            nombre: button.dataset.nombre,
            precio: parseFloat(button.dataset.precio)
        };
        addToCart(product);
    }
});
// =====================================
// AGREGAR AL ARRAY
// =====================================
function addToCart(product) {
    cart.push(product);
    updateCart();
}
// =====================================
// MOSTRAR CARRITO
// =====================================
function updateCart() {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    cartItems.innerHTML = '';
    if (cart.length === 0) {
        cartItems.innerHTML = '<p>Tu carrito está vacío</p>';
        cartTotal.textContent = '0';
        return;
    }
    let total = 0;
    cart.forEach((item, index) => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('mb-2');
        productDiv.textContent =
            `${item.nombre} - $${item.precio.toFixed(2)}`;
        cartItems.appendChild(productDiv);
        total += item.precio;
    });
    cartTotal.textContent = total.toFixed(2);
}
// =====================================
// PROCESAR COMPRA
// =====================================
document.addEventListener('click', function(e) {
    if (e.target.id === 'checkout') {
        if (cart.length === 0) {
            alert('El carrito está vacío');
            return;
        }
        fetch('../controlador/service/procesar_compra.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(cart)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            cart = [];
            updateCart();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al procesar la compra');
        });
    }
});