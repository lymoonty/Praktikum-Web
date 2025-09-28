document.addEventListener('DOMContentLoaded', function() {
    setupMobileMenu();
    setupSmoothScrolling();
    setupProductCards();
    setupContactForm();
    setupDarkMode();
    showWelcomeMessage();
});

function setupMobileMenu() {
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const mobileLabel = document.querySelector('.mobile-menu-label');
    
    if (mobileLabel && mobileToggle) {
        mobileLabel.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (mobileToggle.checked) {
                icon.className = 'fas fa-times';
            } else {
                icon.className = 'fas fa-bars';
            }
        });
        
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileToggle.checked = false;
                mobileLabel.querySelector('i').className = 'fas fa-bars';
            });
        });
    }
}

function setupSmoothScrolling() {
    const navLinks = document.querySelectorAll('a[href^="#"]');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            
            if (target) {
                const headerHeight = 80;
                const targetPosition = target.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

function setupProductCards() {
    const productCards = document.querySelectorAll('.product-card:not(.card-featured)');
    
    productCards.forEach((card, index) => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.cursor = 'pointer';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
        
        card.addEventListener('click', function() {
            showProductDetail(index);
        });
    });
}

function showProductDetail(productIndex) {
    const products = [
        {
            name: 'Makanan Hewan',
            desc: 'Berbagai pilihan makanan berkualitas untuk kucing, anjing, burung, dan hewan peliharaan lainnya.',
            price: 'Mulai dari Rp 50.000'
        },
        {
            name: 'Aksesoris & Mainan', 
            desc: 'Koleksi lengkap aksesoris seperti kalung, tali, kandang, tempat makan, dan mainan edukatif.',
            price: 'Mulai dari Rp 25.000'
        },
        {
            name: 'Produk Perawatan',
            desc: 'Shampoo, vitamin, obat-obatan, dan produk kesehatan untuk hewan peliharaan.',
            price: 'Mulai dari Rp 30.000'
        },
        {
            name: 'Hewan Peliharaan',
            desc: 'Berbagai jenis hewan peliharaan yang sehat dan terawat dengan baik.',
            price: 'Hubungi untuk harga'
        }
    ];
    
    const product = products[productIndex];
    
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.8); display: flex; justify-content: center;
        align-items: center; z-index: 1000;
    `;
    
    const modalContent = document.createElement('div');
    modalContent.style.cssText = 'background: white; padding: 30px; border-radius: 15px; max-width: 500px; width: 90%; position: relative;';
    
    modalContent.innerHTML = `
        <button class="modal-close-btn" style="position: absolute; top: 15px; right: 20px; background: none; border: none; font-size: 24px; cursor: pointer; color: #999; padding: 5px; transition: color 0.3s ease;">×</button>
        <h2 style="margin-bottom: 15px; color: #667eea;">${product.name}</h2>
        <p style="margin-bottom: 20px; line-height: 1.6;">${product.desc}</p>
        <div style="font-size: 1.3rem; font-weight: 600; color: #28a745; margin-bottom: 20px;">${product.price}</div>
        <button onclick="contactWhatsApp('${product.name}')" 
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 12px 24px; border-radius: 25px; cursor: pointer; font-size: 16px;">
            Pesan via WhatsApp
        </button>
    `;
    
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
    
    const closeBtn = modalContent.querySelector('.modal-close-btn');
    closeBtn.addEventListener('click', function() {
        modal.remove();
    });
    
    closeBtn.addEventListener('mouseenter', function() {
        this.style.color = '#333';
    });
    
    closeBtn.addEventListener('mouseleave', function() {
        this.style.color = '#999';
    });
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.remove();
        }
    });
}

function contactWhatsApp(productName = '') {
    let message = 'Halo, saya tertarik dengan produk di Hiro Petshop.';
    if (productName) {
        message += ` Khususnya untuk ${productName}.`;
    }
    
    const whatsappUrl = `https://wa.me/6285750316170?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
}

