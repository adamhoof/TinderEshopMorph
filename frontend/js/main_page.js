// Assume we have the following items data
let items = [
    { name: "Item 1", price: 10.00, seller: "Seller A", category: "Category 1", image: "image1.jpg" },
    { name: "Item 2", price: 20.00, seller: "Seller B", category: "Category 2", image: "image2.jpg" },
    { name: "Item 3", price: 20.00, seller: "Seller B", category: "Category 2", image: "image2.jpg" },
    { name: "Item 4", price: 20.00, seller: "Seller B", category: "Category 2", image: "image2.jpg" },
    { name: "Item 5", price: 20.00, seller: "Seller B", category: "Category 2", image: "image2.jpg" },
    { name: "Item 6", price: 20.00, seller: "Seller B", category: "Category 2", image: "image2.jpg" },
    { name: "Item 7", price: 20.00, seller: "Seller B", category: "Category 2", image: "image2.jpg" },

];

let currentItemIndex = 0;
function displayItem(index) {
    let item = items[index];
    document.getElementById('item_image').src = item.image;
    document.getElementById('item_name').textContent = item.name;
    document.getElementById('item_price').textContent = '$' + item.price.toFixed(2);
    document.getElementById('item_seller').textContent = 'Seller: ' + item.seller;
    document.getElementById('item_category').textContent = 'Category: ' + item.category;
}

function nextItem() {
    if (++currentItemIndex >= items.length) {
        currentItemIndex = 0;
        //perform another request
    }
    displayItem(currentItemIndex);
}

function buyItem() {
    // Handle buy action (e.g., show a popup)
}

window.onload = function() {
    /*maybe logic to remember which item was browsed?
    items empty - means first page load, perform request first
    items not empty - means request has been performed, just load the item with saved index
    */

    displayItem(currentItemIndex);
};
