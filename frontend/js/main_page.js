function fetchItem() {
    return fetch("../../backend/fetch_item.php")
        .then(response => response.json());
}

function linkItemToUser() {

   /* return fetch("../../backend/linkItemToUser.php")
        .then(response => response.json());*/
    return new Promise((resolve, reject) => {
        resolve();
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const buyButton = document.getElementById('buy_item_button');
    const nextButton = document.getElementById('next_item_button');

    buyButton.addEventListener('click', function () {
        buyItem();
    });

    nextButton.addEventListener('click', function () {
        nextItem();
    });

    nextItem();
});

function buyItem() {
    const buyButton = document.getElementById('buy_item_button');
    const originalButtonText = buyButton.innerHTML;

    linkItemToUser().then(r => {
        buyButton.innerHTML = '<img src="../views/spinnar_unscreen.gif" alt="Loading">';
        buyButton.disabled = true;
    });
    setTimeout(() => {
        buyButton.innerHTML = originalButtonText;
        nextItem();
        buyButton.disabled = false;
    }, 750);
}


function nextItem() {
    fetchItem().then(item => {
        document.getElementById('item_image').src = item.picUrl;
        document.getElementById('item_name').textContent = item.name;
        document.getElementById('item_price').textContent = '$' + item.price.toFixed(2);
        document.getElementById('item_seller').textContent = 'Seller: ' + item.seller_guid;
        document.getElementById('item_category').textContent = 'Categories: ' + item.categories.join(', ');
    });
}

/*window.onload = function() {
    /!*maybe logic to remember which item was browsed?
    items empty - means first page load, perform request first
    items not empty - means request has been performed, just load the item with saved index
    *!/

    displayItem(currentItemIndex);
};*/
