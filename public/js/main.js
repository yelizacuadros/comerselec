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

    // Validación de formulario de usuario
    const usuarioForm = document.getElementById('usuarioForm');

    if (usuarioForm) {
        usuarioForm.addEventListener('submit', function(e) {

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            let errors = [];

            if (username === '')
                errors.push("El nombre de usuario es obligatorio.");

            if (password.length < 4)
                errors.push("La contraseña debe tener al menos 4 caracteres.");

            if (errors.length > 0) {
                e.preventDefault();
                alert("Errores en el formulario:\n" + errors.join("\n"));
            }
        });
    }

    // Validación de formulario de inventario
    const inventarioForm = document.getElementById('inventarioForm');

    if (inventarioForm) {
        inventarioForm.addEventListener('submit', function(e) {

            const producto = document.getElementById('inv_producto');
            const stock = parseInt(document.getElementById('inv_stock').value);
            const ubicacion = document.getElementById('inv_ubicacion').value.trim();

            let errors = [];

            if (producto && producto.value === '')
                errors.push("Debe seleccionar un producto.");

            if (isNaN(stock) || stock < 0)
                errors.push("El stock debe ser un número positivo.");

            if (ubicacion === '')
                errors.push("La ubicación es obligatoria.");

            if (errors.length > 0) {
                e.preventDefault();
                alert("Errores en el formulario:\n" + errors.join("\n"));
            }
        });
    }

});
document.addEventListener('DOMContentLoaded', () => {
    const addSaleItem = document.getElementById('addSaleItem');
    const saleItems = document.getElementById('saleItems');
    const template = document.getElementById('saleItemTemplate');

    if (addSaleItem && saleItems && template) {
        addSaleItem.addEventListener('click', () => {
            const clone = template.content.cloneNode(true);
            saleItems.appendChild(clone);
        });
    }
});
