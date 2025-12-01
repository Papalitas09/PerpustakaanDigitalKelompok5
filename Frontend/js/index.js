let base_url = "http://127.0.0.1:8000/api";

async function login(e) {
    e.preventDefault(); 

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const res = await fetch("http://127.0.0.1:8000/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
            },
            body: JSON.stringify({
                email: email,
                password: password 
            })
        });

        const data = await res.json();
        console.log("Login berhasil:", data);

        // Optional: simpan token

        // Optional redirect
        // window.location.href = "/dashboard.html";

    } catch (error) {
        console.error("Error:", error);
    }
}

// Hubungkan form → login()
document.getElementById("loginForm").addEventListener("submit", login);


