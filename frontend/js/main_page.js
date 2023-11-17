document.addEventListener('DOMContentLoaded', function() {
    const buyItemButton = document.getElementById('buy_item_button');
    document.getElementById('next_item_button').addEventListener('click', nextItem);
    buyItemButton.addEventListener('click', buyItem);
    /*nextItemButton.addEventListener('click', nextItem);*/
});
function buyItem() {
    // Code for buying the current item
}



let items = [
    { name: "Item 7", price: 20.00, seller: "Seller B", category: ["Category CategoryCategoryCategoryCategoryCategoryCategoryCategoryCategoryCategory 7","Category 7","Category 7","Category 7"], image: "crackhead.jpg" },
    { name: "Item 1", price: 10.00, seller: "Seller A", category: "Category 1", image: "crackhead.jpg" },
    { name: "Item 2", price: 20.00, seller: "Seller B", category: "Category 2", image: "crackhead.jpg" },
    { name: "Item 3", price: 20.00, seller: "Seller B", category: "Category 3", image: "crackhead.jpg" },
    { name: "Item 4", price: 20.00, seller: "Seller B", category: "Category 4", image: "crackhead.jpg" },
    { name: "Item 5", price: 20.00, seller: "Seller B", category: "Category 5", image: "crackhead.jpg" },
    { name: "Item 6", price: 20.00, seller: "Seller B", category: "Category 6", image: "crackhead.jpg" },

];

let currentItemIndex = 0;
function displayItem(index) {
    let item = items[index];
    document.getElementById('item_image').src = item.image;
    document.getElementById('item_name').textContent = item.name;
    document.getElementById('item_price').textContent = '$' + item.price.toFixed(2);
    document.getElementById('item_seller').textContent = 'Seller: ' + item.seller;
    document.getElementById('item_category').textContent = 'Categories: ' + item.category;
}

function nextItem() {
    if (++currentItemIndex >= items.length) {
        currentItemIndex = 0;
        //perform another request
    }
    displayItem(currentItemIndex);
}
window.onload = function() {
    /*maybe logic to remember which item was browsed?
    items empty - means first page load, perform request first
    items not empty - means request has been performed, just load the item with saved index
    */

    displayItem(currentItemIndex);
};
