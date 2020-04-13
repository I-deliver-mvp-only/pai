'use strict';

const cart = {
    initBackShoppingClick() {
        document.querySelector('.back-shopping-btn').onclick = () => {
            window.location = '/';
        };
    },

    initPurchaseClick() {
        document.querySelector('.purchase-btn').onclick = () => {
            fetch('/api/payment', {
                method: 'POST',
            })
                .then((response) => {
                    if (response.status !== 201) {
                        response.json().then(this.processFailedPurchase.bind(this));
                        return;
                    }

                    this.processSuccessfulPurchase();
                })
        }
    },

    initRemoveFromCartClick() {
        Array.from(document.querySelectorAll('.remove-from-cart-btn')).forEach((btn) => {
            btn.onclick = (e) => {
                const productNode = (e.target.tagName !== 'BUTTON') ?
                    e.target.parentNode.parentNode.parentNode : e.target.parentNode.parentNode;
                const productId = productNode.querySelector('.item-id').innerHTML;

                fetch(`/api/cart/product/${productId}`, {
                    method: 'DELETE',
                }).then((response) => {
                    if (response.status === 200) {
                        productNode.remove();
                        if (!document.querySelectorAll('.cart-products > li').length) {
                            document.querySelector('.cart-products').remove();
                            document.querySelector('h1').innerHTML = 'Cart is empty...';
                            document.querySelector('.purchase-btn').remove();
                        }
                    }
                })
            };
        });

    },

    processFailedPurchase(responseJsonData) {
        const notPurchasedProductNamesList = responseJsonData.data.map((product) => `<li><b>${product.name}</b></li>`);

        Swal.fire({
            title: 'Couldn\'t purchase products from cart',
            html: 'Following products are no longer available for purchase'
                + '<ul style="margin-top: 25px;">'
                + notPurchasedProductNamesList
                + '<ul>',
            icon: 'error',
            confirmButtonText: 'Ok',
            backdrop: true,
        });
    },

    processSuccessfulPurchase() {
        Swal.fire({
            title: 'Thanks for your purchase',
            text: 'Your payment was successfully processed. Soon products will be shipped to you :)',
            icon: 'success',
            confirmButtonText: 'Ok',
            backdrop: true,
            onClose: () => {
                window.location = '/';
            },
        });
    },
};
