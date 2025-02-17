
// Selecionar elementos do DOM
const cartButton = document.getElementById('cart-button');
const closeCart = document.getElementById('close-cart');
const cartModal = document.getElementById('cart-modal');
const cartContent = document.querySelector('.cart-content');
const totalPriceElement = document.querySelector('.total-price');
const addCartButtons = document.querySelectorAll('.add-cart, .boton-item');

// Mostrar/ocultar o modal do carrinho
cartButton.addEventListener('click', () => {
    cartModal.classList.add('active');
});

closeCart.addEventListener('click', () => {
    cartModal.classList.remove('active');
});

// Atualizar o preço total
function updateTotal() {
    let total = 0;
    const cartBoxes = document.querySelectorAll('.cart-box');
    cartBoxes.forEach(cartBox => {
        const priceElement = cartBox.querySelector('.cart-price');
        const quantityElement = cartBox.querySelector('.cart-quantity');
        const price = parseFloat(priceElement.textContent.replace('R$', '').replace(',', '.'));
        const quantity = parseInt(quantityElement.value);
        total += price * quantity;
    });
    totalPriceElement.textContent = `R$${total.toFixed(2).replace('.', ',')}`;
}

// Adicionar item ao carrinho
function addItemToCart(title, price, productImg) {
    const cartBox = document.createElement('div');
    cartBox.classList.add('cart-box');
    const cartItems = cartContent.getElementsByClassName('cart-product-title');

    // Verifica se o item já está no carrinho
    for (let i = 0; i < cartItems.length; i++) {
        if (cartItems[i].textContent === title) {
            alert('Este item já está no carrinho!');
            return;
        }
    }

    cartBox.innerHTML = `
        <img src="${productImg}" alt="" class="cart-img">
        <div class="detail-box">
            <div class="cart-product-title">${title}</div>
            <div class="cart-price">${price}</div>
            <input type="number" value="1" class="cart-quantity">
        </div>
        <i class='bx bxs-trash-alt cart-remove'></i>
    `;
    cartContent.appendChild(cartBox);

    // Adicionar evento de remoção do item
    cartBox.querySelector('.cart-remove').addEventListener('click', removeCartItem);

    // Atualizar total
    cartBox.querySelector('.cart-quantity').addEventListener('change', quantityChanged);
    updateTotal();
}

// Remover item do carrinho
function removeCartItem(event) {
    const buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    updateTotal();
}

// Alterar quantidade de itens
function quantityChanged(event) {
    const input = event.target;
    if (isNaN(input.value) || input.value <= 0) {
        input.value = 1;
    }
    updateTotal();
}

// Adicionar evento de clique aos botões "ADICIONAR AO CARRINHO"
addCartButtons.forEach(button => {
    button.addEventListener('click', event => {
        const product = event.target.closest('.product-card');
        const title = product.querySelector('.products-title').textContent;
        const price = product.querySelector('.price-new').textContent;
        const productImg = product.querySelector('img').src;
        addItemToCart(title, price, productImg);
    });
});

// Evento de finalizar compra
document.querySelector('.btn-buy').addEventListener('click', function() {
    // Exibir alerta informando que o pedido foi cadastrado
    alert('Pedido cadastrado com sucesso!');
    
    // Limpar o carrinho
    cartContent.innerHTML = '';  // Remove todos os itens do carrinho

    // Atualizar o total para 0 após limpar o carrinho
    updateTotal();
});