function setupContactForm() {
    const contactSection = document.querySelector('#contact .contact-content');
    
    const formHTML = `
        <div style="background: rgba(255, 255, 255, 0.1); padding: 30px; border-radius: 15px; backdrop-filter: blur(10px);">
            <h3 style="margin-bottom: 20px;">Kirim Pesan</h3>
            <form id="contact-form">
                <input type="text" id="contact-name" placeholder="Nama Anda" required 
                       style="width: 100%; padding: 12px; margin-bottom: 15px; border: none; border-radius: 8px; outline: none;">
                <input type="email" id="contact-email" placeholder="Email Anda" required
                       style="width: 100%; padding: 12px; margin-bottom: 15px; border: none; border-radius: 8px; outline: none;">
                <textarea id="contact-message" placeholder="Pesan Anda" rows="4" required
                          style="width: 100%; padding: 12px; margin-bottom: 15px; border: none; border-radius: 8px; outline: none; resize: vertical;"></textarea>
                <button type="submit" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none; padding: 12px 24px; border-radius: 25px; cursor: pointer; font-size: 16px;">
                    Kirim Pesan
                </button>
            </form>
        </div>
    `;
    
    contactSection.insertAdjacentHTML('beforeend', formHTML);
    
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('contact-name').value;
        const email = document.getElementById('contact-email').value;
        const message = document.getElementById('contact-message').value;
        
        const whatsappMessage = `Halo, saya ${name} (${email}). ${message}`;
        const whatsappUrl = `https://wa.me/6285750316170?text=${encodeURIComponent(whatsappMessage)}`;
        
        window.open(whatsappUrl, '_blank');
        showNotification('Pesan akan dikirim melalui WhatsApp!');
        this.reset();
    });
}

function setupDarkMode() {
    const darkModeBtn = document.createElement('button');
    darkModeBtn.innerHTML = '<i class="fas fa-moon"></i>';
    darkModeBtn.title = 'Toggle Dark Mode';
    darkModeBtn.style.cssText = `
        background: rgba(255,255,255,0.2); border: none; color: white;
        padding: 10px; border-radius: 50%; cursor: pointer; font-size: 16px;
        transition: all 0.3s ease; margin-left: 15px;
    `;
    
    document.querySelector('nav').appendChild(darkModeBtn);
    
    let isDarkMode = false;
    
    darkModeBtn.addEventListener('click', function() {
        isDarkMode = !isDarkMode;
        document.body.classList.toggle('dark-mode');
        
        const icon = this.querySelector('i');
        icon.className = isDarkMode ? 'fas fa-sun' : 'fas fa-moon';
        
        if (isDarkMode && !document.getElementById('dark-style')) {
            const darkStyle = document.createElement('style');
            darkStyle.id = 'dark-style';
            darkStyle.textContent = `
                body.dark-mode { background-color: #1a1a1a; color: #e0e0e0; }
                body.dark-mode .card { background: #2d3748; color: #e0e0e0; }
                body.dark-mode #products { background: #2d3748; }
                body.dark-mode #about { background: #1a1a1a; }
            `;
            document.head.appendChild(darkStyle);
        }
    });
}

function showNotification(message, duration = 3000) {
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed; top: 20px; right: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white; padding: 15px 20px; border-radius: 8px; z-index: 2000;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3); animation: slideIn 0.5s ease;
    `;
    
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
        style.remove();
    }, duration);
}

function showWelcomeMessage() {
    const hasVisited = localStorage.getItem('hiro_visited');
    
    if (!hasVisited) {
        setTimeout(() => {
            showNotification('Selamat datang di Hiro Petshop!', 4000);
            localStorage.setItem('hiro_visited', 'true');
        }, 1500);
    }
}

const scrollBtn = document.createElement('button');
scrollBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
scrollBtn.style.cssText = `
    position: fixed; bottom: 30px; right: 30px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white; border: none; border-radius: 50%; width: 50px; height: 50px;
    font-size: 18px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    transition: all 0.3s ease; opacity: 0; visibility: hidden; z-index: 1000;
