<footer class="bg-dark text-white text-center py-3 ">
    <p class="mb-0">© 2025 CrunchyBite. All Rights Reserved.</p>
</footer>

<!-- Bootstrap JS (Popper.js + Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init();
</script>




<!-- JavaScript untuk mengubah background navbar hanya di mobile -->
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");
    const toggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");

    console.log("Navbar:", navbar);
    console.log("Toggler:", toggler);
    console.log("NavbarNav:", navbarNav);

    if (!navbar || !toggler || !navbarNav) {
        console.error("Elemen navbar tidak ditemukan!");
        return;
    }

    // Event listener untuk toggle background navbar di mobile
    toggler.addEventListener("click", function () {
        setTimeout(() => {
            if (window.innerWidth < 992) {
                const isExpanded = toggler.getAttribute("aria-expanded") === "true";
                if (isExpanded) {
                    navbar.classList.add("navbar-mobile-bg");
                } else {
                    navbar.classList.remove("navbar-mobile-bg");
                }
            }
        }, 10);
    });

    // **Tutup menu ketika klik link di dalam navbar (hanya di mobile)**
    navbarNav.querySelectorAll(".nav-link").forEach(link => {
        console.log("Navlink ditemukan:", link.textContent);
        link.addEventListener("click", function () {
            if (window.innerWidth < 992) {
                console.log("Navlink diklik! Menutup menu...");
                toggler.click(); // Menutup menu navbar
            }
        });
    });

    // Reset ke transparan saat berpindah ke mode desktop
    window.addEventListener("resize", function () {
        if (window.innerWidth >= 992) {
            navbar.classList.remove("navbar-mobile-bg");
        }
    });
});

</script>

<script>
        document.addEventListener("DOMContentLoaded", function () {
            window.addEventListener("scroll", function () {
                let navbar = document.querySelector(".navbar");
                if (window.scrollY > 50) {
                    navbar.style.backgroundColor = "rgba(0, 0, 0, 0.8)"; // Solid saat scroll
                } else {
                    navbar.style.backgroundColor = "rgba(0, 0, 0, 0.3)"; // Transparan saat di atas
                }
            });
        });


    </script>

</body>

</html>