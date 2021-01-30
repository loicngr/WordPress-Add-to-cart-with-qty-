function ajaxRequest($productId, $quantity) {
    const form = new FormData();
    form.append('product_id', $productId);
    form.append('qty', $quantity);
    const params = new URLSearchParams(form);


    return new Promise((res, rej) => {
        fetch('?wc-ajax=add_to_cart', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Cache-Control': 'no-cache',
                'accept': '*/*'
            },
            body: params
        }).then(response => {
            res(response.json());
        }).catch(err => {
            rej(err);
        });
    });
}

/**
 * @param {Event} e
 */
async function onClickSubmit(e) {
    e.preventDefault();

    const {product_id} = e.target.dataset;
    if (!product_id) return;

    const {value} = e.target.previousElementSibling;
    if (!value) return;

    console.log(e.target.setAttribute("data-quantity", value));
}

function main() {
    const divElements = document.getElementsByClassName('add_to_cart_shortcode_form');
    if (!divElements || divElements.length === 0) return;

    [...divElements].forEach((div) => {
        div.lastElementChild.addEventListener('click', onClickSubmit);
    });
}
window.addEventListener("load", main);