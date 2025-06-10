document.addEventListener("DOMContentLoaded", function () {
    fetch("prodotti.php")
        .then(response => response.json())
        .then(prodotti => {
            const container = document.getElementById("lista-prodotti");
            container.innerHTML = "";

            prodotti.forEach(prodotto => {
                const div = document.createElement("div");
                div.className = "prodotto";
                div.innerHTML = `
                    <img src="${prodotto.img}" alt="${prodotto.nome}">
                    <h3>${prodotto.nome}</h3>
                    <p>Prezzo: €${parseFloat(prodotto.prezzo).toFixed(2)}</p>
                    <button class="aggiungialcarrello" data-id="${prodotto.id}">Aggiungi al Carrello</button>
                `;
                container.appendChild(div);
            });

            document.querySelectorAll(".aggiungialcarrello").forEach(btn => {
                btn.addEventListener("click", function () {
                    const prodottoId = this.getAttribute("data-id");

                    fetch("carrello.php?action=aggiungi", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: `prodotto_id=${prodottoId}&quantita=1`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Prodotto aggiunto al carrello!");
                            window.dispatchEvent(new Event('carrelloAggiornato'));
                        } else {
                            alert("Errore: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Errore nella richiesta:", error);
                        alert("Errore imprevisto, riprova.");
                    });
                });
            });
        })
        .catch(error => {
            console.error("Errore nel caricamento dei prodotti:", error);
        });
});

