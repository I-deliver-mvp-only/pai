'use strict';

const products = {
    initProductsAddToCartClick() {
        Array.from(document.querySelectorAll('.add-to-cart-btn')).forEach((btn) => {
            btn.onclick = (e) => {
                this.addProductToCart(e.target.parentNode.parentNode);
            };
        });
    },

    initGoToCartClick() {
        document.querySelector('.go-to-cart-btn').onclick = () => {
            window.location = '/cart';
        }
    },

    addProductToCart(product) {
        const productId = product.querySelector('.item-id').innerHTML;
        fetch(`/api/cart/product/${productId}`, {
            method: 'POST',
        }).then((response) => {
            if (response.status !== 201) {
                if (response.status === 404) {
                    this.processProductNotFoundResponse(product);
                }
                return;
            }
            const productsCountNode = document.querySelector('.cart-products-count');
            productsCountNode.innerHTML = Number(productsCountNode.innerHTML) + 1;
            product.setAttribute('disabled', '');
            product.querySelector('.disabled-item-cover').style.animationName = 'disable-item';
            product.querySelector('.disabled-item-cover').style.animationDuration = '2s';
        });
    },

    processProductNotFoundResponse(product) {
        Swal.fire({
            title: 'Couldn\'t add product to cart',
            html: `Product  <b>${product.querySelector('.item-title').innerHTML}</b> is no longer available.<br>`
                + 'It will be removed now from products list.',
            icon: 'error',
            confirmButtonText: 'Ok',
            backdrop: true,
            onClose: () => {
                product.remove();
            },
        });
    },
};
