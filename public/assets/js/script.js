// Show Pass
function showPass() {
    const passwordInput = document.getElementById("password");
    const passwordType = passwordInput.type;

    if (passwordType === "password") {
        passwordInput.type = "text";
        document.getElementById("showPass").innerHTML = '<i class="fa-regular fa-eye"></i>';
    } else {
        passwordInput.type = "password";
        document.getElementById("showPass").innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
    }
}

// Navbar
try {
    const navbar = document.querySelector(".navbar");
    const classList = ["shadow-sm", "border-bottom", "border-secondary", "bg-white"];

    if (navbar) {
        const handleScroll = () => {
            const action = window.pageYOffset > 0.1 ? 'add' : 'remove';
            if (navbar) navbar.classList[action](...classList);
        };

        window.addEventListener("scroll", handleScroll);
    }
} catch (error) {
    console.log("Navbar not found.");
}
