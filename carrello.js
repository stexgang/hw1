document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('cart-table-body');
    const totalItems = document.getElementById('total-items');
    const totalPrice = document.getElementById('total-price');

    function aggiornaCarrello() {
        fetch('carrello.php')
            .then(response => response.json())
            .then(data => {
                tbody.innerHTML = '';

                let totale = 0;
                let quantitaTotale = 0;

                data.forEach(item => {
                    const subtotale = item.prezzo * item.quantita;
                    totale += subtotale;
                    quantitaTotale += item.quantita;

                    const riga = document.createElement('tr');
                    riga.innerHTML = `
                        <td>${item.nome}</td>
                        <td>${item.quantita}</td>
                        <td>€${item.prezzo.toFixed(2)}</td>
                        <td>€${subtotale.toFixed(2)}</td>
                        <td>
                            <button class="rimuovi-btn" data-id="${item.id}">
                                Rimuovi
                            </button>
                        </td>
                    `;

                    tbody.appendChild(riga);
                });

                totalItems.textContent = quantitaTotale;
                totalPrice.textContent = `€${totale.toFixed(2)}`;

                document.querySelectorAll('.rimuovi-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = btn.dataset.id;

                        fetch('rimuovi_carrello.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: `id=${encodeURIComponent(id)}`
                        })
                        .then(response => response.text())
                        .then(() => aggiornaCarrello())
                        .catch(error => console.error('Errore nella rimozione:', error));
                    });
                });
            })
            .catch(error => {
                console.error('Errore nel caricamento del carrello:', error);
            });
    }

    aggiornaCarrello();
});
