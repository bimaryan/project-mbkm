<script>
    document.addEventListener('DOMContentLoaded', function() {
        let icon = document.getElementById('fullscreen-icon');
        let elem = document.documentElement;

        // Cek dari localStorage apakah user terakhir kali dalam mode full screen
        if (localStorage.getItem('isFullscreen') === 'true') {
            elem.requestFullscreen().then(() => {
                icon.classList.remove('fa-maximize');
                icon.classList.add('fa-minimize');
            }).catch((err) => {
                console.error(`Error trying to enable full-screen mode: ${err.message}`);
            });
        }

        // Tombol full screen
        document.getElementById('fullscreen-btn').addEventListener('click', function() {
            if (!document.fullscreenElement) {
                // Masuk ke mode full screen
                elem.requestFullscreen().then(() => {
                    icon.classList.remove('fa-maximize');
                    icon.classList.add('fa-minimize');
                    localStorage.setItem('isFullscreen', 'true'); // Simpan ke localStorage
                }).catch((err) => {
                    console.error(`Error trying to enable full-screen mode: ${err.message}`);
                });
            } else {
                // Keluar dari mode full screen
                document.exitFullscreen().then(() => {
                    icon.classList.remove('fa-minimize');
                    icon.classList.add('fa-maximize');
                    localStorage.setItem('isFullscreen', 'false'); // Simpan ke localStorage
                }).catch((err) => {
                    console.error(`Error trying to exit full-screen mode: ${err.message}`);
                });
            }
        });
    });
</script>
