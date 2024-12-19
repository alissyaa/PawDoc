const modal = document.getElementById("loginModal");
        const btn = document.querySelector(".info-btn");
        const closeBtn = document.querySelector(".close-btn");

        btn.addEventListener("click", (e) => {
            const isLoggedIn = btn.getAttribute("data-logged-in") === "true";
            if (!isLoggedIn) {
                e.preventDefault();
                modal.style.display = "block"; 
            }
        });

        closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });

        window.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });

        const signupModal = document.getElementById("signupModal");
        const signupLink = document.getElementById("signupLink");
        const closeSignupBtn = document.querySelector(".close-signup-btn");

        signupLink.addEventListener("click", (e) => {
            e.preventDefault();
            modal.style.display = "none";
            signupModal.style.display = "block";
        });

        closeSignupBtn.addEventListener("click", () => {
            signupModal.style.display = "none";
        });

        window.addEventListener("click", (e) => {
            if (e.target === signupModal) {
                signupModal.style.display = "none";
            }
        });

        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('show_modal') && urlParams.get('show_modal') === 'true') {
            document.getElementById('loginModal').style.display = 'block';
        }

        const modalnew = document.getElementById('signupmodal');
    const closeModal = document.querySelector('.close');
    closeModal.onclick = function() {
        modalnew.style.display = 'none';
    }