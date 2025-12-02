let base_url = "http://127.0.0.1:8000/api";

async function login(e) {
    e.preventDefault(); 
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    try {
        const res = await fetch(base_url + "/login", {
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
        console.log("Response:", data);
        
        if (data.token) {
            localStorage.setItem('token', data.token);
            window.location.href = "dashboardPengguna.html";
        } else {
            alert("Login gagal: " + (data.message || "Terjadi kesalahan"));
        }
        
    } catch (error) {
        console.error("Error:", error);
        alert("Error: " + error.message);
    }
}

 function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }


document.getElementById("loginForm").addEventListener("submit", login);