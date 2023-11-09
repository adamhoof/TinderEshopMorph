let selectedCategories = [];
let selectedCategoriesCount = 0;
function addCategoryToSelectedCategories() {
    const selectedCategory = document.querySelector("#categories").value;

    if (selectedCategories.includes(selectedCategory)) {
        //TODO: already selected error message
        return;
    }

    if (selectedCategoriesCount > 3) {
        //TODO: add error message
        // Prevent increment as addition is not allowed
        return;
    }

    selectedCategoriesCount++;
    selectedCategories.push(selectedCategory);

    createPhysicalRepresentation(selectedCategory);
}
function createPhysicalRepresentation(category) {
    const categoryElement = document.createElement('span');
    categoryElement.className = 'tag';
    categoryElement.textContent = category;
    categoryElement.id = category;
    categoryElement.addEventListener('click', removeCategory);

    document.querySelector("#selected_categories").appendChild(categoryElement);
}
function removeCategory(){
    const clickedCategory = this.id;
    const categoryElement = document.getElementById(clickedCategory);
    categoryElement.remove();

    selectedCategoriesCount--;
    selectedCategories = selectedCategories.filter(category => category !== clickedCategory);
}

document.addEventListener("DOMContentLoaded", function () {
    // Fetch categories from database and populate
    fetch("/api/categories")
        .then(response => response.json())
        .then(categories => {
            categories.forEach(category => {
                document.querySelector("#categories").innerHTML += "<option value='" + category + "'>" + category + "</option>"
            })
        })
    
    document.querySelector("#categories").addEventListener("click", addCategoryToSelectedCategories);
});
