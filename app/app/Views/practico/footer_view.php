<br>
    <footer>
    <br>
        <h3>Redes Sociales</h3>
    
        <section>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="https://www.facebook.com/?locale=es_LA" target="_blanck"><i class="fa-brands fa-square-facebook fa-2xl"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://x.com/?lang=es" target="_blanck"><i class="fa-brands fa-x-twitter fa-2xl"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.instagram.com/" target="_blanck"><i class="fa-brands fa-instagram fa-2xl"></i></a>
                </li>
            </ul>
        </section>
        <p>© Copyright 2025 FCBox. Todos los derechos reservados.</p>
    </footer>

    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>