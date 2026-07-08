document.addEventListener("DOMContentLoaded", function() {
    
    // Validación de formulario de categoría
    const categoryForm = document.getElementById('categoryForm');
    if(categoryForm) {
        categoryForm.addEventListener('submit', function(e) {
            const name = document.getElementById('cat_name').value.trim();
            if(name === '') {
                e.preventDefault();
                alert('El nombre de la categoría no puede estar vacío.');
            }
        });
    }

    // Validación de formulario de producto
    const productForm = document.getElementById('productForm');
    if(productForm) {
        productForm.addEventListener('submit', function(e) {
            const name = document.getElementById('prod_name').value.trim();
            const category = document.getElementById('prod_category').value;
            const price = parseFloat(document.getElementById('prod_price').value);

            let errors = [];

            if(name === '') errors.push("El nombre del producto es obligatorio.");
            if(category === '') errors.push("Debe seleccionar una categoría.");
            if(isNaN(price) || price < 0) errors.push("El precio debe ser un número positivo.");

            if(errors.length > 0) {
                e.preventDefault();
                alert("Errores en el formulario:\n" + errors.join("\n"));
            }
        });
    }

});
