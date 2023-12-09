let selectedCategories = [];
let selectedCategoriesCount = 0;

document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("#categories").addEventListener("click", addCategoryToSelectedCategories);
});
function addCategoryToSelectedCategories() {
    const selectedCategory = document.querySelector("#categories").value;

    if (selectedCategories.includes(selectedCategory)) {
        return;
    }

    if (selectedCategoriesCount > 3) {
        return;
    }

    selectedCategoriesCount++;
    selectedCategories.push(selectedCategory);

    createPhysicalRepresentation(selectedCategory);
}

function createPhysicalRepresentation(category) {
    const categoryElement = document.createElement('input');
    categoryElement.className = 'tag';
    categoryElement.value = category;
    categoryElement.id = category;
    categoryElement.readOnly = true;
    categoryElement.name = 'selected_categories[]';
    categoryElement.addEventListener('click', removeCategory);

    document.querySelector("#selected_categories").appendChild(categoryElement);
}

function removeCategory() {
    const clickedCategory = this.id;
    const categoryElement = document.getElementById(clickedCategory);
    categoryElement.remove();

    selectedCategoriesCount--;
    selectedCategories = selectedCategories.filter(category => category !== clickedCategory);
}