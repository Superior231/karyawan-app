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

// Image Preview
const previews = [
    {
        input: document.getElementById('image'),
        preview: document.getElementById('image-preview') 
    },
    {
        input: document.getElementById('edit-avatar-input'),
        preview: document.getElementById('edit-avatar')
    }
];

previews.forEach(item => {
    try {
        if (item.input && item.preview) {
            item.input.onchange = (e) => {
                if (item.input.files && item.input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        item.preview.src = e.target.result;
                    };
                    reader.readAsDataURL(item.input.files[0]);
                }
            };
        }
    } catch (error) {
        console.log("Image preview not found.");
    }
});

// Validasi Input
const inputs = [
    {
        input: document.getElementById('edit-name'),
        maxLength: 30,
        errorMessageId: document.getElementById('edit-name-error-message'),
        errorMessage: 'Nama terlalu panjang!'
    },
    {
        input: document.getElementById('edit-username'),
        maxLength: 20,
        errorMessageId: document.getElementById('edit-username-error-message'),
        errorMessage: 'Username terlalu panjang!'
    }
];

try {
    inputs.forEach(({input, maxLength, errorMessageId, errorMessage}) => {
        input.addEventListener('input', function () {
            const isValid = input.value.length <= maxLength;
            input.classList.toggle('is-invalid', !isValid);
            const simpanButton = document.getElementById('simpan-edit-profile-btn');
            if (simpanButton) simpanButton.disabled = !isValid;
            errorMessageId.style.display = isValid ? 'none' : 'block';
            errorMessageId.innerText = isValid ? '' : errorMessage;
        });
    });
} catch (error) {
    console.log("Input validation not found.");
}
