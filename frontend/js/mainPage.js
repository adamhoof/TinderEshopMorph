function fetchItem() {
    return fetch("../../backend/fetchItem.php")
        .then(response => {
            return response.json().catch(() => null); // Handle case where JSON parsing fails
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
            return null;
        });
}

function linkItemToUser() {

    const data = {itemId: currentItem.itemId};
    return fetch("../../backend/linkItemToUser.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    }).then(response => response.json());
}

document.addEventListener('DOMContentLoaded', function () {
    const buyButton = document.getElementById('buy_item_button');
    const nextButton = document.getElementById('next_item_button');

    nextButton.addEventListener('click', function () {
        nextItem();
    });

    if (buyButton === null) {
        nextItem();
        return;
    }

    buyButton.addEventListener('click', function () {
        buyItem();
    });

    nextItem();
});

function buyItem() {
    if (currentItem === undefined) {
        return;
    }
    const buyButton = document.getElementById('buy_item_button');
    const originalButtonText = buyButton.innerHTML;

    linkItemToUser();

    buyButton.innerHTML = '<img src="../../backend/assets/spinnar_unscreen.gif" alt="Loading">';
    buyButton.disabled = true;
    setTimeout(() => {
        buyButton.innerHTML = originalButtonText;
        nextItem();
        buyButton.disabled = false;
    }, 750);
}

let currentItem;

function nextItem() {
    fetchItem().then(item => {
        if (item === null) {
            document.getElementById('item_name').textContent = 'No more items to buy, come back later!';
            document.getElementById('item_price').textContent = '';
            document.getElementById('item_seller').textContent = '';
            document.getElementById('item_category').textContent = '';
            return;
        }
        currentItem = item;
        document.getElementById('item_img').src = "../../backend/itemPictures/" + currentItem.itemId + "/item_picture.gif"


        document.getElementById('item_name').textContent = currentItem.name;
        document.getElementById('item_price').textContent = '$' + currentItem.price;
        document.getElementById('item_seller').textContent = 'Seller: ' + currentItem.seller_id;
        document.getElementById('item_category').textContent = 'Categories: ' + currentItem.categories.join(', ');
    });
}
