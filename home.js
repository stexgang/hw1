function getAccessToken() {
    const clientId = "AdIOS7oEDqttUsDAk-RzCDYB0WBkI-MlA-KkG-Df8o60F_gM0_6meyA0hkrFCiENHXGae_ulu3ScbwwB";
    const clientSecret = "EBQySwYuMiRFuf_BIW_YAjZPAiDtnyk5ZSR4WW-QfYVfDYSfceSwbLQWs08slbOx15LIAZhsDKsQuD3R";

    return fetch("https://api-m.sandbox.paypal.com/v1/oauth2/token", {
        method: "POST",
        headers: {
            "Authorization": "Basic " + btoa(clientId + ":" + clientSecret),
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "grant_type=client_credentials"
    })
    .then(response => response.json())
    .then(data => data.access_token);
}

function createOrder() {
    return getAccessToken().then(accessToken => {
        return fetch("https://api-m.sandbox.paypal.com/v2/checkout/orders", {
            method: "POST",
            headers: {
                "Authorization": "Bearer " + accessToken,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                intent: "CAPTURE",
                purchase_units: [{
                    amount: {
                        currency_code: "EUR",
                        value: "249.99"
                    }
                }]
            })
        });
    })
    .then(response => response.json())
    .then(data => {
        if (data.id && data.links) {
            const approvalUrl = data.links.find(link => link.rel === "approve").href;
            return approvalUrl;
        } else {
            throw new Error("Impossibile ottenere l'URL di pagamento.");
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const buyButton = document.getElementById("box2");

    buyButton.addEventListener("click", function () {
        createOrder()
            .then(checkoutUrl => {
                window.location.href = checkoutUrl;
            })
            .catch(error => {
                alert("Errore nel pagamento. Riprova più tardi.");
                console.error("Errore:", error);
            });
    });
});
