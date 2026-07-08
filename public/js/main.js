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
            const stock = parseInt(document.getElementById('prod_stock').value);

            let errors = [];

            if(name === '') errors.push("El nombre del producto es obligatorio.");
            if(category === '') errors.push("Debe seleccionar una categoría.");
            if(isNaN(price) || price < 0) errors.push("El precio debe ser un número positivo.");
            if(isNaN(stock) || stock < 0) errors.push("El stock no puede ser negativo.");

            if(errors.length > 0) {
                e.preventDefault();
                alert("Errores en el formulario:\n" + errors.join("\n"));
            }
        });
    }


    // Validación de formulario de marca
    const marcaForm = document.getElementById("marcaForm");
    if (marcaForm) {
        marcaForm.addEventListener("submit", function(e) {
            const nombre = document.getElementById("nombre").value.trim();
            const descripcion = document.getElementById("descripcion").value.trim();
            const pais = document.getElementById("pais_origen").value.trim();
            let errores = [];
            if(nombre === "") {
                errores.push("El nombre de la marca es obligatorio.");
            }
            if(nombre.length < 2) {
                errores.push("El nombre de la marca debe tener al menos 2 caracteres.");
            }
            if(descripcion === "") {
                errores.push("La descripción es obligatoria.");
            }
            if(pais === "") {
                errores.push("El país de origen es obligatorio.");
            }
            if(errores.length > 0) {
                e.preventDefault();
                alert(
                    "Errores encontrados:\n\n" +
                    errores.join("\n")
                );
            }
        });
    }

    // Validación de formulario de proveedor
    const proveedorForm = document.getElementById("proveedorForm");
    if (proveedorForm) {
        proveedorForm.addEventListener("submit", function(e) {
            const nombre = document.getElementById("nombre_proveedor").value.trim();
            const telefono = document.getElementById("telefono_proveedor").value.trim();
            const correo = document.getElementById("correo_proveedor").value.trim();
            const direccion = document.getElementById("direccion_proveedor").value.trim();
            let errores = [];
            if(nombre === "") {
                errores.push("El nombre del proveedor es obligatorio.");
            }
            if(nombre.length < 2) {
                errores.push("El nombre del proveedor debe tener al menos 2 caracteres.");
            }
            if(telefono === "") {
                errores.push("El teléfono es obligatorio.");
            }
            if(!/^[0-9]+$/.test(telefono)) {
                errores.push("El teléfono solo debe contener números.");
            }
            if(correo === "") {
                errores.push("El correo es obligatorio.");
            }
            if(!correo.includes("@")) {
                errores.push("El correo no tiene un formato válido.");
            }
            if(direccion === "") {
                errores.push("La dirección es obligatoria.");
            }
            if(errores.length > 0) {
                e.preventDefault();
                alert(
                    "Errores encontrados:\n\n" +
                    errores.join("\n")
                );
            }
        });
    }

});
