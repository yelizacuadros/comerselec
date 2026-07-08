document.addEventListener("DOMContentLoaded", function() {
    const showErrors = (errors) => {
        alert("Errores encontrados:\n\n" + errors.join("\n"));
    };

    const bindForm = (id, handler) => {
        const form = document.getElementById(id);
        if (form) form.addEventListener('submit', handler);
    };

    bindForm('categoryForm', function(e) {
        const name = document.getElementById('cat_name').value.trim();
        const errors = [];
        if (!name) errors.push('El nombre de la categoría no puede estar vacío.');
        if (name.length > 100) errors.push('El nombre de la categoría no puede superar 100 caracteres.');
        if (errors.length) { e.preventDefault(); showErrors(errors); }
    });

    bindForm('productForm', function(e) {
        const errors = [];
        const name = document.getElementById('prod_name').value.trim();
        const category = document.getElementById('prod_category').value;
        const marca = this.querySelector('select[name="id_marca"]').value;
        const proveedor = this.querySelector('select[name="id_proveedor"]').value;
        const price = parseFloat(document.getElementById('prod_price').value);
        const imageUrl = this.querySelector('input[name="image_url"]').value.trim();

        if (!category) errors.push('Debe seleccionar una categoría.');
        if (!marca) errors.push('Debe seleccionar una marca.');
        if (!proveedor) errors.push('Debe seleccionar un proveedor.');
        if (!name) errors.push('El nombre del producto es obligatorio.');
        if (name.length > 150) errors.push('El nombre del producto no puede superar 150 caracteres.');
        if (isNaN(price) || price < 0) errors.push('El precio debe ser un número mayor o igual a 0.');
        if (imageUrl && !/^https?:\/\/.+/i.test(imageUrl)) errors.push('La URL de la imagen debe comenzar con http:// o https://');
        if (errors.length) { e.preventDefault(); showErrors(errors); }
    });

    bindForm('marcaForm', function(e) {
        const nombre = document.getElementById('nombre').value.trim();
        const descripcion = document.getElementById('descripcion').value.trim();
        const pais = document.getElementById('pais_origen').value.trim();
        const errors = [];
        if (nombre.length < 2) errors.push('El nombre de la marca debe tener al menos 2 caracteres.');
        if (!descripcion) errors.push('La descripción es obligatoria.');
        if (!pais) errors.push('El país de origen es obligatorio.');
        if (errors.length) { e.preventDefault(); showErrors(errors); }
    });

    bindForm('proveedorForm', function(e) {
        const nombre = document.getElementById('nombre_proveedor').value.trim();
        const telefono = document.getElementById('telefono_proveedor').value.trim();
        const correo = document.getElementById('correo_proveedor').value.trim();
        const direccion = document.getElementById('direccion_proveedor').value.trim();
        const errors = [];
        if (nombre.length < 2) errors.push('El nombre del proveedor debe tener al menos 2 caracteres.');
        if (!/^[0-9+\-\s()]{7,20}$/.test(telefono)) errors.push('El teléfono debe tener un formato válido.');
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) errors.push('El correo debe tener un formato válido.');
        if (!direccion) errors.push('La dirección es obligatoria.');
        if (errors.length) { e.preventDefault(); showErrors(errors); }
    });

    bindForm('usuarioForm', function(e) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;
        const createdAt = document.getElementById('created_at').value;
        const errors = [];
        if (username.length < 3) errors.push('El nombre de usuario debe tener al menos 3 caracteres.');
        if (password.length < 4) errors.push('La contraseña debe tener al menos 4 caracteres.');
        if (!createdAt) errors.push('La fecha de creación es obligatoria.');
        if (errors.length) { e.preventDefault(); showErrors(errors); }
    });

    bindForm('inventarioForm', function(e) {
        const producto = document.getElementById('inv_producto');
        const stock = parseInt(document.getElementById('inv_stock').value, 10);
        const ubicacion = document.getElementById('inv_ubicacion').value.trim();
        const errors = [];
        if (producto && producto.value === '') errors.push('Debe seleccionar un producto.');
        if (isNaN(stock) || stock < 0) errors.push('El stock debe ser un número mayor o igual a 0.');
        if (!ubicacion) errors.push('La ubicación es obligatoria.');
        if (errors.length) { e.preventDefault(); showErrors(errors); }
    });

    bindForm('loginForm', function(e) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;
        const errors = [];
        if (username === '') errors.push('El usuario es obligatorio.');
        if (password === '') errors.push('La contraseña es obligatoria.');
        if (errors.length) { e.preventDefault(); showErrors(errors); }
    });

    bindForm('ventaForm', function(e) {
        const cliente = this.querySelector('input[name="cliente"]').value.trim();
        const errors = [];
        if (cliente.length < 3) errors.push('El cliente debe tener al menos 3 caracteres.');
        const rows = this.querySelectorAll('.sale-item-row');
        rows.forEach((row) => {
            const producto = row.querySelector('select[name="producto_id[]"]').value;
            const cantidad = parseInt(row.querySelector('input[name="cantidad[]"]').value, 10);
            if (!producto) errors.push('Cada fila debe tener un producto seleccionado.');
            if (isNaN(cantidad) || cantidad < 1) errors.push('Cada cantidad debe ser mayor o igual a 1.');
        });
        if (errors.length) { e.preventDefault(); showErrors(errors); }
    });

    const addSaleItem = document.getElementById('addSaleItem');
    const saleItems = document.getElementById('saleItems');
    const template = document.getElementById('saleItemTemplate');
    if (addSaleItem && saleItems && template) {
        addSaleItem.addEventListener('click', (event) => {
            event.preventDefault();
            const fragment = template.content ? template.content.cloneNode(true) : null;
            if (fragment) {
                saleItems.appendChild(fragment);
            }
        });
    }

    const saleToast = document.querySelector('.sale-toast[data-auto-hide="true"]');
    if (saleToast) {
        saleToast.style.position = 'fixed';
        saleToast.style.top = '20px';
        saleToast.style.right = '20px';
        saleToast.style.zIndex = '9999';
        saleToast.style.maxWidth = '420px';
        saleToast.style.padding = '14px 16px';
        saleToast.style.borderRadius = '10px';
        saleToast.style.boxShadow = '0 10px 24px rgba(0,0,0,.18)';
        saleToast.style.color = '#fff';
        saleToast.style.fontWeight = '600';
        saleToast.style.background = saleToast.classList.contains('sale-toast-success') ? '#198754' : '#dc3545';
        saleToast.style.transition = 'opacity .25s ease, transform .25s ease';
        setTimeout(() => {
            saleToast.style.opacity = '0';
            saleToast.style.transform = 'translateY(-8px)';
            setTimeout(() => saleToast.remove(), 250);
        }, 3500);
    }
});
