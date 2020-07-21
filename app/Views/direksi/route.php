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
    } else if (session()->get('level') == 2) {
        echo '<script>
        window.location = "/Sp";
        </script>';
    } else if (session()->get('level') == 0) {
        echo '<script>
        window.location = "/super";
        </script>';
    }
}