`;

document.body.appendChild(scrollBtn);

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        scrollBtn.style.opacity = '1';
        scrollBtn.style.visibility = 'visible';
    } else {
        scrollBtn.style.opacity = '0';
        scrollBtn.style.visibility = 'hidden';
    }
});

scrollBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.querySelector('div[style*="fixed"]');
        if (modal) modal.remove();
    }
});

async function fetchPetFacts() {
    try {
        const response = await fetch('https://dog-api.kinduff.com/api/facts');
        
        if (!response.ok) {
            throw new Error("Network response was not ok " + response.statusText);
        }
        
        const data = await response.json();
        console.log('Pet Facts Data:', data);
        
        if (data.facts && data.facts.length > 0) {
            showNotification(`Fakta Hewan: ${data.facts[0]}`, 8000);
        }
        
        return data;
    } catch (error) {
        console.error("There has been a problem with your fetch operation:", error);
        showNotification('Gagal memuat fakta hewan', 'error');
    }
}

async function sendCustomerData(customerData) {
    try {
        const response = await fetch('https://jsonplaceholder.typicode.com/posts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(customerData),
        });
        
        if (!response.ok) {
            throw new Error("Network response was not ok " + response.statusText);
        }
        
        const data = await response.json();
        console.log('Customer data sent successfully:', data);
        showNotification('Data pelanggan berhasil dikirim!', 'success');
        
        return data;
    } catch (error) {
        console.error("Error sending customer data:", error);
        showNotification('Gagal mengirim data pelanggan', 'error');
    }
}

async function fetchProductData(productType = 'pets') {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts?_limit=5`);
        
        if (!response.ok) {
            throw new Error("Network response was not ok " + response.statusText);
        }
        
        const data = await response.json();
        console.log('Product data:', data);
        
        const productData = data.map((item, index) => ({
            id: item.id,
            name: ['Makanan Kucing', 'Mainan Anjing', 'Vitamin Burung', 'Kandang Hamster', 'Aksesoris Kelinci'][index] || `Produk Hewan ${item.id}`,
            description: item.body.substring(0, 100) + '...',
            price: Math.floor(Math.random() * 500000) + 50000,
            category: productType
        }));
        
        displayProductData(productData);
        return productData;
        
    } catch (error) {
        console.error("Error fetching product data:", error);
        showNotification('Gagal memuat data produk', 'error');
    }
}

async function updateCustomerData(customerId, updatedData) {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${customerId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(updatedData),
        });
        
        if (!response.ok) {
            throw new Error("Network response was not ok " + response.statusText);
        }
        
        const data = await response.json();
        console.log('Customer data updated:', data);
        showNotification('Data pelanggan berhasil diupdate!', 'success');
        
        return data;
    } catch (error) {
        console.error("Error updating customer data:", error);
        showNotification('Gagal mengupdate data pelanggan', 'error');
    }
}

async function deleteCustomerData(customerId) {
    try {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${customerId}`, {
            method: 'DELETE'
        });
        
        if (!response.ok) {
            throw new Error("Network response was not ok " + response.statusText);
        }
        
        console.log('Customer data deleted successfully');
        showNotification('Data pelanggan berhasil dihapus!', 'success');
        
        return { success: true };
    } catch (error) {
        console.error("Error deleting customer data:", error);
        showNotification('Gagal menghapus data pelanggan', 'error');
    }
}

function displayProductData(products) {
    const productsContainer = document.querySelector('.products-grid');
    
    const apiProductsSection = document.createElement('div');
    apiProductsSection.innerHTML = `
        <div style="grid-column: 1/-1; text-align: center; margin: 30px 0;">
            <h3 style="color: #667eea;">Produk Terbaru dari API</h3>
        </div>
    `;
    
    products.forEach(product => {
        const productCard = document.createElement('article');
        productCard.className = 'card product-card api-product';
        productCard.innerHTML = `
            <h4>${product.name}</h4>
            <p>${product.description}</p>
            <div style="font-size: 1.2rem; font-weight: 600; color: #28a745; margin: 10px 0;">
                Rp ${product.price.toLocaleString()}
            </div>
            <button onclick="contactWhatsApp('${product.name}')" 
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 8px 16px; border-radius: 20px; cursor: pointer;">
                Pesan Sekarang
            </button>
        `;
        
        apiProductsSection.appendChild(productCard);
    });
    
    productsContainer.appendChild(apiProductsSection);
}



document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        fetchPetFacts();
    }, 3000);
});

window.contactWhatsApp = contactWhatsApp;
