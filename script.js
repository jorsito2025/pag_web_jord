// script.js

document.addEventListener('DOMContentLoaded', () => {
    const productsSection = document.getElementById('productos');
    const productGrid = productsSection ? productsSection.querySelector('.product-grid') : null;
    const welcomeMessage = document.querySelector('.welcome-message');
    const linkOfertas = document.getElementById('link-ofertas');
    const linkProductos = document.getElementById('link-productos');

    // --- Lógica del Mensaje de Bienvenida ---
    if (welcomeMessage) {
        // Ocultar automáticamente el mensaje de bienvenida después de 5 segundos
        setTimeout(() => {
            welcomeMessage.style.display = 'none';
        }, 5000);
    }

    // --- Lógica de Cálculo de Ofertas ---
    const applyOffer = () => {
        if (!productGrid) return;

        document.querySelectorAll('.product-card[data-oferta="true"]').forEach(productCard => {
            const originalPriceText = productCard.dataset.precio;
            const originalPrice = parseFloat(originalPriceText);

            if (!isNaN(originalPrice)) {
                const discount = 0.10; // 10% de descuento
                const discountedPrice = originalPrice * (1 - discount);
                const priceElement = productCard.querySelector('.price');

                if (priceElement) {
                    // Almacenar el precio original en un atributo de datos
                    if (!productCard.dataset.originalPrecio) {
                        productCard.dataset.originalPrecio = originalPriceText;
                    }

                    priceElement.innerHTML = `
                        <span class="original-price text-xl text-gray-500 line-through mr-2">$${originalPrice.toFixed(2)}</span>
                        <span class="discounted-price text-3xl font-bold text-red-600">$${discountedPrice.toFixed(2)}</span>
                    `;
                }
            }
        });
    };

    const removeOffer = () => {
        if (!productGrid) return;

        document.querySelectorAll('.product-card[data-oferta="true"]').forEach(productCard => {
            const originalPriceText = productCard.dataset.originalPrecio; // Recuperar precio original
            const priceElement = productCard.querySelector('.price');

            if (priceElement && originalPriceText) {
                priceElement.innerHTML = `
                    <span class="text-3xl font-bold text-blue-600">$${parseFloat(originalPriceText).toFixed(2)}</span>
                `;
                // Limpiar el atributo de datos temporal
                delete productCard.dataset.originalPrecio;
            }
        });
    };

    // Manejar la navegación a "Ofertas"
    if (linkOfertas) {
        linkOfertas.addEventListener('click', (event) => {
            event.preventDefault();
            applyOffer();
            // Desplazarse a la sección de productos o a una sección relevante si se desea
            if (productsSection) {
                productsSection.scrollIntoView({ behavior: 'smooth' });
            }
            // Actualizar el hash de la URL
            window.location.hash = 'ofertas';
        });
    }

    // Manejar la navegación a "Productos" para eliminar ofertas
    if (linkProductos) {
        linkProductos.addEventListener('click', (event) => {
            event.preventDefault();
            removeOffer();
            // Desplazarse a la sección de productos
            if (productsSection) {
                productsSection.scrollIntoView({ behavior: 'smooth' });
            }
            // Actualizar el hash de la URL
            window.location.hash = 'productos';
        });
    }

    // --- Datos de Productos (Base de Datos Simulada) ---
    let products = [
        {
            id: 'nintendo-switch-2',
            name: 'Nintendo Switch 2',
            image: 'https://gsmpro.cl/cdn/shop/articles/posible-nintendos-switch-2-gsmpro.cl.webp?v=',
            attributes: [
                'Atributo 1: Valor del atributo',
                'Atributo 2: Otro valor',
                'Atributo 3: Dato importante',
                'Atributo 4: Característica especial',
                'Atributo 5: Especificación técnica',
                'Atributo 6: Material o composición',
                'Atributo 7: Dimensiones o peso'
            ],
            price: 999.99,
            isOffer: true,
            detailsLink: 'https://www.youtube.com/shorts/wwikM5SMaew'
        },
        {
            id: 'computador-hp',
            name: 'computador hp',
            image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnN0zuwDeN-47Wm-6LqG3C5gmQNXCVBRvFWQ&s',
            attributes: [
                'Atributo 1: Valor del atributo',
                'Atributo 2: Otro valor',
                'Atributo 3: Dato importante',
                'Atributo 4: Característica especial',
                'Atributo 5: Especificación técnica',
                'Atributo 6: Material o composición',
                'Atributo 7: Dimensiones o peso'
            ],
            price: 499.99,
            isOffer: true,
            detailsLink: 'https://www.youtube.com/shorts/Wm7piuDrP_k'
        },
        {
            id: 'celular-samsung',
            name: 'celular samsung',
            image: 'https://media.falabella.com/falabellaCL/17007783_10/w=1500,h=1500,fit=pad',
            attributes: [
                'Atributo 1: Valor del atributo',
                'Atributo 2: Otro valor',
                'Atributo 3: Dato importante',
                'Atributo 4: Característica especial',
                'Atributo 5: Especificación técnica',
                'Atributo 6: Material o composición',
                'Atributo 7: Dimensiones o peso'
            ],
            price: 199.99,
            isOffer: false,
            detailsLink: 'https://www.youtube.com/shorts/S9kBFEvIwn0'
        }
    ];

    // --- Función para Renderizar Productos ---
    const renderProducts = () => {
        if (!productGrid) return;
        productGrid.innerHTML = ''; // Limpiar los productos existentes

        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card bg-white border border-gray-200 rounded-lg shadow-lg p-6 flex flex-col items-center text-center';
            productCard.dataset.id = product.id; // Añadir un data-id para una fácil identificación
            productCard.dataset.precio = product.price.toFixed(2);
            if (product.isOffer) {
                productCard.dataset.oferta = 'true';
            }

            const attributesHtml = product.attributes.map(attr => `<li><strong class="text-gray-900">${attr.split(':')[0]}:</strong> ${attr.split(':')[1]}</li>`).join('');

            let priceDisplay = `$${product.price.toFixed(2)}`;
            if (product.isOffer) {
                const discountedPrice = product.price * 0.90; // 10% de descuento
                priceDisplay = `
                    <span class="original-price text-xl text-gray-500 line-through mr-2">$${product.price.toFixed(2)}</span>
                    <span class="discounted-price text-3xl font-bold text-red-600">$${discountedPrice.toFixed(2)}</span>
                `;
            } else {
                priceDisplay = `<span class="text-3xl font-bold text-blue-600">${priceDisplay}</span>`;
            }


            productCard.innerHTML = `
                <h3 class="text-xl font-semibold text-gray-900 mb-4">${product.name}</h3>
                <img src="${product.image}" alt="${product.name}" class="w-48 h-48 object-contain rounded-md mb-4">
                <ul class="list-none p-0 m-0 text-left w-full space-y-2 text-gray-700">
                    ${attributesHtml}
                </ul>
                <p class="price text-3xl font-bold text-blue-600 mt-4 mb-6">${priceDisplay}</p>
                <button class="add-to-cart-btn bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition duration-300 shadow-lg mb-2">Añadir al Carrito</button>
                <a href="${product.detailsLink}" target="_blank" class="more-details-btn mt-2 bg-gray-600 text-white px-6 py-3 rounded-full hover:bg-gray-700 transition duration-300 shadow-lg text-sm">Más detalles</a>
                <div class="crud-actions mt-4 flex space-x-2">
                    <button class="edit-btn bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition duration-300 text-sm">Editar</button>
                    <button class="delete-btn bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 text-sm">Eliminar</button>
                </div>
            `;
            productGrid.appendChild(productCard);
        });
    };

    // --- Funciones CRUD ---

    // CREAR (Añadir Producto)
    const addProduct = (newProduct) => {
        // Asignar un ID simple para uso del lado del cliente
        newProduct.id = 'product-' + Date.now();
        products.push(newProduct);
        renderProducts();
        alert('¡Producto añadido exitosamente!');
    };

    // LEER (Ya manejado por renderProducts)

    // ACTUALIZAR (Editar Producto)
    const updateProduct = (productId, updatedData) => {
        const productIndex = products.findIndex(p => p.id === productId);
        if (productIndex > -1) {
            // Fusionar los datos del producto existente con los datos actualizados
            products[productIndex] = { ...products[productIndex], ...updatedData };
            renderProducts();
            alert('¡Producto actualizado exitosamente!');
        } else {
            alert('Producto no encontrado para actualizar.');
        }
    };

    // ELIMINAR (Remover Producto)
    const deleteProduct = (productId) => {
        if (confirm('¿Estás seguro de que quieres eliminar este producto?')) {
            products = products.filter(p => p.id !== productId);
            renderProducts();
            alert('¡Producto eliminado exitosamente!');
        }
    };

    // --- Escuchadores de Eventos para Botones CRUD ---
    if (productGrid) {
        productGrid.addEventListener('click', (event) => {
            const target = event.target;
            const productCard = target.closest('.product-card');

            if (!productCard) return;

            const productId = productCard.dataset.id;
            if (!productId) {
                console.error('La tarjeta de producto no tiene el atributo data-id.');
                return;
            }

            if (target.classList.contains('delete-btn')) {
                deleteProduct(productId);
            } else if (target.classList.contains('edit-btn')) {
                // En una aplicación real, abrirías un modal o formulario
                // Para este ejemplo, usaremos prompts por simplicidad.
                const productToEdit = products.find(p => p.id === productId);
                if (productToEdit) {
                    const newName = prompt('Editar nombre del producto:', productToEdit.name);
                    // Validar la entrada antes de intentar parseFloat
                    let newPrice = prompt('Editar precio del producto:', productToEdit.price);
                    newPrice = newPrice !== null ? parseFloat(newPrice) : null;
                    if (newPrice !== null && isNaN(newPrice)) {
                        alert('Precio inválido. Por favor, introduce un número.');
                        return;
                    }
                    const newImage = prompt('Editar URL de la imagen:', productToEdit.image);
                    const newDetailsLink = prompt('Editar URL de detalles:', productToEdit.detailsLink);

                    if (newName !== null && newPrice !== null && newImage !== null && newDetailsLink !== null) {
                        const updatedData = {
                            name: newName,
                            price: newPrice,
                            image: newImage,
                            detailsLink: newDetailsLink
                            // Deberías manejar atributos y isOffer de manera similar si necesitas editarlos
                        };
                        updateProduct(productId, updatedData);
                    }
                }
            }
        });
    }

    // --- Renderizado Inicial ---
    renderProducts();

    // --- Añadir una interfaz de usuario simple para agregar un nuevo producto ---
    const addProductBtn = document.createElement('button');
    addProductBtn.textContent = 'Añadir Nuevo Producto';
    addProductBtn.className = 'bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-300 mt-8 mb-4 mx-auto block'; // Centrar el botón

    if (productsSection) {
        productsSection.appendChild(addProductBtn);

        addProductBtn.addEventListener('click', () => {
            const name = prompt('Nombre del nuevo producto:');
            if (!name) return; // Si el usuario cancela o deja vacío, no hacer nada

            let price = prompt('Precio del nuevo producto:');
            price = price !== null ? parseFloat(price) : null;
            if (price === null || isNaN(price)) {
                alert('Precio inválido. Por favor, introduce un número.');
                return;
            }

            const image = prompt('URL de la imagen del producto:');
            if (!image) return;

            const detailsLink = prompt('URL de detalles del producto (opcional):', 'https://www.youtube.com/shorts/wwikM5SMaew');
            const isOffer = confirm('¿Este producto está en oferta? (Aceptar para sí, Cancelar para no)');

            const newProduct = {
                name,
                price,
                image,
                attributes: ['Nuevo atributo: Valor'], // Atributo predeterminado, se podría pedir más al usuario
                isOffer,
                detailsLink
            };
            addProduct(newProduct);
        });
    }

    // Manejar el hash inicial para ofertas al cargar la página
    if (window.location.hash === '#ofertas') {
        applyOffer();
    }
});