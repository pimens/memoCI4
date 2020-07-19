<?php
if (!session()->has('id')) {
    echo '<script>
    window.location = "/";
    </script>'; //langsung /auth/red ==== //   auth/red jadi auth/auth/red
} else {
    if (session()->get('level') == 1) {
        echo '<script>
        window.location = "/Home";
        </script>';
    } else if (session()->get('level') == 3) {
        echo '<script>
        window.location = "/";
        </script>';
    } else if (session()->get('level') == 4) {
        echo '<script>
        window.location = "/";
        </script>';
    }
}
