
const img = document.querySelector('#immagine img');


const originalSrc = img.src;


img.addEventListener('mouseover', () => {
    img.src = 'nuova-immagine.png';
});


img.addEventListener('mouseout', () => {
    img.src = originalSrc;
});

const ricercaDiv = document.getElementById('ricerca');


const searchInput = document.createElement('input');
searchInput.type = 'text';
searchInput.placeholder = 'Cerca...';
searchInput.style.padding = '6px';
searchInput.style.border = '1px solid #ccc';
searchInput.style.borderRadius = '4px';
searchInput.style.marginLeft = '10px';
searchInput.style.display = 'none'; 


ricercaDiv.appendChild(searchInput);


ricercaDiv.addEventListener('click', (e) => {
    searchInput.style.display = 'inline-block';
    searchInput.focus();
    e.stopPropagation();
});


searchInput.addEventListener('blur', () => {
    searchInput.style.display = 'none';
});
const logo = document.getElementById('logo');


const dropdownMenu = document.createElement('div');
dropdownMenu.style.position = 'absolute';
dropdownMenu.style.background = '#fff';
dropdownMenu.style.border = '1px solid #ccc';
dropdownMenu.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
dropdownMenu.style.display = 'none';
dropdownMenu.style.minWidth = '120px';
dropdownMenu.style.zIndex = '1000';

// Crea le voci del menu
const profileLink = document.createElement('a');
profileLink.href = 'login.php';
profileLink.textContent = 'Accedi';
profileLink.style.display = 'block';
profileLink.style.padding = '10px 20px';
profileLink.style.textDecoration = 'none';
profileLink.style.color = '#222';
profileLink.style.fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif';
profileLink.style.fontSize = '16px';
profileLink.style.borderRadius = '8px';
profileLink.style.transition = 'background 0.2s, color 0.2s';
profileLink.style.margin = '4px 0';

const logoutLink = document.createElement('a');
logoutLink.href = 'register.php';
logoutLink.textContent = 'Registrati';
logoutLink.style.display = 'block';
logoutLink.style.padding = '10px 20px';
logoutLink.style.textDecoration = 'none';
logoutLink.style.color = '#222';
logoutLink.style.fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif';
logoutLink.style.fontSize = '16px';
logoutLink.style.borderRadius = '8px';
logoutLink.style.transition = 'background 0.2s, color 0.2s';
logoutLink.style.margin = '4px 0';


[profileLink, logoutLink].forEach(link => {
    link.addEventListener('mouseover', () => link.style.background = '#f0f0f0');
    link.addEventListener('mouseout', () => link.style.background = '');
});


dropdownMenu.appendChild(profileLink);
dropdownMenu.appendChild(logoutLink);


document.body.appendChild(dropdownMenu);


logo.addEventListener('click', (e) => {
    e.preventDefault();
    const rect = logo.getBoundingClientRect();
    dropdownMenu.style.left = `${rect.left}px`;
    dropdownMenu.style.top = `${rect.bottom + window.scrollY}px`;
    dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
    e.stopPropagation();
});


document.addEventListener('click', () => {
    dropdownMenu.style.display = 'none';
});