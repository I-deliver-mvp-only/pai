'use strict';

const productItemAnimations = {
    init() {
        Array.from(document.querySelectorAll('.item-wrapper')).forEach((item) => {
            this.itemHoverAnimation(item);
        });
    },

    itemHoverAnimation(item) {
        const img = item.querySelector('.item-img');
        const btn = item.querySelector('.add-to-cart-btn');
        img.onmouseover = btn.onmouseover = () => {
            if (!img.classList.contains('item-img-hover')) {
                img.classList.add('item-img-hover');
            }
            if (!btn.classList.contains('add-to-cart-btn-hover')) {
                btn.classList.add('add-to-cart-btn-hover');
            }
        };
        item.querySelector('.item-view').onmouseleave = () => {
            img.classList.remove('item-img-hover');
            btn.classList.remove('add-to-cart-btn-hover');
        };
    },
};
