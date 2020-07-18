<?php
if (!session()->has('id')) {
    echo '<script>
    window.location = "/";
    </script>'; //langsung /auth/red ==== //   auth/red jadi auth/auth/red
}
